@extends('layouts.app')
@section('view_descrip')
	Buscar farmacias para ver las Compras
@endsection
@section('content')
	<div class="row no-gutters">
		<form action="" class="form-horizontal" method="POST" id="form_buscar" enctype="multipart/form-data">
			{{ csrf_field()}}
			<div class="form-group">
				<label for="estados" class="control-label col-md-2 col-sm-2">Estados</label>
				<div class="col-md-4 col-sm-4">
					<select name="estados" id="estados" required="" class="form-control">
						<option value=""></option>
						@foreach($estados as $row)
							<option value="{{ $row->id }}">{{ $row->estado }}</option>
						@endforeach
					</select>
				</div>
				<label for="municipios" class="control-label col-md-2 col-sm-2">Municipio</label>
				<div class="col-md-4 col-sm-4">
					<select name="municipios" id="municipios" required="" class="form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="parroquias" class="control-label col-md-2 col-sm-2">Parroquias</label>
				<div class="col-md-4 col-sm-4">
					<select name="parroquias" id="parroquias" required="" class="form-control">
						<option value=""></option>
					</select>
				</div>
				<label for="pharmacy_id" class="control-label col-md-2 col-sm-2">Farmacias</label>
				<div class="col-md-4 col-sm-4">
					<select name="pharmacy_id" id="pharmacy_id" required="" class="form-control">
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="file" class="control-label col-md-2 col-sm-2">Archivo</label>
				<div class="col-md-4 col-sm-4">
					<input type="file" id="file" name="file" required="">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
					<button type="submit" class="btn btn-block btn-danger" id="btn_buscar">Importar&nbsp;<i class="fa fa-arrow-up"></i></button>
				</div>
			</div>
		</form>		
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

			$('#parroquias').change(function(e) {
				var parro = $(this).val(),
					muni  = $('#municipios').val(),
					esta  = $('#estados').val()

				$.ajax({
					url: '{{ route("admin.find_pharmacys") }}',
					type: 'GET',
					dataType: 'JSON',
					data: {estado: esta, municipio: muni, parroquia: parro},
				})
				.done(function(data) {
					var options = "<option></option>";

					$.grep(data,function(i,e){
						options += "<option value='"+i.user_id+"'>"+i.nombre_farmacia+"</option>"
					})

					$('#pharmacy_id').html(options)

				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});

			$('#form_buscar').submit(function(e) {
				
				e.preventDefault()

				$('#btn_buscar').html('Cargando...&nbsp;<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>')

				var form_data = new FormData($('#form_buscar')[0]);

				$.ajax({
					url: '{{ route("admin.pharmacy.import.excel")}}',
					type: 'POST',
					dataType: 'JSON',
					data: form_data,
					cache: false,
					contentType: false,
                	processData: false
				})
				.done(function(data) {
					
					$('#btn_buscar').html('Importar&nbsp;<i class="fa fa-arrow-up"></i>')
					
				})
			});

		})
	</script>
@endsection