<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $fillable = ['nombre_farmacia','director','director_number','director_email','logo','iva_porcentaje','user_id'];
}
