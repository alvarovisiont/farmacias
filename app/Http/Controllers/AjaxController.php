<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use App\Parroquia;
use App\Stocktaking;

class AjaxController extends Controller
{
    //

    public function traer_municipios(Request $request)
    {
    	$estado = $request->get('estado');

    	$municipios = Municipio::where('id_estado','=',$estado)->select('id_municipio','municipio')->get();

    	return response()->json($municipios);
    }

    public function traer_parroquias(Request $request)
    {
    	$estado = $request->get('estado');
    	$municipio = $request->get('municipio');

    	$parroquias = Parroquia::where([
    			['id_estado','=',$estado],
    			['id_municipio','=',$municipio]
    		])->select('id','parroquia')->get();

    	return response()->json($parroquias);
    }

    public function products_by_provee(Request $request)
    {
        $stock = Stocktaking::where('providers_id','=',$request->get('provee'))->select('id','product','buying_price_provider')->get();

        return response()->json($stock);
    }
}
