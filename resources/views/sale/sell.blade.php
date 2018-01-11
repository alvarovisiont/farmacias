@extends('layouts.app')
@section('view_descrip')
    Módulo de Ventas
@endsection
@section('content')
	<form action="{{ route($route) }}" id="form_registrar" class="form-horizontal" method="POST">
		{{csrf_field()}}
		
		<!-- campos que se van a  guardar en el detalle de la venta -->
		<input type="hidden" id="product_id" name="product_id">
		<input type="hidden" id="total" name="total" step="any" value="0">
		<input type="hidden" id="iva_config_global" name="iva_config_global" value="{{ $validate ? $config->iva_porcentaje : '' }}">
		<!-- campo para la validación del producto y la construcción de la fila en la tabla de facturación -->
		<input type="hidden" id="total_quantity">
		<input type="hidden" id="validate_discount">
		<input type="hidden" id="validate_iva">
		<input type="hidden" id="validate_price">
		<input type="hidden" id="total_respaldo" name="total_respaldo" step="any" value="0">

		<div class="form-group">
			<label for="cedula" class="control-label col-md-2 col-sm-2">Cédula</label>
			<div class="col-md-4 col-sm-4">
				<input type="text" id="cedula" name="cedula" required="" class="form-control" value="{{$sell->cedula}}">
			</div>
			<div class="col-md-2 col-sm-2">
				<button type="button" class="btn btn-md btn-primary" id="btn_buscar">Buscar&nbsp;<i class="fa fa-search"></i></button>
			</div>
			<div class="col-md-2 col-sm-2">
				<button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#modal_clients" title="Buscar Cliente"><i class="fa fa-users"></i>&nbsp;<i class="fa fa-search"></i></button>
			</div>
			<div class="col-md-2 col-sm-2">
				<button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#modal_products" title="Ver Productos"><i class="fa fa-shopping-cart"></i>&nbsp;<i class="fa fa-search"></i></button>
			</div>
		</div>
		<p class="alert alert-danger text-center oculto" id="aviso">No se encuetra registrado un cliente con esa cédula</p>
		<h4>Datos del Cliente</h4>
		<br />
		<div class="form-group">
			<label for="name_complete" class="control-label col-md-2 col-sm-2">Nombre Completo</label>
			<div class="col-md-2 col-sm-2">
				<input type="text" id="name_complete" name="name_complete" required="" class="form-control" value="{{$sell->name_complete}}">
			</div>
			<label for="number" class="control-label col-md-2 col-sm-2">Teléfono</label>
			<div class="col-md-2 col-sm-2">
				<input type="number" id="number" name="number" required="" class="form-control" value="{{$sell->number}}">
			</div>
			<label for="email" class="control-label col-md-2 col-sm-2">Email</label>
			<div class="col-md-2 col-sm-2">
				<input type="email" id="email" name="email" class="form-control" value="{{$sell->email}}">
			</div>
		</div>
		<div class="form-group">
			<label for="address" class="control-label col-md-2 col-sm-2">Dirección</label>
			<div class="col-md-4 col-sm-4">
				<textarea name="address" id="address" rows="2" class="form-control" required="">{{$sell->address}}</textarea>
			</div>
			<label for="masculino" class="control-label col-md-2 col-sm-2">Genero</label>
			<div class="col-md-2 col-sm-2">
				<label for="masculino" class="radio-inline">
					<input type="radio" id="masculino" name="gender" value="masculino">
					Hombre
				</label>
				<label for="femenino" class="radio-inline">
					<input type="radio" id="femenino" name="gender" value="femenino">
					Mujer
				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="product_name" class="control-label col-md-2 col-sm-2">Producto</label>
			<div class="col-md-4 col-sm-4">
				<input type="text" id="product_name" name="product_name" readonly="" class="form-control" value="{{$sell->product_name}}">
			</div>
			<label for="quantity" class="control-label col-md-2 col-sm-2">Cantidad</label>
			<div class="col-md-4 col-sm-4">
				<input type="number" id="quantity" name="quantity" class="form-control" value="{{$sell->quantity}}" min="1">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
				<button type="button" class="btn btn-warning btn-block" id="btn_agg_table">Agregar&nbsp;<i class="fa fa-thumbs-up"></i></button>
			</div>
		</div>
		<table class="table table-bordered table-hover" id="table_invoice">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Precio</th>
					<th class="text-center">Descuento</th>
					<th class="text-center">Iva</th>
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
		<div class="form-group">
			<label for="client_pay" class="control-label col-md-2 col-sm-2">Pago Cliente</label>
			<div class="col-md-4 col-sm-4">
				<input type="number" id="client_pay" step="any" name="client_pay" required="" class="form-control" value="{{$sell->client_pay}}" min="0">
			</div>
			<div class="col-md-6 col-sm-6">
				<p class="oculto alert alert-danger text-center" id="aviso1"></p>
				<p class="oculto alert alert-success text-center" id="aviso2"></p>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
				@if(Auth::user()->authorized())
					<button type="submit" class="btn btn-primary btn-block" {{ !$validate ? 'disabled' : '' }} id="btn_invoice">Facturar&nbsp;
					<i class="fa fa-shopping-cart"></i>
					</button>
				@endif
				<a href="#" class="btn btn-danger btn-block oculto" id="btn_generate_invoice">Generar Factura&nbsp;<i class="fa fa-file-pdf-o"></i></a>
			</div>
		</div>
		<div class="form-group">
			@if(!$validate)
				<p class="alert alert-danger text-center">Necesita realizar la configuración global para poder facturar</p>
			@endif
		</div>
	</form>

