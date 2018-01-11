<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $table = "municipios";

    public static function municipios_por_estado($estado)
    {
    	$municipio = self::where('id_estado','=',$estado)->select('id_municipio','municipio')->get();

    	return $municipio;
    }
}
