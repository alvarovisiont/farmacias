<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th class="text-center">Producto</th>
				<th class="text-center">Componente</th>
				<th class="text-center">Proveedor</th>
				<th class="text-center">Grupo</th>
				<th class="text-center">Marca</th>
				<th class="text-center">Cantidad</th>
				<th class="text-center">Precio Venta</th>
				<th class="text-center">Precio Compra Proveedor</th>
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
					<td class="text-center"> {{ number_format($row->price,2,',','.') }} </td>
					<td class="text-center"> {{ number_format($row->buying_price_provider,2,',','.') }} </td>
					<td class="text-center"> {{ $row->quantity }} </td>
					<td class="text-center"> {{ date('d-m-Y', strtotime($row->buying_date) ) }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>