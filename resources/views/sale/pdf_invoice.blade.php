<?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha = $dias[date('w',strtotime("- 5 hour"))]." ".date('d',strtotime("- 5 hour"))." de ".$meses[date('n')-1]. " del ".date('Y');

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title></title>
<style type="text/css">
html {
  margin: 0;
}
body {
  font-family: "Arial", serif;
  
}

table {     font-family: "Arial", "Lucida Grande", Sans-Serif;
    font-size: 12px;     width: 480px; text-align: center;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: bold;     padding: 8px;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid black; }

td {    padding: 8px; border-bottom: 1px solid black;
    border-top: 1px solid transparent; }

.centrar {
text-align: center;
}

.logo
{
	float: left;
}
.clear{
clear: both;
}

.div_proveedor
{
	border: solid 1px skyblue;
	width: 100%;
	height: 30px;
}

</style>
</head>
<body>
<header>
	<div class="clear"></div>
	<div class="logo">
		<?php echo $fecha; ?>
	</div>
	<div class="logo">
		@if($config)
			@if($config->logo)
				<img src="{{ asset('img/logo/'.$config->logo) }}" alt="" width="70px" height="70px" style='float: left; display:inline-block'>

			@endif
			<h2 class="centrar">{{$config->nombre_farmacia}}</h2>
		@endif
	</div>
	<div class="clear"></div>
	<div class="">
		<p><strong>Factura Nº </strong><span style="color: darkred;">{{$sale->invoice}}</span></p>
	</div>
	<div class="div_proveedor">
		<p>Nombre y Apellido o razón Social: <span style="text-decoration: underline;">{{ $client->name_complete }}</span></p>
		<p>Rif/C.I: <span style="text-decoration: underline;">{{ $client->cedula }}</span></p>
		<p>Domicilio Físcal: <span style="text-decoration: underline;">{{ $client->address }}</span></p>
	</div>
</header>
	<section>
		<br><br>
		<table width="100%" cellpadding="" border="1" cellspacing="" class="table">
  			<thead>
  			<tr>
    			<td colspan="8" style="font-size: 15px"><CENTER><strong style="text-decoration: underline;">Productos Comprados</strong></CENTER></td>
  			</tr>
				<tr>
					<th style="text-align: center;">Producto</th>
					<th style="text-align: center;">Componente</th>
					<th style="text-align: center;">Marca</th>
					<th style="text-align: center;">Precio</th>
					<th style="text-align: center;">Cantidad</th>
					<th style="text-align: center;">Descuento%</th>
					<th style="text-align: center;">Iva%</th>
					<th style="text-align: center;">Total</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				@php
					$total = 0;
				@endphp

				@foreach($sale->details_sale as $row) 
					@php
						$total = $total + $row->total;
					@endphp
					<tr>
						<td>{{ $row->stock->product }}</td>
						<td>{{ $row->stock->component }}</td>
						<td>{{ $row->stock->trademark_product->name }}</td>
						<td>{{ number_format($row->price,2,",",".") }}</td>
						<td>{{ $row->quantity }}</td>
						<td>{{ $row->config_currencies_discount }}</td>
						<td>{{ $row->config_currencies_iva }}</td>
						<td>{{ number_format($row->total,2,",",".") }}</td>
					</tr>
				@endforeach
					<tr>
						<td colspan="2">Total</td>
						<td colspan="6" align="right" style="padding-right: 9%"><strong>{{ number_format($sale->total,2,",",".") }}</strong></td>
					</tr>
			</tbody>
		</table>
		<br/><br/><br/><br/><br/><br/>
		<div style="width: 100%">
			<div style="width: 30%; float: left; padding-right: 5%;">
				<strong>Condiciones de Pago:</strong><br>
				Contado({{$sale->pay_mode == "efectivo" ? "x" : ''}}) Debito({{$sale->pay_mode == "efectivo" ? "" : 'x'}})
			</div>
			<div style="width: 30%; float: left; padding-right: 5%;">
				<strong>Esta factura va sin tachadura ni enmendadura</strong>
			</div>
			<div style="width: 30%;">
				<strong>Iva Descuento%: </strong>{{ $sale->iva_config_global }}
			</div>
		</div>
		<br><br>
		<div style="width: 100%">
			 <div style="width: 45%; float: left; padding-right: 10%">
				_____________________________________________<br>
				Nombre y Apellido de quien recibe Sello y Firma
			</div>
			<div>
				<span style="color: darkred">Copia: SIN DERECHO A CREDITO FíSCAL</span>
			</div>
		</div>
		<br>
	</section>
</body>
</html>

