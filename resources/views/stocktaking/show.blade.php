@extends('layouts.app')
@section('view_descrip')
    Datos del Producto {{$stock->product}} 
@endsection
@section('content')
	<table class="table table-bordered table-hover">
		<tbody>
			<tr>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Proveedor</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Marca</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Grupo</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Precio de Venta</b></td>
			</tr>
			<tr>
				<td class="text-center">{{ $stock->provider_product->name}}</td>
				<td class="text-center">{{ $stock->trademark_product->name}}</td>
				<td class="text-center">{{ $stock->group_product->name}}</td>
				<td class="text-center">{{ number_format($stock->price,2,'.',',') }}</td>
			</tr>
			<tr>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Precio de Proveedor</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Iva</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Descuento</b></td>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Fecha Adquirido</b></td>
			</tr>
			<tr>
				<td class="text-center">{{ number_format($stock->buying_price_provider,2,'.',',') }}</td>
				<td class="text-center">{{ $stock->config_currencies_iva_id !== 0 ? $stock->iva_product->percentage."%" : 'Excento' }}</td>
				<td class="text-center">{{ $stock->config_currencies_discount_id !== 0 ? $stock->discount_product->percentage."%" : 'Excento' }}</td>
				<td class="text-center">{{ date('d-m-Y', strtotime($stock->buying_date)) }}</td>
			</tr>
			<tr>
				<td class="text-center" style="border-top: 1px solid lightblue;"><b>Fecha Expensión</b></td>
			</tr>
			<tr>
				<td class="text-center">{{ date('d-m-Y', strtotime($stock->date_of_expense)) }}</td>
			</tr>
		</tbody>
	</table>
	<br />
	<div class="panel-group" id="accordion">
	  	<div class="panel panel-success">
		    <div class="panel-heading">
		    	<div class="row no-gutters">
			      	<h4 class="panel-title">
				      	<div class="col-md-4 col-sm-4">
				        	<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="color: white">
				        	Ver ventas de este producto</a>&nbsp;&nbsp;<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>
				        </div>
						<div class="col-md-offset-4 col-sm-offset-4 col-md-4 col-sm-4">
				        	<label for="" class="control-label">Total: </label>&nbsp;&nbsp;&nbsp;
				        	<input type="text" readonly="" value="{{ count($sales) }}" style="color: black" class="">
						</div>
			      	</h4>
			   	</div>
		    </div>
		    <div id="collapse1" class="panel-collapse collapse">
		      <div class="panel-body">
		      	<table class="table table-bordered table-hover" id="table">
		      		<thead>
		      			<tr>
		      				<th class="text-center">Nombre Cliente</th>
		      				<th class="text-center">Céd/Telé</th>
		      				<th class="text-center">Iva/Desc %</th>
		      				<th class="text-center">Cantidad</th>
		      				<th class="text-center">Total</th>
		      				<th class="text-center">Fecha</th>
		      			</tr>
		      		</thead>
		      		<tbody class="text-center">
		      			@foreach($sales as $row)
		      				@php
		      					$fecha = new DateTime($row->created_at);
		      					$fecha->modify('-4 hour');
		      					$fecha = $fecha->format('d-m-Y H:i:s');

		      				@endphp
		      				<tr>
		      					<td>{{ $row->sale->client_sale->name_complete }}</td>
		      					<td>{{ $row->sale->client_sale->cedula }} <br/>{{ $row->sale->client_sale->number }}</td>
		      					<td>{{ $row->config_currencies_iva }}/{{ $row->config_currencies_discount }}</td>
		      					<td>{{ $row->quantity }}</td>
		      					<td>{{ number_format($row->total, 2,',','.')  }}</td>
		      					<td>{{ $fecha }}</td>
		      				</tr>
		      			@endforeach
		      		</tbody>
		      	</table>
		      </div>
		    </div>
	  	</div>	
	</div>

	<div class="row no-gutters">
		<div class="col-md-3 col-sm-3">
			@if(Auth::user()->nivel > 1)
				<a href="{{route('stocktaking.index')}}" class="btn btn-default">Volver&nbsp;<i class="fa fa-arrow-left"></i></a>
			@else
				<a href="{{ url('/admin/stocktaking/pharmacy/view/'.$stock->users_id) }}" class="btn btn-default">Volver&nbsp;<i class="fa fa-arrow-left"></i></a>
			@endif
		</div>
		@if(Auth::user()->authorized() && Auth::user()->nivel > 1)
			<div class="col-md-offset-5 col-sm-offset-5 col-md-2 col-sm-2">
				<a href="{{url('stocktaking/'.$stock->id."/edit")}}" class="btn btn-primary">Modificar&nbsp;<i class="fa fa-edit"></i></a>
			</div>
			<div class="col-sm-2 col-md-2">
				<a href="#" data-eliminar="{{ $stock->id }}" class="btn btn-danger eliminar">Eliminar&nbsp;<i class="fa fa-trash"></i></a>
			</div>
		@endif
	</div>
	<form action="{{ url('stocktaking/'.':USER') }}" id="form_eliminar" method="POST">
        {{csrf_field()}}
        {{method_field('DELETE')}}
    </form>
@endsection

@section('script')
	<script>
        $(function(){
            $('.eliminar').click(function(e){

                e.preventDefault()

                var form = $('#form_eliminar'),
                    id   = $(this).data('eliminar'),
                    agree = confirm('Esta seguro de querer borrar este registro?')

                if(agree)
                {
                    ruta = form.prop('action').replace(':USER',id)
                    form.attr('action',ruta)
                    form.submit()
                }
                
            })      
        })
    </script>
@endsection