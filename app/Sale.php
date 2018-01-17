<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Client;
use App\DetailSale;
use App\Stocktaking;

class Sale extends Model
{
    //
    protected $fillable = ['users_id','clients_id','invoice','pay_mode','iva_config_global','total','id_temporal'];

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

    public static function save_import_excel_sells($row,$sheet)
    {
        $validate = false;

        if($sheet->getTitle() == "Hoja1")
        {
            $sales = new Sale;
            
            $client = Client::where([ ['cedula','=', $row->cedula_cliente],['users_id','=',Auth::user()->id] ])->first();
            
            if($client)
            {
                $sales->users_id            = Auth::user()->id;
                $sales->clients_id          = $client->id;
                $sales->invoice             = $row->factura;
                $sales->pay_mode            = $row->metodo_pago;
                $sales->iva_config_global   = $row->iva_aplicado;
                $sales->total               = $row->total;
                $sales->id_temporal         = $row->id_venta;
                $sales->save();
            }
            else
            {
                $clientNew = new Client;

                $clientNew->users_id = Auth::user()->id;
                $clientNew->cedula  = $row->cedula_cliente;
                $clientNew->name_complete = $row->nombre_completo_cliente;
                $clientNew->gender  = $row->genero;
                $clientNew->address = $row->direccion;
                $clientNew->number  = $row->telefono;
                $clientNew->email   = $row->email;
                $clientNew->save();

                $sales->users_id            = Auth::user()->id;
                $sales->clients_id          = $clientNew->id;
                $sales->invoice             = $row->factura;
                $sales->pay_mode            = $row->metodo_pago;
                $sales->iva_config_global   = $row->iva_aplicado;
                $sales->total               = $row->total;
                $sales->id_temporal         = $row->id_venta;
                $sales->save();
            }
        }
        else
        {

            $stock = Stocktaking::where([
                        ['id','=',$row->id_producto],
                        ['users_id','=',Auth::user()->id]
                    ])->first();

            if($stock)
            {
                $quantity = $stock->quantity;
                
                if($quantity >= $row->cantidad)
                {
                    $stock->quantity = $stock->quantity - $row->cantidad;
                    $stock->save();

                    $sales = Sale::where('id_temporal','=',$row->id_venta)->first();

                    $detail = new DetailSale;

                    $detail->sales_id = $sales->id;
                    $detail->products_id = $row->id_producto;            
                    $detail->price = $row->precio;            
                    $detail->config_currencies_iva = $row->iva_producto;
                    $detail->config_currencies_discount = $row->descuento;
                    $detail->quantity = $row->cantidad;
                    $detail->total = $row->total;
                    $detail->save();

                    $validate = true;
                }
            }
            else
            {
                $validate = false;
            }
            
            return $validate;  
        }

    }   
}