<!-- ================================== || MODALES || ======================================== -->
	
	<div id="modal_products" class="modal fade" role="dialog">
	    <div class="modal-dialog modal-lg">
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header login-header">
	                <button type="button" class="close" data-dismiss="modal">×</button>
	                <h4 class="modal-title">Productos del Inventario</h4>
	            </div>
	            <div class="modal-body" id="modal_products_body">
	            	<table class="table table-hover table-responsive table-bordered" id="table_products">
						<thead>
							<tr>
								<th class="text-center">Producto</th>
								<th class="text-center">Componente</th>
								<th class="text-center">Precio</th>
								<th class="text-center">Iva%</th>
								<th class="text-center">Descuento%</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Escoger</th>
							</tr>
						</thead>
						<tbody class="text-center">
						</tbody>
					</table>
	            </div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </div><!-- fin modal-content -->
	    </div><!-- fin modal-dialog -->
	</div> <!-- fin modal -->

	<div id="modal_clients" class="modal fade" role="dialog">
	    <div class="modal-dialog">
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header login-header">
	                <button type="button" class="close" data-dismiss="modal">×</button>
	                <h4 class="modal-title">Clientes Registrados</h4>
	            </div>
	            <div class="modal-body" id="modal_clients_body">
					<table class="table table-hover table-responsive table-bordered" id="table_clients">
						<thead>
							<tr>
								<th class="text-center">Nombre</th>
								<th class="text-center">Cédula</th>
								<th class="text-center">Télefono</th>
								<th class="text-center">Genero</th>
								<th class="text-center">Escoger</th>
							</tr>
						</thead>
						<tbody class="text-center">
						</tbody>
					</table>
	            </div><!-- fin modal-body -->
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </div><!-- fin modal-content -->
	    </div><!-- fin modal-dialog -->
	</div> <!-- fin modal -->
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
		      	
