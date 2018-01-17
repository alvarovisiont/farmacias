@extends('layouts.app')
@section('content')
	<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
					<h4>Escoja su archivo Excel  <a href="{{ route($ruta_descarga) }}" class="pull-right letras-medianas">Descargar Archivo de Ejemplo&nbsp;<i class="fa fa-external-link"></i></a></h4>
					<h5 class="text-center">( Productos con códigos repetidos no seran importados )</h5>
			</div>
			<div class="panel-body">
				<form action="{{url($ruta)}}" class="form-horizontal" id="form_registrar" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
	
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul class="text-center">
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<div class="form-group">
						<label for="excel_file" class="control-label col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1">Archivo Excel</label>
						<div class="col-md-3 col-sm-3">
							<input type="file" id="excel_file" name="excel_file" required="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
							<button type="submit" class="btn btn-block btn-danger">Importar&nbsp;<i class="fa fa-send"></i></button>
						</div>
					</div>
				</form>
				<p class="alert alert-danger text-center oculto" id="no_excel">El archivo seleccionado no es de tipo excel</p>
				<p class="alert alert-danger text-center oculto" id="error_database">El archivo seleccionado no es de tipo excel</p>
				<p class="alert alert-success text-center oculto">No ha ocurrido ningún error, proceso completado con éxito</p>
			</div>
			<ul class="list-group" id="lista">
				
			</ul>
		</div>	
	</div>
@endsection
@section('script')
	<script>
		$(function(){
			$('#form_registrar').submit(function(e){
				e.preventDefault()

				var new_data = new FormData($('#form_registrar')[0])

				$.ajax({
					url: $(this).attr('action'),
					type: 'POST',
					dataType: 'JSON',
					data: new_data,
					contentType: false,
					processData: false,
					cache: false
				})
				.done(function(data) {
					if(!data.r)
					{
						

						if(data.error === undefined)
						{
							$('#no_excel').show('slow/400/fast').not('.alert-importat').delay(25000).hide('slow/400/fast')
						}
						else
						{
							$('#error_database').text('Ha ocurrido un error con los datos cargados en el excel, porfavor descargue el modo de prueba y verifique que los datos en su excel correspondan con los indicados en excel de ejemplo.').show('slow/400/fast').not('.alert-importat').delay(7000).hide('slow/400/fast')	
						}
					}
					else
					{
							$('.alert-success').show('slow/400/fast').not('.alert-importat').delay(1000).hide('slow/400/fast')	
					}


					var rows = "";
					$.grep(data.p_not_imported, function(i,e){
						rows += "<li class='list-group-item'>"+i+"</li>"
					})

					$('#lista').empty().append(rows);
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		})
	</script>
@endsection