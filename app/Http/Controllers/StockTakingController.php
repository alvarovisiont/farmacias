<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use PDF;
use Excel;

use App\Stocktaking;
use App\Provider;
use App\Group;
use App\Trademark;
use App\ConfigCurrency;
use App\Config;

class StockTakingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stocktaking = Stocktaking::where('users_id','=',Auth::user()->id)->get();

        return view('stocktaking.index')->with('stock',$stocktaking);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $stocktaking = new Stocktaking;
        $providers   = Provider::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $groups   = Group::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $trademarks   = Trademark::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $config_currencies   = ConfigCurrency::where('users_id','=',Auth::user()->id)->get();

        $ruta = "/stocktaking";
        $datos = ['stock' => $stocktaking, 'ruta' => $ruta, 'edit' => false,'providers' => $providers,'groups' => $groups, 'trademarks' => $trademarks, 'config_currencies' => $config_currencies];

        return view('stocktaking.create')->with($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $stock = new StockTaking;
        $stock->fill($request->all());
        $stock->buying_date = date('Y-m-d',strtotime($stock->buying_date));
        $stock->users_id = Auth::user()->id;
        $stock->save();

        return redirect()->route('stocktaking.index')->with([
            'flash_message' => "Registro agregado con éxito",
            'flash_class'   => "alert-success"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $stock = Stocktaking::findOrFail($id);

        return view('stocktaking.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $stocktaking = Stocktaking::findOrFail($id);
        $providers   = Provider::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $groups   = Group::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $trademarks   = Trademark::where('users_id','=',Auth::user()->id)->select('id','name')->get();
        $config_currencies   = ConfigCurrency::where('users_id','=',Auth::user()->id)->get();

        $ruta = "/stocktaking/".$id;
        $datos = ['stock' => $stocktaking, 'ruta' => $ruta, 'edit' => true,'providers' => $providers,'groups' => $groups, 'trademarks' => $trademarks, 'config_currencies' => $config_currencies];

        return view('stocktaking.create')->with($datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $stock = StockTaking::findOrFail($id);
        $stock->fill($request->all());
        $stock->buying_date = date('Y-m-d',strtotime($stock->buying_date));
        $stock->save();

        return redirect()->route('stocktaking.index')->with([
            'flash_message' => "Registro Modificado con éxito",
            'flash_class'   => "alert-success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            Stocktaking::destroy($id);
            return redirect()->route('stocktaking.index')->with([
                        "flash_message" => "Registro Eliminado con Éxito",
                        "flash_class" => "alert-success"
                    ]);

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('stocktaking.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }

    public function allproducts()
    {
        $products = Stocktaking::where('users_id','=',Auth::user()->id)->get();

        $products = $products->each(function($product){
            
            if($product->config_currencies_iva_id !== 0)
            {
                $product->iva_product->percentage;
            }

            if($product->config_currencies_discount_id !== 0)
            {
                $product->discount_product->percentage;
            }
        });

        return response()->json($products);
    }

    // ** ============================ // Reportes // ================================== ** //

    public function pdf_stocktaking()
    {
        
        $stock = Stocktaking::where('users_id','=',Auth::user()->id)->get();
        $config = Config::where('user_id','=',Auth::user()->id)->first();

        $datos = ['config' => $config,'stock' => $stock];

        $pdf = PDF::loadView('stocktaking.pdf_stock',$datos,[],[
            'title' => 'Inventario',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);

        return $pdf->stream('stocktaking.pdf');
    }

    public function excel_stocktaking()
    {
        
        $stock = Stocktaking::where('users_id','=',Auth::user()->id)->get();

        Excel::create('inventario',function($excel) use ($stock){

            $excel->sheet('inventario',function($sheet) use ($stock){
                $sheet->loadView('stocktaking.excel_stock')->with('stock',$stock);
            });

        })->export('xlsx');
    }

}
