<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigCurrency extends Model
{
    //
    protected $fillable = ['percentage','type','user_id'];
}
