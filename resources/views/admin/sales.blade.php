@extends('layouts.app')
@section('view_descrip')
	Buscar farmacias para ver las Ventas
@endsection
@section('content')
	<div class="row no-gutters">
		<form action="" class="form-horizontal" method="POST" id="form_buscar">
			{{ csrf_field()}}
			<div class="form-group">
				<label for="estados" class="control-label col-md-2 col-sm-2">Estados</label>
				<div class="col-md-4 col-sm-4">
					<select name="estados" id="estados" class="form-control">
						<option value=""></option>
						@foreach($estados as $row)
							<option value="{{ $row->id }}">{{ $row->estado }}</option>
						@endforeach
					</select>
				</div>
				<label for="municipios" class="control-label col-md-2 col-sm-2">Municipio</label>
				<div class="col-md-4 col-sm-4">
					<select name="municipios" id="municipios" class="form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="parroquias" class="control-label col-md-2 col-sm-2">Parroquias</label>
				<div class="col-md-4 col-sm-4">
					<select name="parroquias" id="parroquias" class="form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
					<button type="submit" class="btn btn-block btn-primary" id="btn_buscar">Buscar&nbsp;<i class="fa fa-send"></i></button>
				</div>
			</div>
		</form>		
	</div>
	<div class="row no-gutters">
		<table class="table table-bordered table-responsive table-hover" id="table">
			<thead>
				<tr>
					<th class="text-center">Farmacia</th>
					<th class="text-center">Director</th>
					<th class="text-center">Teléfono</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Total Productos</th>
					<th class="text-center">Ver Ventas</th>
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

				$('#btn_buscar').html('Cargando....')
				$('#table').DataTable().destroy()

				$.ajax({
					url: '{{ route("admin.stocktaking.pharmacy") }}',
					type: 'GET',
					dataType: 'JSON',
					data: $(this).serialize(),
					cache: false
				})
				.done(function(data) {
					$('#btn_buscar').html('Buscar&nbsp;<i class="fa fa-send"></i>')
					
					var rows = ''

					$.grep(data,function(i,e) {
						rows+= '<tr><td>'+i.nombre_farmacia+'</td><td>'+i.director+'</td><td>'+i.director_number+'</td><td>'+i.director_email+'</td><td>'+i.cantidad+'</td><td class="letras-medianas"><a href="#" class="ver_ventas" target="" user_id='+i.user_id+'><i class="fa fa-external-link-square"></i></a></td></tr>'
					})

					$('#table').children('tbody').empty().html(rows)
					$('#table').dataTable()
				})
			});

			$('#table').children('tbody').on('click','tr td .ver_ventas',function(e){
				e.preventDefault()

				let id = e.currentTarget.getAttribute('user_id'),
					route = "{{ url('admin/sales/pharmacy/view') }}"+"/"+id

				window.open(route, '_blank')

			})
		})
	</script>
@endsection