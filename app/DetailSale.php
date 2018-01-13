<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    //
    protected $fillable = ['sales_id','products_id','price','config_currencies_iva','config_currencies_discount','quantity','total'];

    public function stock()
    {
    	return $this->hasOne('App\Stocktaking','id','products_id');
    }

    public function sale()
    {
    	return $this->belongsTo('App\Sale','sales_id','id');
    }
}
