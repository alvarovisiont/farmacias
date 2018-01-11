@extends('layouts.app')
@section('view_descrip')
	@php
		$fecha = new DateTime($sale->created_at);
		$fecha->modify('-5 hours');
		$fecha = $fecha->format('d-m-Y H:i:s');
	@endphp
    Detalles de la venta del {{ $fecha }}
@endsection
@section('content')
	<a href="{{route('sale.index')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>&nbsp;Volver a la vista de ventas</a>
	<br /><br/>
	<ul class="nav nav-pills nav-justified"> 
		<li class="active"><a href="#data_sale" data-toggle="pill">Datos de la Venta</a></li>
		<li class=""><a href="#details_sale" data-toggle="pill">Detalles de la venta</a></li>
		<li class=""><a href="#data_client" data-toggle="pill">Datos del Cliente</a></li>
	</ul>

	<div class="tab tab-content">
		<div class="tab-pane fade in active" id="data_sale" rol="tabpanel">
			<br />
			<table class="table table-bordered table-hover">
				<tbody class="text-center">
					<tr>
						<td><b>Fecha</b></td>
						<td><b>Factura</b></td>
						<td><b>Método Pago</b></td>
						<td><b>Iva Descuento</b></td>
						<td><b>Total</b></td>
					</tr>
					<tr>
						<td>{{ $fecha }}</td>
						<td>{{ $sale->invoice }}</td>
						<td>{{ $sale->pay_mode }}</td>
						<td>{{ $sale->iva_config_global }}</td>
						<td>{{ number_format($sale->total,2,',','.') }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="tab-pane" id="details_sale" role="tabpanel">
			<br />
			<table class="table table-bordered table-hover">
				<tbody class="text-center">
					@foreach($sale->details_sale as $row)
						<tr>
							<td style="border-top: 1px solid lightgray"><b>Producto</b></td>
							<td style="border-top: 1px solid lightgray"><b>Componente</b></td>
							<td style="border-top: 1px solid lightgray"><b>Precio</b></td>
							<td style="border-top: 1px solid lightgray"><b>Cantidad</b></td>
							<td style="border-top: 1px solid lightgray"><b>Iva%</b></td>
						</tr>
						<tr>
							<td>{{ $row->stock->product }}</td>
							<td>{{ $row->stock->component }}</td>
							<td>{{ $row->price }}</td>
							<td>{{ $row->quantity }}</td>
							<td>{{ $row->config_currencies_iva == 0 ? 'Excento' : $row->config_currencies_iva }}</td>
						</tr>
						<tr>
							<td><b>Descuento%</b></td>
							<td><b>Total</b></td>
						</tr>
						<tr>
							<td>{{ $row->config_currencies_discount == 0 ? 'Excento' : $row->config_currencies_discount }}</td>
							<td>{{ number_format($row->total,2,',','.') }}</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="tab-pane" id="data_client" rol="tabpanel">
			<br />
			<table class="table table-bordered table-hover">
				<tbody class="text-center">
					<tr>
						<td><b>Nombre Completo</b></td>
						<td><b>Cédula</b></td>
						<td><b>Teléfono</b></td>
						<td><b>Dirección</b></td>
						<td><b>Correo</b></td>
					</tr>
					<tr>
						<td>{{ $sale->client_sale->name_complete }}</td>
						<td>{{ $sale->client_sale->cedula }}</td>
						<td>{{ $sale->client_sale->number }}</td>
						<td>{{ $sale->client_sale->address }}</td>
						<td>{{ $sale->client_sale->email }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection
@section('script')
@endsection