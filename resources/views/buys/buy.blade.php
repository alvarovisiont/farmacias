@extends('layouts.app')
@section('view_descrip')
    Módulo de Compras&nbsp;<i class="fa fa-truck"></i>
@endsection
@section('content')
	<form action="{{ url($route) }}" id="form_registrar" class="form-horizontal" method="POST">
		{{csrf_field()}}
		
		<input type="hidden" name="total" id="total" value="0">
		<input type="hidden" name="total_respaldo" id="total_respaldo" value="0">
		<input type="hidden" id="iva_config_global" name="iva_config_global" value="{{ $validate ? $config->iva_porcentaje : '' }}">

		<div class="form-group">
			<label for="provider_id" class="control-label col-md-2 col-sm-2">Proveedor</label>
			<div class="col-md-4 col-sm-4">
				<select name="provider_id" id="provider_id" class="form-control">
					<option value=""></option>
					@foreach ($providers as $row)
						<option value="{{ $row->id }}">{{ $row->name }}</option>
					@endforeach
				</select>
			</div>
			<label for="stock_id" class="control-label col-md-2 col-sm-2">Producto</label>
			<div class="col-md-4 col-sm-4">
				<select name="stock_id" id="stock_id" class="form-control">
					<option value=""></option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="quantity" class="control-label col-md-2 col-sm-2">Cantidad</label>
			<div class="col-md-4 col-sm-4">
				<input type="number" id="quantity" name="quantity" class="form-control" value="{{ $buy->quantity}}">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
				<button type="button" class="btn btn-warning btn-block" id="btn-add">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			</div>
		</div>
		<br/>
		<table class="table table-bordered table-hover" id="table_invoice">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Total</th>
					<th class="text-center">Eliminar</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<div class="form-group">
			<label for="efectivo" class="control-label col-md-2 col-sm-2">Método Pago</label>
			<div class="col-md-2 col-sm-2">
				<label for="efectivo" class="radio-inline">
					<input type="radio" id="efectivo" name="pay_mode" value="efectivo" disabled="" required="">
					Efectivo
				</label>
			</div>
			<div class="col-md-2 col-sm-2">
				<label for="punto" class="radio-inline">
					<input type="radio" id="punto" name="pay_mode" value="punto" disabled="" required="">
					Punto
				</label>
			</div>
			<label for="total_format" class="control-label col-md-2 col-sm-2">Total a Pagar</label>
			<div class="col-md-4 col-sm-4">
				<input type="text" id="total_format" name="total_format" required="" readonly="" class="form-control">
			</div>
		</div>
		<br/>
		<div class="form-group">
			<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
				@if(Auth::user()->authorized())
					<button type="submit" class="btn btn-danger btn-block" {{ !$validate ? 'disabled' : '' }} id="btn_invoice">Comprar&nbsp;
					<i class="fa fa-shopping-cart"></i>
				</button>
				@endif
			</div>
		</div>
		<div class="form-group">
			@if(!$validate)
				<p class="alert alert-danger text-center">Necesita realizar la configuración global para poder facturar</p>
			@endif
		</div>
	</form>
