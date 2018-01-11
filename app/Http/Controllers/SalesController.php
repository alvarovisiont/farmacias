<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

use App\Sale;
use App\Config;
use App\DetailSale;
use App\TempSale;
use App\Client;
use App\Stocktaking;

class SalesController extends Controller
{
    //

    public function index()
    {
        $sales = Sale::where('users_id','=',Auth::user()->id)->get();
        return view('sale.index')->with('sales',$sales);
    }

    public function show($id)
    {

        $sale = Sale::where([
            ['users_id','=',Auth::user()->id],
            ['id','=',$id]
        ])
        ->first();

        return view('sale.show_sale')->with('sale',$sale);
    }

    public function sell()
    {
        TempSale::where('users_id','=',Auth::user()->id)->delete();

    	$sell = new Sale;
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

    	$datos = ['sell' => $sell, 'config' => $config, 'validate' => $validate, 'route' => 'sale.store'];
    	return view('sale.sell')->with($datos);
    }

    public function store(Request $request)
    {
        $respuesta = ['r' => true];

        $clientStored = Client::where([
            ['users_id','=',Auth::user()->id],
            ['cedula','=',$request->post('cedula')]
        ])
        ->first();

        if(!$clientStored)
        {
            $client = new Client;
            $client->fill($request->all());
            $client->users_id = Auth::user()->id;
            if($client->save())
            {
                $clientStored = $client;
            }
            else
            {
                $respuesta = ['r' => false];
                return response()->json($respuesta);

                exit();
            }
        }

        $sale = new Sale;
        $sale->users_id = Auth::user()->id;
        $sale->clients_id = $clientStored->id;
        $sale->invoice  = $sale->generate_number_invoice();
        $sale->pay_mode = $request->pay_mode;
        $sale->iva_config_global = $request->iva_config_global;
        if($request->pay_mode === "efectivo")
        {
            $sale->iva_config_global = 0;
        }
        $sale->total = $request->total;
        if($sale->save())
        {
            $temp_detail_sale = TempSale::where('users_id','=',Auth::user()->id)->get();

            $temp_detail_sale->each(function($temp) use ($sale){

                $detail_sale = new DetailSale;
                $detail_sale->sales_id = $sale->id;
                $detail_sale->products_id = $temp->products_id;
                $detail_sale->price = $temp->price;
                $detail_sale->config_currencies_iva = $temp->config_currencies_iva;
                $detail_sale->config_currencies_discount = $temp->config_currencies_discount;
                $detail_sale->quantity = $temp->quantity;
                $detail_sale->total = $temp->total;
                $detail_sale->save();

                $stock = Stocktaking::findOrFail($temp->products_id);
                $stock->quantity = $stock->quantity - $temp->quantity;
                $stock->save();
            });
        }
        else
        {
            $respuesta = ['r' => false];
            return response()->json($respuesta);
            exit();
        }

        TempSale::where('users_id','=',Auth::user()->id)->delete();

        $respuesta['sale_id']  = $sale->id;


        return response()->json($respuesta);
        
    }

    public function search_products_temp(Request $request)
    {
        $respuesta = ['r' => false];

        $product = TempSale::where([
            ['users_id','=',Auth::user()->id],
            ['products_id','=',$request->get('product_id')]
        ])
        ->first();

        if(!$product)
        {
            $temp = new TempSale;
            $temp->users_id = Auth::user()->id; 
            $temp->products_id = $request->get('product_id'); 
            $temp->price    = $request->get('price');
            $temp->config_currencies_iva = $request->get('iva');
            $temp->config_currencies_discount = $request->get('discount');
            $temp->quantity = $request->get('quantity');
            $temp->total = $request->get('total');
            
            if($temp->save())
            {
                $respuesta['r'] = true;
            }
        }

        return response()->json($respuesta);
    }

    public function remove_products_temp(Request $request)
    {
        TempSale::where([
            ['users_id','=',Auth::user()->id],
            ['products_id','=',$request->post('product_id')]
        ])
        ->delete();
    }

    public function invoice_pdf($id)
    {
        $sale = Sale::where([
            ['users_id','=',Auth::user()->id],
            ['id','=', $id]
        ])
        ->first();

        $config = Config::where('user_id','=',Auth::user()->id)->first();
        $client = Client::where('id','=',$sale->clients_id)->first();
        $datos = ['config' => $config, 'sale' => $sale, 'client' => $client];

        $pdf = PDF::loadView("sale.pdf_invoice",$datos);

        return $pdf->stream('Factura '.$sale->invoice.".pdf");
    }
}
