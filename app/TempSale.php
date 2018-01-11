<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempSale extends Model
{
    //
    protected $fillable = ['users_id','products_id','price','config_currencies_iva','config_currencies_discount','quantity','total'];
}
