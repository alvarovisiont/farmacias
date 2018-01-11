<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyTemporal extends Model
{
    //
    protected $fillable = ['providers_id','stocktaking_id','user_id','quantity','price','total'];
}