@endsection
@section('script')
	<script>
		$(function(){

//** =========================== // Función para formater los números // ===================================== **//

		      function number_format (number, decimals, dec_point, thousands_sep) 
		      {
		        
		          number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		          var n = !isFinite(+number) ? 0 : +number,
		              prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		              sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		              dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		              s = '',
		              toFixedFix = function (n, prec) {
		                  var k = Math.pow(10, prec);

		                  return '' + Math.round(n * k) / k;
		              };
		          
		          s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		          if (s[0].length > 3) {
		              s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		          }
		          if ((s[1] || '').length < prec) {
		              s[1] = s[1] || '';
		              s[1] += new Array(prec - s[1].length + 1).join('0');
		          }
		          return s.join(dec);
		      }     


		   	$('#quantity').keypress(function(e){
		   		if(e.keyCode == 13)
		   		{
		   			$('#btn-add').click()
		   			return false
		   		}
		   	});

// ** ================================= Buscar Producto ====================================== ** //

			$('#provider_id').change(function(e){

				var provee = e.currentTarget.value

				$.ajax({
					url: '{{ route("products.by.provee") }}',
					type: 'GET',
					dataType: 'JSON',
					data: {provee},
				})
				.done(function(data) {
					var option = "<option></option>"

					$.grep(data, function(e,i){
						option += "<option value='"+e.id+"' price="+e.buying_price_provider+" product='"+e.product+"'>"+e.product+"</option>"
					})

					$('#stock_id').html(option)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			})

// ** ================================= agg Producto a la tabla factura ====================================== ** //

			$('#btn-add').click(function(e){
				var provider = $('#provider_id').val(),
					quantity = $('#quantity').val(),
					stock    = $('#stock_id'),
					total    = parseFloat($('#total').val()),
					total_respaldo = parseFloat($('#total_respaldo').val()),
					total_row= $('#table_invoice').children('tbody').children('tr').size(),
					next_row = total_row + 1 
				
				if(provider === "")
				{
					alert('Debe seleccionar un proveedor')
					$('#provider_id').focus()
					return false
				}
				
				if(stock.val() === "")
				{
					alert('Debe seleccionar un producto a comprar')
					$('#stock_id').focus()
					return false
				}

				if(quantity === "")
				{
					alert('Debe seleccionar la cantidad a comprar del producto seleccionado')
					$('#quantity').focus()
					return false
				}

				var product = stock.children('option[value="'+stock.val()+'"]'),
					price   = parseFloat(product.attr('price')),
					product = product.attr('product'),
					total_price_product = price * quantity

				$.ajax({
					url: '{{ route("buy.save.temp") }}',
					type: 'GEt',
					dataType: 'JSON',
					data: {stock: stock.val(), quantity, price, total: total_price_product, provider},
				})
				.done(function(data) {
					if(data.r)
					{
						button  = "<button class='btn btn-danger btn-sm remove_product' data-product='"+stock.val()+"' data-price='"+total_price_product+"'><i class='fa fa-remove'></i></button>",
						
						row   = "<tr class='text-center'><td>"+next_row+"</td><td>"+product+"</td><td>"+quantity+"</td><td>"+number_format(price,2,',','.')+"</td><td>"+number_format(total_price_product,2,',','.')+"</td><td>"+button+"</td></tr>"

						$('#table_invoice').children('tbody').append(row)

						total = total + total_price_product

						total_respaldo = total_respaldo + total_price_product

						$('#total').val(total)
						$('#total_respaldo').val(total_respaldo)	

						$('#total_format').val(number_format(total,2,',','.'))

						$('#quantity').val('')

						$('input[name="pay_mode"]').prop('disabled',false)
					}
					else
					{
						alert('El producto ya  ha sido registrado para la compra')
						return false
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				

				
					

			})

			$('#table_invoice').children('tbody').on('click','tr > td > .remove_product',function(e){

				// función para remover un producto de la tabla de facturación

				var product_id 	= e.currentTarget.dataset.product,
					price 		= e.currentTarget.dataset.price,
					tr    		= e.currentTarget.parentNode.parentNode,
					total_acumulado = parseFloat($('#total').val()),
					total 		= total_acumulado - price,
					total_respaldo  = parseFloat($('#total_respaldo').val()),
					total_filas = $('#table_invoice').children('tbody').children('tr').size() - 1

				tr.parentNode.removeChild(tr)

				total_respaldo = total_respaldo - price

				//$('#total_format').val(number_format(total,2,',','.'))
				$('#total').val(total)	
				$('#total_respaldo').val(total_respaldo)	
				$('#total_format').val(number_format(total,2,',','.'))

				if(total_filas == 0)
				{
					$('input[name="pay_mode"]').prop({
						disabled:true,
						checked: false
					})

				}

				$.ajax({
					url: '{{route("buys.products.remove.temp")}}',
					type: 'POST',
					data: {_token: "{{csrf_token()}}", product_id},
					cache: false,
				})
				.done(function(data) {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			})

			$('input[name="pay_mode"]').click(function(e){

				// función para aplicar iva si el pago es por punto

				var val = e.currentTarget.value,
					iva_punto = parseFloat($('#iva_config_global').val()),
					total = parseFloat($('#total').val()),
					total_respaldo = parseFloat($('#total_respaldo').val()),
					iva_res = 0
				
				if(val == "punto")
				{
					iva_res = total * iva_punto / 100
					total = total - iva_res

					$('#total').val(total)
					$('#total_format').val(number_format(total,2,',','.'))
				}
				else
				{
					$('#total').val(total_respaldo)
					$('#total_format').val(number_format(total_respaldo,2,',','.'))
				}
				
			})

			$('#form_registrar').submit(function(e){
				
				var filas = $('#table_invoice').children('tbody').children('tr').size()

				if(filas < 1)
				{
					alert('Debe ingresar algún producto a la tabla de factura para poder comprar')
					return false
				}

			})
		})
	</script>
@endsection