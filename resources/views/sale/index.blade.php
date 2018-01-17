@extends('layouts.app')
@section('view_descrip')
    
@endsection
@section('content')
	<div class="row">
	  <!-- Apply any bg-* class to to the icon to color it -->
	    <div class="col-sm-3 col-md-3">
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	                <div class="row no-gutters">
	                    <div class="col-md-3 col-sm-3">
	                        <i class="fa fa-shopping-cart fa-5x" class="rotate_div"></i>
	                    </div>
	                    <div class="col-md-9 col-sm-9 text-right">
	                        <div class="huge"></div>
	                        <div>Ventas</div>
	                        <div style="font-size: 2em;" id="total_registros">{{ count($sales) }}</div>
	                    </div>
	                </div>
	            </div>
	            <a href="#">
	                <div class="panel-footer">
	                    <span class="pull-left">Totales</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	    </div>
	</div>
	@include('partials.flash')
	<div class="box box-warning color-palette-box">
	    <div class="box-header with-border">
	      	<h2 class="box-title"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Ventas Registradas</h2>
	      	<div class="pull-right">
	      		@if(Auth::user()->nivel > 1)
	       			<a href="{{ route('sale.sell') }}" class="btn btn-success btn-flat btn-md pull-right">Registrar Ventas&nbsp;&nbsp;<i class="fa fa-pencil"></i><i class="fa fa-plus"></i></a>
	       		@endif
	      	</div>
	    </div>
	    <div class="box-body">
	    	<table class="table table-bordered table-hover" id="table">
	    		<thead>
	    			<tr>
	    				<td class="text-center">Fecha</td>
	    				<td class="text-center">Factura</td>
	    				<td class="text-center">Método Pago</td>
	    				<td class="text-center">Iva Descuento</td>
	    				<td class="text-center">Total</td>
	    				<td class="text-center">Acciones</td>
	    			</tr>
	    		</thead>
	    		<tbody class="text-center">
	    			@foreach($sales as $row)
	    				@php
	    					$fecha = new DateTime($row->created_at);
	    					$fecha->modify('-5 hours');
	    					$fecha = $fecha->format('d-m-Y H:i:s');
	    				@endphp
	    				<tr>
	    					<td>{{ $fecha }}</td>
	    					<td>{{ $row->invoice }}</td>
	    					<td>{{ $row->pay_mode }}</td>
	    					<td>{{ $row->iva_config_global }}</td>
	    					<td>{{ number_format($row->total,2,',','.') }}</td>
	    					<td>
	    						<a href="{{ route('sale.show.details',['id' => $row->id]) }}" class="letras-medianas" title="Ver detalles"><i class="fa fa-search fa-1x"></i></a>
                                <a href="{{ url("sale/invoice/".$row->id) }}" target="_blank" class="letras-medianas" title="Imprimir Factura"><i class="fa fa-download fa-1x"></i></a>
	    					</td>
	    				</tr>
	    			@endforeach
	    		</tbody>
	    	</table>
	    </div>
	</div>
@endsection
@section('script')
@endsection