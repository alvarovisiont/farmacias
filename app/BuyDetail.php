<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyDetail extends Model
{
    //
    protected $fillable = ['buy_id','providers_id','stocktaking_id','user_id','quantity','price','total'];

    public function provider()
    {
    	return $this->hasOne('App\Provider','id','providers_id');
    }

    public function stock()
    {
    	return $this->hasOne('App\Stocktaking','id','stocktaking_id');	
    }
}
