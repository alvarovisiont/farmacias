@extends('layouts.app')
@section('view_descrip')
	Importar Ventas
@endsection
@section('content')
	<div class="row no-gutters">
		<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Suba su archivo excel <a href="{{ route($ruta_descarga) }}" class="pull-right letras-medianas">Descargar Archivo de Ejemplo&nbsp;<i class="fa fa-external-link"></i></a></h4>
				</div>
				<div class="panel-body">
					<form action="{{url($ruta)}}" class="form-horizontal" id="form_buscar" method="POST">
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
							<label for="file_excel" class="control-label col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1">Suba su archivo</label>
							<div class="col-md-4 col-sm-4">
								<input type="file" id="file_excel" name="file_excel" required="">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
								<button type="submit" class="btn btn-block btn-danger" id="btn_buscar">Importar&nbsp;<i class="fa fa-send"></i></button>
							</div>
						</div>
					</form>
					<p class="alert alert-danger text-center oculto" id="no_excel">El archivo seleccionado no es de tipo excel</p>
					<p class="alert alert-danger text-center oculto" id="error_database">Ha ocurrido un error al importar los datos, por favor siga al pie de la letra las intrucciones en el excel de ejemplo</p>
					<p class="alert alert-danger text-center oculto" id="error_quantity"></p>
					<p class="alert alert-success text-center oculto">No ha ocurrido ningún error, proceso completado con éxito</p>
				</div>
			</div>	
		</div>
	</div>

@endsection
@section('script')
	<script>
		$(function(){
			
			$('#form_buscar').submit(function(e) {
				
				e.preventDefault()

				$('#btn_buscar').html('Cargando...&nbsp;<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>')

				var form_data = new FormData($('#form_buscar')[0]);

				$.ajax({
					url: '{{ route("$ruta")}}',
					type: 'POST',
					dataType: 'JSON',
					data: form_data,
					cache: false,
					contentType: false,
                	processData: false
				})
				.done(function(data) {
					
					$('#btn_buscar').html('Importar&nbsp;<i class="fa fa-arrow-up"></i>')

					if(data.r)
					{

						if(data.no_importados.length > 0)
						{
							id = "";
							for(var i = data.no_importados.length -1; i >= 0; i--)
							{
								id+= data.no_importados[i]+","
							}
							id = id.substring(0, id.length -1)

							$('#error_quantity').text('El o los productos con id '+id+" no han podido ser importados porque la cantidad comprada supera a la cantidad q hay en el almacen, los demás productos ( si habian ) han sido cargados con éxito").show('slow/400/fast').not('.alert-importat').delay(15000).hide('slow/400/fast')	
						}
						else
						{

							$('.alert-success').show('slow/400/fast').not('.alert-importat').delay(1000).hide('slow/400/fast')	
						}

					}
					else
					{
						if(data.no_importados.length > 0)
						{
							id = "";
							for(var i = data.no_importados.length -1; i >= 0; i--)
							{
								id+= data.no_importados[i]+","
							}
							id = id.substring(0, id.length -1)

							$('#error_quantity').text('El o los productos con id '+id+" no han podido ser importados porque la cantidad comprada supera a la cantidad q hay en el almacen. Además ha ocurrido un error al importar los datos, por favor siga al pie de la letra las intrucciones en el excel de ejemplo").show('slow/400/fast').not('.alert-importat').delay(15000).hide('slow/400/fast')	
						}
						else
						{
							$('#error_database').show('slow/400/fast').not('.alert-importat').delay(4000).hide('slow/400/fast')
						}
					}

					
				})
			});

		})
	</script>
@endsection