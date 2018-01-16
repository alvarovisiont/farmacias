@extends('layouts.app')
@section('view_descrip')
	Seguimiento del comprador
@endsection
@section('content')
	
	<h3 class="text-center"><span class="subrayado_rojo">Productos Adquiridos por el cliente</span></h3>
	<p class="text-center"><b>( Las filas en rojo representan los productos más necesitados )</b></p>
	<br/>
	<table class="table table-bordered table-hover oculto" id="table">
		<thead>
			<tr>
				<th class="text-center">Producto</th>
				<th class="text-center">Precio</th>
				<th class="text-center">Cantidad</th>
				<th class="text-center">Iva</th>
				<th class="text-center">Descuento</th>
				<th class="text-center">Total</th>
				<th class="text-center">Fecha Compra</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($buys as $row)
				@php
					
					$class = $row->quantity >= 10 ? 'alert alert-danger' : '';

					$fecha = new DateTime($row->created_at);
					$fecha->modify('-4 hour');
					$fecha = $fecha->format('d-m-Y H:i:s');

				@endphp
				<tr class="{{ $class }}">
					<td>{{ $row->stock->product }}</td>
					<td>{{ $row->price }}</td>
					<td>{{ $row->quantity }}</td>
					<td>{{ $row->config_currencies_iva }}</td>
					<td>{{ $row->config_currencies_discount }}</td>
					<td>{{ number_format($row->total,2,',','.') }}</td>
					<td>{{ $fecha }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
@section('script')
	<script>
		$(function(){
			setTimeout(function(){
				$('#table').show('slow/400/fast').addClass('animated slideInLeft')
			},500)
		})
	</script>
@endsection