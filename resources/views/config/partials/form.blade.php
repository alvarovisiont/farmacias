<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Datos necesarios para la configuración</h4></div>
		<div class="panel-body">
			<form action="{{url($ruta)}}" class="form-horizontal" id="form_registrar" method="POST" enctype="multipart/form-data">
				@if($edit)
					{{method_field('PATCH')}}
				@endif
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
					<label for="nombre_farmacia" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Nombre Farmacia</label>
					<div class="col-md-4 col-sm-4">
						<input type="text" id="nombre_farmacia" name="nombre_farmacia" required="" class="form-control" value="{{$config->nombre_farmacia}}">
					</div>
				</div>
				<div class="form-group">
					<label for="director" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Director</label>
					<div class="col-md-4 col-sm-4">
						<input type="text" id="director" name="director" required="" class="form-control" value="{{$config->director}}">
					</div>
				</div>
				<div class="form-group">
					<label for="director_number" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Teléfono</label>
					<div class="col-md-4 col-sm-4">
						<input type="number" id="director_number" name="director_number" required="" class="form-control" value="{{$config->director_number}}">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Email</label>
					<div class="col-md-4 col-sm-4">
						<input type="email" id="director_email" name="director_email" required="" class="form-control" value="{{$config->director_email}}">
					</div>
				</div>
				<div class="form-group">
					<label for="iva_porcentaje" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Iva %</label>
					<div class="col-md-4 col-sm-4">
						<input type="integer" id="iva_porcentaje" name="iva_porcentaje" required="" class="form-control" value="{{$config->iva_porcentaje}}" placeholder="% que se cobra en las ventas"
						min="1" max="100">
					</div>
				</div>
				<div class="form-group">
					<label for="replace1" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Logo</label>
					<div class="col-md-4 col-sm-4">
						<input type="file" name="logo">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
						@if(Auth::user()->authorized())
						<button type="submit" class="btn btn-block btn-danger">Guardar&nbsp;<i class="fa fa-send"></i></button>
						@endif
					</div>
					<div class="col-md-3 col-sm-3">
						<a class="btn btn-link" href="{{route('config.index')}}">Volver a la vista de configuración</a>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>