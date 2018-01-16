<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

use App\Admin;
use App\Stocktaking;
use App\Sale;
use App\DetailSale;
use App\Buy;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\Config;

class AdminController extends Controller
{
    //
// ** ================== // Funciones para mostrar los inventariosd de las farmacias // ===================== ** //
    public function stocktaking()
    {
    	// retorna lav vista para buscar las farmacias por localidad
    	$estados = Estado::all();
    	return view('admin.stocktaking')->with('estados',$estados);
    }

    public function stocktaking_pharmacy(Request $request)
    {
    	// retorna los daatos a la vista con las farmacias encontradas

    	$pharmacys = Stocktaking::selectRaw('COUNT(stocktakings.id) as cantidad,c.*,stocktakings.users_id')
    								->join('users as u','u.id','=','stocktakings.users_id')
    								->join('configs as c','c.user_id','=','u.id')
    								->where([
    									['u.estado','=',$request->estados],
    									['u.municipio','=',$request->municipios],
    									['u.parroquia','=',$request->parroquias],
    								])
    								->groupBy('stocktakings.users_id','c.id','c.nombre_farmacia','c.director','c.director_number','c.director_email','c.logo','c.iva_porcentaje','c.user_id','c.created_at','c.updated_at')
    								->get();

    	return response()->json($pharmacys);
    }

    public function stocktaking_pharmacy_view($id)
    {
        $stocktaking = Stocktaking::where('users_id','=',$id)->get();
        $datos = ['stock' => $stocktaking, 'user_id' => $id];
        return view('stocktaking.index')->with($datos);

    }
    

// ** ================== // Funciones para mostrar las medicinas // ===================== ** //
    
    public function medicines()
    {
        $estados = Estado::all();
        return view('admin.medicines')->with('estados',$estados);
    }

    public function medicines_filter(Request $request)
    {
        $where = Admin::where_filter_medicine($request);        
        $sql = " stocktakings.*, c.*, date_format(stocktakings.date_of_expense, '%d-%m-%Y') as date_of_expense,
                (SELECT estado from estados where id = u.estado) as estado,
                (SELECT municipio from municipios where id_municipio = u.municipio and id_estado = u.estado) as municipio,
                (SELECT parroquia from parroquias where id = u.parroquia) as parroquia";

        $medicines = Stocktaking::selectRaw($sql)
                                    ->join('users as u','u.id','=','stocktakings.users_id')
                                    ->join('configs as c','c.user_id','=','u.id')
                                    ->whereRaw($where)
                                    ->get();

        return response()->json($medicines);
    }

// ** ================== // Funciones para mostrar las ventas // ===================== ** //

    public function sales()
    {
        $estados = Estado::all();
        return view('admin.sales')->with('estados',$estados);
    }

    public function sales_pharmacy_view($id)
    {
        $sales = Sale::where('users_id','=',$id)->get();
        
        return view('sale.index')->with('sales',$sales);
    }

    // ** ================== // Funciones para mostrar las ventas // ===================== ** //

    public function buy()
    {
        $estados = Estado::all();
        return view('admin.buy')->with('estados',$estados);
    }

    public function buy_pharmacy_view($id)
    {
        $buys = Buy::where('user_id','=',$id)->get();
        return view('buys.index')->with('buys',$buys);
    }

    public function import_sale()
    {
        $estados = Estado::all();
        return view('admin.import_sale')->with('estados',$estados);   
    }

    public function find_pharmacy(Request $request)
    {
        $pharmacys = Config::select('configs.nombre_farmacia','user_id')
                            ->join('users as u','u.id','=','configs.user_id')
                            ->where([
                                ['estado','=',$request->estado],
                                ['municipio','=',$request->municipio],
                                ['parroquia','=',$request->parroquia],
                            ])
                            ->get();

        return response()->json($pharmacys);
    }

    public function pharmacy_sale_import(Request $request)
    {

        if($request->file->getMimeType() !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        {
            return response()->json(['r' => false]);
        }
        else
        {
            $request->file->move('files',$request->file->getClientOriginalName());

            $result = Excel::load('files\\'.$request->file->getClientOriginalName(),function($reader){
                $reader->all();
            })->get();

            $result->each(function($result){
                echo $result->genero;
            });

            //return response()->json(['r' => true]);
        }
    }    

// ================ función para ver las compras hechas por los clientes ==================== //

    public function view_buys_clients(Request $request)
    {
        $user = base64_decode($request->get('user'));

        $buys = DetailSale::select('detail_sales.*')
                            ->join('sales as s','s.id','=','detail_sales.sales_id')
                            ->where('s.clients_id','=',$user)
                            ->get();

        return view('admin.view_buys_clients')->with('buys',$buys); 

    }

}
