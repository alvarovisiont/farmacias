<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocktaking extends Model
{
    //
    protected $fillable = ['providers_id','users_id','trademarks_id','groups_id','code_product','product','component','quantity','price','buying_price_provider','buying_date','config_currencies_iva_id','config_currencies_discount_id', 'date_of_expense'];

    public function trademark_product()
    {
    	return $this->hasOne('App\Trademark','id','trademarks_id');
    }

    public function group_product()
    {
    	return $this->hasOne('App\Group','id','groups_id');
    }

    public function provider_product()
    {
        return $this->hasOne('App\Provider','id','providers_id');
    }

    public function discount_product()
    {
        return $this->hasOne('App\ConfigCurrency','id','config_currencies_discount_id');
    }

    public function iva_product()
    {
        return $this->hasOne('App\ConfigCurrency','id','config_currencies_iva_id');
    }

    public function user_stock()
    {
        return $this->hasOne('App\User','id','users_id');
    }
}
