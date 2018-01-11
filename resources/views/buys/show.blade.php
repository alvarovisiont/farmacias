@extends('layouts.app')
@section('view_descrip')
	@php
		$fecha = new DateTime($buy->created_at);
		$fecha->modify('-5 hour');
		$fecha = $fecha->format('d-m-Y H:i:s');
	@endphp

    Datos de la compra del {{ $fecha }} 
@endsection

@section('content')
	<div class="row no-gutters">
		<div class="col-md-2 col-sm-2">
			<a href="{{ route('buy.index') }}" class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>
		</div>
		<div class="col-md-2 col-sm-2  col-md-offset-8 col-sm-offset-8">
			<a href="#" class="btn btn-danger btn-block eliminar" data-eliminar="{{ $buy->id }}"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
		</div>
	</div>
	<br /><br />
	<div class="row no-gutters">
		<table class="table table-hover table-bordered" id="table">
			<thead>
				<tr>
					<th class="text-center">Proveedor</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Total</th>
				</tr>
			</thead>
			<tbody class="text-center">
				@foreach ($buy->details_buy as $row)
					@php
						$total = $total + $row->total;
					@endphp
					<tr>
						<td>{{ $row->provider->name }}</td>
						<td>{{ $row->stock->product }}</td>
						<td>{{ $row->stock->buying_price_provider }}</td>
						<td>{{ $row->quantity }}</td>
						<td>{{ number_format($row->total,2,',','.') }}</td>
					</tr>
				@endforeach
					<tr class="alert alert-info">
						<td><b>Total</b></td>
						<td><b>Iva Aplicado:</b> {{ $buy->iva_config }}%</td>
						<td></td>
						<td></td>
						<td><b>{{ number_format($buy->total,2,',','.') }}<b></td>
					</tr>
			</tbody>
		</table>
	</div>
	<form action="{{ url('buy/'.':USER') }}" id="form_eliminar" method="POST">
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