<?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w',strtotime("- 5 hour"))]." ".date('d',strtotime("- 5 hour"))." de ".$meses[date('n')-1]. " del ".date('Y');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<style>
		.logo
		{
			float: left;
		}
		.clear{
		clear: both;
		}
	</style>
</head>
<body>
	
	<div>
		@if($config)
			<img src="{{ asset('img/logo/'.$config->logo) }}" alt="" width="10%" height="40px">
		@endif	
	</div>
	<br/>
	<b class=""><?php echo $fecha; ?></b>

	<div class="text-center">
		<h3>{{$config->nombre_farmacia}}</h3>
	</div>
	<br/>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td colspan="8" class="text-center">Inventario</td>
			</tr>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Código</th>
				<th class="text-center">Producto</th>
				<th class="text-center">Componente</th>
				<th class="text-center">Proveedor</th>
				<th class="text-center">Grupo</th>
				<th class="text-center">Marca</th>
				<th class="text-center">Cantidad</th>
				<th class="text-center">Fecha Adquisión</th>
			</tr>
		</thead>
		<tbody class="text-center">
			@foreach($stock as $row)
				@php 
					$con++;
				@endphp
				<tr>
					<td class="text-center"> {{ $con }} </td>
					<td class="text-center"> {{ $row->code_product }} </td>
					<td class="text-center"> {{ $row->product }} </td>
					<td class="text-center"> {{ $row->component }} </td>
					<td class="text-center"> {{ $row->provider_product->name }} </td>
					<td class="text-center"> {{ $row->group_product->name }} </td>
					<td class="text-center"> {{ $row->trademark_product->name }} </td>
					<td class="text-center"> {{ $row->quantity }} </td>
					<td class="text-center"> {{ date('d-m-Y', strtotime($row->buying_date) ) }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>