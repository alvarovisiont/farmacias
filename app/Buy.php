<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    //
    protected $fillable = ['user_id','pay_mode','total'];

    public function details_buy()
    {
    	return $this->hasMany('App\BuyDetail','buy_id','id');
    }
}
