<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>

	<div class="text-center">
		@if($config)
			<img src="{{ asset('img/logo/'.$config->logo) }}" alt="" width="100%" height="80px">
			<br/><br/>
			{{$config->nombre_farmacia}}
		@endif
	</div>
	<br/>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td colspan="7" class="text-center">Inventario</td>
			</tr>
			<tr>
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
				<tr>
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