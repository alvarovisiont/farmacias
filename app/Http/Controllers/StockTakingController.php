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
use App\DetailSale;

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
        $datos = ['stock' => $stocktaking, 'user_id' => Auth::user()->id];

        return view('stocktaking.index')->with($datos);

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

        $this->validate($request,[
            'code_product' => Rule::unique('stocktakings')->where(function ($query) {
                $query->where('users_id', Auth::user()->id);
            })
        ],
        [
            'code_product.unique' => 'Este código de producto ya ha sido utilizado'
        ]);

        $stock = new StockTaking;
        $stock->fill($request->all());
        $stock->buying_date = date('Y-m-d',strtotime($stock->buying_date));
        $stock->date_of_expense = date('Y-m-d',strtotime($stock->date_of_expense));
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
        $sales = DetailSale::where('products_id','=',$id)->get();
        
        $datos = ['stock' => $stock, 'sales' => $sales];

        return view('stocktaking.show')->with($datos);
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
        $this->validate($request,[
            'code_product' => Rule::unique('stocktakings')->where(function ($query) use ($id) {
                $query->where([ ['users_id', Auth::user()->id], ['id','<>',$id] ]);
            })
        ],
        [
            'code_product.unique' => 'Este código de producto ya ha sido utilizado'
        ]);

        $stock = StockTaking::findOrFail($id);
        $stock->fill($request->all());
        $stock->buying_date = date('Y-m-d',strtotime($stock->buying_date));
        $stock->date_of_expense = date('Y-m-d',strtotime($stock->date_of_expense));
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

    public function pdf_stocktaking($id)
    {
        
        $stock = Stocktaking::where('users_id','=',$id)->get();
        $config = Config::where('user_id','=',$id)->first();

        $datos = ['config' => $config,'stock' => $stock,'con' => 0];

        $pdf = PDF::loadView('stocktaking.pdf_stock',$datos,[],[
            'title' => 'Inventario',
            'format' => 'A4-L',
            'orientation' => 'L'
        ]);

        return $pdf->stream('stocktaking.pdf');
    }

    public function excel_stocktaking($id)
    {
        
        $stock = Stocktaking::where('users_id','=',$id)->get();

        Excel::create('inventario',function($excel) use ($stock){

            $excel->sheet('inventario',function($sheet) use ($stock){
                $sheet->loadView('stocktaking.excel_stock')->with('stock',$stock);
            });

        })->export('xlsx');
    }

    // ============================ // Import Stock // ======================================= //

    public function stocktaking_view()
    {
        $ruta = "/stocktaking/import/stored_products";
        $ruta_descarga = "download.stocktaking.example.excel";
        $datos = ['ruta' => $ruta, 'ruta_descarga' => $ruta_descarga];

        return view('stocktaking.import_view')->with($datos);
    }

    public function download_excel_stock_example()
    {
        Excel::load('files/inventario_example.xlsx',function($excel){

        })->export('xlsx');   
    }

    public function stocktaking_import(Request $request)
    {
        if($request->excel_file->getMimeType() !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        {
            return response()->json(['r' => false]);
        }
        else
        {
            $producto_no_importados = [];

            try{
                $file = $request->excel_file;
                $nombre_archivo = time().$file->getClientOriginalName();

                $file->move('files',$nombre_archivo);   

                $result = Excel::load('files/'.$nombre_archivo,function($reader){
                    $reader->all();
                })->get();


                $result->each(function($result) use ($producto_no_importados) {

                    $product = Stocktaking::where([
                        ['code_product','=',$result->codigo_producto],
                        ['users_id','=',Auth::user()->id]
                    ])->first();

                    if($product)
                    {
                        array_push($producto_no_importados, $product->code_product); 
                    }
                    else
                    {
                        $stock = new Stocktaking;

                        $stock->providers_id                    = $result->id_proveedor;
                        $stock->users_id                        = Auth::user()->id;
                        $stock->trademarks_id                   = $result->id_marca;
                        $stock->groups_id                       = $result->id_grupo;
                        $stock->code_product                    = $result->codigo_producto;
                        $stock->product                         = $result->producto;
                        $stock->component                       = $result->componente;
                        $stock->quantity                        = $result->cantidad;
                        $stock->price                           = $result->precio_venta;
                        $stock->buying_price_provider           = $result->precio_comprado_proveedor;
                        $stock->buying_date                     = $result->fecha_comprado;
                        $stock->config_currencies_iva_id        = $result->id_iva_configuracion_moneda;
                        $stock->config_currencies_discount_id   = $result->id_descuento_configuracion_moneda;
                        $stock->date_of_expense                 = $result->fecha_expension;

                        $stock->save();
                    }
                    
                        

                });

                if(file_exists( public_path('files/').$nombre_archivo ) ) 
                {
                    unlink( public_path('files/').$nombre_archivo );   
                }


                return response()->json(['r' => true]);
            }
            catch(\Illuminate\Database\QueryException $e)
            {
                return response()->json(['r' => false, 'error' => true ]);
            }
        }
    }
}
