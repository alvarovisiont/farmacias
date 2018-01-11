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
		</tbody>
	</table>
	<br />
	<div class="row no-gutters">
		<div class="col-md-3 col-sm-3">
			<a href="{{route('stocktaking.index')}}" class="btn btn-default">Volver&nbsp;<i class="fa fa-arrow-left"></i></a>
		</div>
		@if(Auth::user()->authorized())
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