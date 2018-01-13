<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Admin;
use App\Stocktaking;
use App\Estado;
use App\Municipio;
use App\Parroquia;

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
}
