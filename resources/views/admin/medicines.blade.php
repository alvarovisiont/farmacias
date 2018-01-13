@extends('layouts.app')
@section('view_descrip')
	Filtros para buscar los productos en los inventarios de las farmacias
@endsection
@section('content')
	<div class="row no-gutters">
		<form action="" class="form-horizontal" method="POST" id="form_buscar">
			{{ csrf_field()}}
			<div class="form-group">
				<label for="estados" class="control-label col-md-2 col-sm-2">Estados</label>
				<div class="col-md-4 col-sm-4">
					<select name="estados" id="estados" class="form-control data">
						<option value=""></option>
						@foreach($estados as $row)
							<option value="{{ $row->id }}">{{ $row->estado }}</option>
						@endforeach
					</select>
				</div>
				<label for="municipios" class="control-label col-md-2 col-sm-2">Municipio</label>
				<div class="col-md-4 col-sm-4">
					<select name="municipios" id="municipios" class="form-control data">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="parroquias" class="control-label col-md-2 col-sm-2">Parroquias</label>
				<div class="col-md-4 col-sm-4">
					<select name="parroquias" id="parroquias" class="form-control data">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="product" class="control-label col-md-2 col-sm-2">Producto</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="product" name="product" class="form-control data">
				</div>
				<label for="component" class="control-label col-md-2 col-sm-2">Componente</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="component" name="component" class="form-control data">
				</div>
			</div>
			<div class="form-group">
				<label for="quantity" class="control-label col-md-2 col-sm-2">Cantidad</label>
				<div class="col-md-4 col-sm-4">
					<input type="number" id="quantity" name="quantity" class="form-control data" placeholder="Límite de cantidad del producto en inventario">
				</div>
				<label for="fecha_expension" class="control-label col-md-2 col-sm-2">Fecha Expensión</label>
				<div class="col-md-4 col-sm-4">
					<input type="text" id="fecha_expension" name="fecha_expension" class="form-control data fecha">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
					<button type="submit" class="btn btn-block btn-danger" id="btn_buscar">Buscar&nbsp;<i class="fa fa-send"></i></button>
				</div>
			</div>
		</form>		
	</div>
	<div class="row no-gutters oculto">
		<table class="table table-bordered table-responsive table-hover" id="table">
			<thead>
				<tr>
					<th class="text-center">Farmacia</th>
					<th class="text-center">Est/Mun/Parro</th>
					<th class="text-center">Director</th>
					<th class="text-center">Producto</th>
					<th class="text-center">Componente</th>
					<th class="text-center">Cantidad</th>
					<th class="text-center">Fecha Expensión</th>
				</tr>
			</thead>
			<tbody class="text-center">
				
			</tbody>
		</table>
	</div>

@endsection
@section('script')
	<script>
		$(function(){
			$('#estados').change(function(e){
				$('#municipios').empty()
				$('#parroquias').empty()

				$.ajax({
					url: '{{ route('municipios.ajax') }}',
					type: 'GET',
					dataType: 'JSON',
					data: {estado: e.currentTarget.value},
				})
				.done(function(data) {
					var options = "<option></option>";

					$.grep(data, function(e,i){
						options+= "<option value='"+e.id_municipio+"'>"+e.municipio+"</option>"
					})

					$("#municipios").html(options)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			})

			$('#municipios').change(function(e){
				$('#parroquias').empty()

				var estado = $('#estados').val(),
					municipio = e.currentTarget.value

				$.ajax({
					url: '{{ route('parroquias.ajax') }}',
					type: 'GET',
					dataType: 'JSON',
					data: {estado, municipio},
				})
				.done(function(data) {
					var options = "<option></option>";

					$.grep(data, function(e,i){
						options+= "<option value='"+e.id+"'>"+e.parroquia+"</option>"
					})

					$("#parroquias").html(options)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			})

			$('#form_buscar').submit(function(e) {
				
				e.preventDefault()

				$('.oculto').slideUp('slow/400/fast')

				var validate = false

				$(this).find('.data').each(function(e){

					validate = $(this).val() !== "" ? true : validate
				})

				if(validate)
				{
					$('#table').DataTable().destroy()

					$('#btn_buscar').text('Cargando......')

					$.ajax({
						url: '{{ route("admin.medicines.filter") }}',
						type: 'GET',
						dataType: 'JSON',
						data: $(this).serialize(),
					})
					.done(function(data) {

						var rows = ""
						$.grep(data,function(i,e){
							rows += "<tr><td>"+i.nombre_farmacia+"</td><td>"+i.estado+"<br/>"+i.municipio+"<br/>"+i.parroquia+"</td><td>"+i.director+"</td><td>"+i.product+"</td><td>"+i.component+"</td><td>"+i.quantity+"</td><td>"+i.date_of_expense+"</td></tr>"
						})

						$('#table').children('tbody').empty().html(rows)
						$('#table').dataTable()

						$('#btn_buscar').html('Buscar&nbsp;<i class="fa fa-send"></i>')
						$('.oculto').show('slow/400/fast')
					})
					.fail(function() {
						console.log("error");
					})
					.always(function() {
						console.log("complete");
					});
				}
				else
				{
					alert('Debe escoger al menos 1 filtro para realizar la busqueda')

					return false	
				}
			});
		})
	</script>
@endsection