<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //

    public static function where_filter_medicine($request)
    {
    	$where = "";

        if(!empty($request->estados))
        {
            if(!empty($where))
            {
                $where .= " AND u.estado = $request->estados";
            }
            else
            {
                $where = " u.estado = $request->estados";   
            }
        }
        
        if(!empty($request->municipios))
        {
            if(!empty($where))
            {
                $where .= " AND u.municipio = $request->municipios";
            }
            else
            {
                $where = " u.municipio = $request->municipios";   
            }
        }

        if(!empty($request->parroquias))
        {
            if(!empty($where))
            {
                $where .= " AND u.parroquia = $request->parroquias";
            }
            else
            {
                $where = " u.parroquia = $request->parroquias";   
            }
        }

        if(!empty($request->product))
        {
            if(!empty($where))
            {
                $where .= " AND stocktakings.product LIKE '%".$request->product."%'";
            }
            else
            {
                $where = " stocktakings.product LIKE '%".$request->product."%'";   
            }
        }

        if(!empty($request->component))
        {
            if(!empty($where))
            {
                $where .= " AND stocktakings.component LIKE '%".$request->component."%'";
            }
            else
            {
                $where = " stocktakings.component LIKE '%".$request->component."%'";   
            }
        }

        if(!empty($request->quantity))
        {
            if(!empty($where))
            {
                $where .= " AND stocktakings.quantity <= $request->quantity";
            }
            else
            {
                $where = " stocktakings.quantity <= $request->quantity";   
            }
        }

        if(!empty($request->fecha_expension))
        {
            $date = date('Y-m-d', strtotime($request->fecha_expension));

            if(!empty($where))
            {
                $where .= " AND stocktakings.date_of_expense = '$date'";
            }
            else
            {
                $where = " stocktakings.date_of_expense = '$date'";
            }
        }

        return $where;
    }
}
