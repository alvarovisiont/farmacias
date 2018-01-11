<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $fillable = ['users_id','clients_id','invoice','pay_mode','iva_config_global','total'];

    public function generate_number_invoice()
    {
    	$año = date('Y');
    	$mes = date('m');
    	$id_max = $this->max('id');
    	$id_max = $id_max + 1;
    	return $año.$mes."000".$id_max; 
    }

    public function details_sale()
    {
        return $this->hasMany('App\DetailSale','sales_id','id');
    }

    public function client_sale()
    {
        return $this->hasOne('App\Client','id','clients_id');
    }
}