//** =========================== // Buscar Clientes y Productos // ===================================== **//

			$('#cedula').keypress(function(e) {
				if(e.keyCode == 13)
				{
					$('#btn_buscar').click()
					return false
				}
			});

			$('#quantity').keypress(function(e) {
				if(e.keyCode == 13)
				{
					$('#btn_agg_table').click()
					return false
				}
			});

			$('#btn_buscar').click(function(e){
				
				// función para buscar los datos del cliente mediante el campo de busqueda de cedula

				var cedula = $('#cedula').val()
				
				if(cedula == "")
				{
					alert('Debe introducir una cédula para ser buscado los datos del cliente')
					return false
				}

				$(this).html('<i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>')



				$.ajax({
					url: '{{ route("search.clients") }}',
					type: 'GET',
					dataType: 'JSON',
					data: {cedula},
				})
				.done(function(data) {

					$("#btn_buscar").html('Buscar&nbsp;<i class="fa fa-search"></i>')

					if(Object.keys(data).length === 0)
					{
						$('#name_complete').val('')
						$('#number').val('')
						$('input[name="gender"]').prop('checked',false)
						$('#email').val('')
						$('#address').empty('')
						$('#aviso').show('slow/400/fast').not('.alert-important').delay(2000).slideUp(300)
					}
					else
					{
						var email = data.email === "null" ? '' : data.email

						$('#name_complete').val(data.name_complete)
						$('#number').val(data.number)
						$('input[name="gender"][value="'+data.gender+'"]').prop('checked',true)
						$('#email').val(email)
						$('#address').text(data.address)
					}
				})
			})

			$('#modal_clients').on('show.bs.modal',function(e){

				// función para buscar los clientes en caso de que se quiera escoge uno desde la modal clientes

				$('#table_clients').DataTable().destroy()
				
				$('#table_clients tbody').empty().html('<tr><td colspan="5">Buscando Clientes Registrados...</td></tr>')

				$.ajax({
					url: '{{ route("search.clients.all") }}',
					type: 'GET',
					dataType: 'JSON',
				})
				.done(function(data) {
					
					if(Object.keys(data).length > 0)
					{
						var filas = "";

						$.grep(data,function(i,e){

							var button = "<button type='button' class='btn btn-danger btn-sm escoger' data-cedula='"+i.cedula+"'data-name_complete='"+i.name_complete+"' data-email='"+i.email+"' data-address='"+i.address+"' data-number='"+i.number+"' data-gender='"+i.gender+"'><i class='fa fa-share'></i></button>"

							filas+= "<tr><td>"+i.name_complete+"</td><td>"+i.cedula+"</td><td>"+i.number+"</td><td>"+i.gender+"</td><td>"+button+"</td></tr>"
						})

						$('#table_clients tbody').empty().html(filas)

						
						$('#table_clients').dataTable({
							language: {url: '../json/esp.json'}
						})

					}
					else
					{
						$('#table_clients tbody').empty().html('<tr><td colspan="5">No existen clientes registrados aún</td></tr>')
					}
				})

			})

			$('#table_clients').children('tbody').on('click','tr > td > .escoger', function(e){
				
				// al cargarse la modal clientes si se escoge uno se cargan los datos del cliente en el formulario
				var email = e.currentTarget.dataset.email === "null" ? '' : e.currentTarget.dataset.email
				

				$('#cedula').val(e.currentTarget.dataset.cedula)
				$('#name_complete').val(e.currentTarget.dataset.name_complete)
				$('#number').val(e.currentTarget.dataset.number)
				$('input[name="gender"][value="'+e.currentTarget.dataset.gender+'"]').prop('checked',true)
				$('#email').val(email)
				$('#address').text(e.currentTarget.dataset.address)

				$('#modal_clients').modal('hide')
			})

			$('#modal_products').on('show.bs.modal',function(){

				// modal para buscar el producto a cargar

				$('#table_products').DataTable().destroy()
				
				$('#table_products tbody').empty().html('<tr><td colspan="5">Buscando Productos Registrados...</td></tr>')

				$.ajax({
					url: '{{ route("search.products.all") }}',
					type: 'GET',
					dataType: 'JSON',
				})
				.done(function(data) {
					
					if(Object.keys(data).length > 0)
					{
						var filas = "";

						$.grep(data,function(i,e){

							var iva_product = 0,
								discount    = 0,
								data_iva    = 0,
								data_dis    = 0

							if(i.iva_product === undefined)
							{
								iva_product = "(Excento) <br/>"+i.config_currencies_iva_id
							}
							else
							{
								iva_product = i.iva_product.percentage
								data_iva    = i.iva_product.percentage
							}

							if(i.discount_product === undefined)
							{
								discount = "(Excento) <br/>"+i.config_currencies_discount_id
							}
							else
							{
								discount = i.discount_product.percentage
								data_dis = i.discount_product.percentage
							}

							var button = "<button type='button' class='btn btn-danger btn-sm pick_product' data-product='"+i.product+"' data-product_id='"+i.id+"' data-quantity='"+i.quantity+"' data-iva='"+data_iva+"' data-discount='"+data_dis+"' data-price='"+i.price+"' ><i class='fa fa-share'></i></button>"

							filas+= "<tr><td>"+i.product+"</td><td>"+i.component+"</td><td>"+i.price+"</td><td>"+iva_product+"</td><td>"+discount+"</td><td>"+i.quantity+"</td><td>"+button+"</td></tr>"
						})

						$('#table_products tbody').empty().html(filas)

						
						$('#table_products').dataTable({
							language: {url: '../json/esp.json'}
						})

					}
					else
					{
						$('#table_products tbody').empty().html('<tr><td colspan="5">No existen productos registrados aún</td></tr>')
					}
				})
			})

			$('#table_products').children('tbody').on('click','tr > td > .pick_product', function(e){
				
				// Una vez seleccionado el producto se cargan sus valores en los campos

				$('#product_name').val(e.currentTarget.dataset.product)
				$('#product_id').val(e.currentTarget.dataset.product_id)
				$('#total_quantity').val(e.currentTarget.dataset.quantity)
				$('#validate_iva').val(e.currentTarget.dataset.iva)
				$('#validate_discount').val(e.currentTarget.dataset.discount)
				$('#validate_price').val(e.currentTarget.dataset.price)
				$('#modal_products').modal('hide')
			})

