<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    //
    protected $table = "parroquias";

    public static function parroquias($estado,$municipio)
    {
    	$parroquias = self::where([ ['id_estado','=',$estado],['id_municipio','=',$municipio] ])->select('id','parroquia')->get();

    	return $parroquias;
    }
}
