<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Provider;
use App\Buy;
use App\BuyDetail;
use App\BuyTemporal;
use App\Stocktaking;
use App\Config;

class BuyController extends Controller
{
    //

    public function index(Request $request)
    {
        $buys = "";
        
        if(isset($request->user_id))
        {
            $id = base64_decode($request->user_id);

            $buys = Buy::where('user_id','=',$id)->get();
        }
        else
        {
            $buys = Buy::where('user_id','=',Auth::user()->id)->get();
        }

        return view('buys.index')->with('buys',$buys);
    }

    public function make_buy()
    {	
    	BuyTemporal::where('user_id','=',Auth::user()->id)->delete();

    	$config = Config::where('user_id','=',Auth::user()->id)->first();
    	$validate = false;
    	if($config)
    	{
    		switch ($config->iva_porcentaje) 
    		{
    			case 0:
    				$validate = false;	
    			break;
    			
    			default: 
    				$validate = true;
    			break;
    		}
    	}

    	$buy = new Buy;
    	$providers = Provider::where('users_id','=',Auth::user()->id)->select('id','name')->get();
    	$datos = ['route' => 'buy/stored', 'providers' => $providers, 'buy' => $buy,'validate' => $validate, 'config' => $config];


    	return view('buys.buy')->with($datos);
    }

    public function stored(Request $request)
    {
        $buy = new Buy;

        $buy->fill($request->all());
        $buy->user_id = Auth::user()->id;
        if($request->pay_mode == "punto")
        {
            $buy->iva_config = $request->iva_config_global;   
        }
        else
        {
            $buy->iva_config = 0;
        }
        
        if($buy->save())
        {
            $temp = BuyTemporal::where('user_id','=',Auth::user()->id)->get();

            $temp->each(function($temp) use ($buy){

                $detail = new BuyDetail;

                $detail->buy_id = $buy->id;
                $detail->providers_id = $temp->providers_id;
                $detail->user_id = Auth::user()->id;
                $detail->stocktaking_id = $temp->stocktaking_id;
                $detail->quantity = $temp->quantity;
                $detail->price = $temp->price;
                $detail->total = $temp->total;
                if($detail->save())
                {
                    $stock = Stocktaking::where([
                        ['users_id','=',Auth::user()->id],
                        ['id','=',$temp->stocktaking_id]
                    ])->first();

                    $stock->quantity = $stock->quantity + $temp->quantity;
                    $stock->save();
                }
            });

            BuyTemporal::where('user_id','=',Auth::user()->id)->delete();
            return redirect()->route('buy.index');
        }
        else
        {
            return redirect()->route('buy.index');
        }
    }

    public function stored_temp(Request $request)
    {

    	$stock = BuyTemporal::where([
    		['user_id','=',Auth::user()->id],
    		['stocktaking_id','=',$request->stock]
    	])->first();

    	if($stock)
    	{
    		return response()->json(['r' => false]);
    	}
    	else
    	{
    		$temp = new BuyTemporal;

    		$temp->providers_id = $request->provider;
    		$temp->user_id = Auth::user()->id;
    		$temp->stocktaking_id = $request->stock;
    		$temp->quantity = $request->quantity;
    		$temp->price = $request->price;
    		$temp->total = $request->total;
    		
    		if($temp->save())
    		{
    			return response()->json(['r' => true]);
    		}

    	}
    }

    public function stored_temp_remove(Request $request)
    {
    	BuyTemporal::where([
    		['user_id','=',Auth::user()->id],
    		['stocktaking_id','=',$request->product_id]
    	])->delete();
    }

    public function show($id)
    {
        $buy = Buy::where('id','=',$id)->first();
        $datos = ['buy' => $buy,'total' => 0];
        return view('buys.show')->with($datos);
    }

    public function destroy($id)
    {
        try
        {
            Buy::destroy($id);
            
            return redirect()->route('buy.index')->with([
                'flash_message' => 'Registro eliminado con éxito',
                'flash_class'   => 'alert-success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('buy.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