//** =========================== // Agg Productos a Tabla Factura // ===================================== **//
			
			$('#btn_agg_table').click(function(){

				// función para agg productos a la tabla de facturación

				if($('#product_name').val() == "")
				{
					alert('Debe escoger un producto a facturar')
					return false
				}

				if($('#quantity').val() == "")
				{
					alert('Debe escoger una cantidad del producto seleccionado a facturar')
					return false
				}

				if(parseInt($('#quantity').val(),10) > parseInt($('#total_quantity').val(),10) )
				{
					alert('No existe esa cantidad para ese producto en el almacen')
					return false
				}

				var fila 			= "",
					button 			= "",
					product_name	= $('#product_name').val(),
					product_id    	= $('#product_id').val(),
					price 			= parseFloat($('#validate_price').val()),
					iva   			= parseFloat($('#validate_iva').val()),
					discount 		= parseFloat($('#validate_discount').val()),
					quantity    	= parseInt($('#quantity').val(),10),
					iva_sum	    	= 0,
					discount_res	= 0,
					total 			= price * quantity,
					total_acumulado	= parseFloat($('#total').val()),
					total_respaldo	= parseFloat($('#total_respaldo').val()),
					total_final     = 0,
					total_filas 	= $('#table_invoice').children('tbody').children('tr').size() + 1

				if(iva > 0)
				{
					iva_sum = total * iva / 100
					total 	= total + iva_sum
				}


				if(discount > 0)
				{
					discount_res = total * discount / 100
					total        = total - discount_res
				}


				$.ajax({
					url: '{{route("sales.products.temp")}}',
					type: 'GET',
					dataType: 'JSON',
					data: {product_id,price,quantity,total,iva,discount}
				})
				.done(function(data) {
					
					if(data.r)
					{
						

						button = "<button type='button' class='btn btn-danger btn-sm remove_product' data-product_id='"+product_id+"' data-price='"+total+"'><i class='fa fa-trash'></i></button>"

						fila = "<tr class='text-center'><td>"+total_filas+"</td><td>"+product_name+"</td><td>"+quantity+"</td><td>"+number_format(price,2,',','.')+"</td><td>"+discount+"</td><td>"+iva+"</td><td>"+number_format(total,2,',','.')+"</td><td>"+button+"</td></tr>"

						$('#table_invoice').children('tbody').append(fila)

						total_final = total_acumulado + total

						total_respaldo = total_respaldo + total

						$('#total').val(total_final)
						$('#total_respaldo').val(total_respaldo)
						$('#total_format').val(number_format(total_final,2,',','.'))

						$('input[name="pay_mode"]').prop('disabled',false)

						$('#product_name').val('');
						$('#quantity').val('');

					}
					else
					{
						alert('Este producto ya ha sido agregado al stock de factura')
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

				var product_id 	= e.currentTarget.dataset.product_id,
					price 		= e.currentTarget.dataset.price,
					tr    		= e.currentTarget.parentNode.parentNode,
					total_acumulado = parseFloat($('#total').val()),
					total_respaldo  = parseFloat($('#total_respaldo').val()),
					total 		= total_acumulado - price,
					total_filas = $('#table_invoice').children('tbody').children('tr').size() - 1

				tr.parentNode.removeChild(tr)

				total_respaldo = total_respaldo - price

				$('#total_format').val(number_format(total,2,',','.'))
				$('#total').val(total)	
				$('#total_respaldo').val(total_respaldo)	

				if(total_filas == 0)
				{
					$('input[name="pay_mode"]').prop({
						disabled:true,
						checked: false
					})

				}

				$.ajax({
					url: '{{route("sales.products.remove.temp")}}',
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

//** =========================== // Envio de Formulario // ===================================== **//

			$('#form_registrar').submit(function(e) {

				e.preventDefault()

				if($('#table_invoice').children('tbody').children('tr').size() == 0)
				{
					alert('Debe seleccionar un producto para poder facturar')
					return false
				}

				var client_pay  = parseFloat($('#client_pay').val()),
					total  		= parseFloat($('#total').val())


				if(total > client_pay)
				{
					var restante = number_format(total - client_pay,2,',','.')

					$('#aviso1').text('Fatan '+restante+"bsf para poder facturar").show('slow/400/fast').not('.alert-importat').delay(5000).slideUp(300)
					return false
				}
				else if(client_pay > total)
				{
					var agree = confirm('El cliente pago: '+number_format(client_pay,2,',','.')+" es correcto?" )

					if(agree)
					{
						var restante = number_format(client_pay - total,2,',','.')
						$('#aviso2').text('Se debe dar vuelto al cliente de '+restante).show('slow/400/fast')
					}
					else
					{
						return false
					}
				}
				else if(client_pay === total)
				{
					var agree = confirm('El cliente pago: '+number_format(client_pay,2,',','.')+" es correcto?" )
					if(agree)
					{
						var restante = 0
						$('#aviso2').text('Pago sin residuo!').show('slow/400/fast')
					}
					else
					{
						return false;
					}
				}

				$.ajax({
					url: '{{ route($route) }}',
					type: 'POST',
					dataType: 'JSON',
					data: $(this).serialize(),
				})
				.done(function(data) {
					if(data.r)
					{
						$('#btn_invoice').hide('slow/400/fast',function(){
							$('#btn_generate_invoice').show('slow/400/fast')
							$('#btn_generate_invoice').attr('sale_id',data.sale_id)
						})
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				

			});

//** =========================== // Generar Factura // ===================================== **//
			
			$('#btn_generate_invoice').click(function(e){
				e.preventDefault()
				var ruta = '{{ url("sale/invoice") }}'+"/"+e.currentTarget.getAttribute('sale_id')
				window.open(ruta,'_blank')
				$('#table_invoice').children('tbody').empty()
				$('#form_registrar')[0].reset()
				$('#aviso2').hide()
				$('#address').text('')
				$('#btn_generate_invoice').hide('slow/400/fast',function(e){
					$(this).removeAttr('sale_id')
				})

				$('#btn_invoice').show('slow/400/fast')
			})
		})

			

	</script>
@endsection