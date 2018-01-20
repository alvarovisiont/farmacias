<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Datos necesarios del proveedor</h4></div>
		<div class="panel-body">
			<form action="{{url($ruta)}}" class="form-horizontal" id="form_registrar" method="POST">
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
					<label for="usuario" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Nombre</label>
					<div class="col-md-4 col-sm-4">
						<input type="text" id="name" name="name" required="" class="form-control" value="{{$provider->name}}">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Dirección</label>
					<div class="col-md-4 col-sm-4">
						<textarea name="address" id="address" rows="2" class="form-control">{{$provider->address}}</textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="nombres" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Teléfono</label>
					<div class="col-md-4 col-sm-4">
						<input type="number" id="number" name="number" required="" class="form-control" pattern="[0-9]{11}" value="{{$provider->number}}">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Email</label>
					<div class="col-md-4 col-sm-4">
						<input type="email" id="email" name="email" required="" class="form-control" value="{{$provider->email}}">
					</div>
				</div>
				<div class="form-group">
					<label for="rif" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Rif</label>
					<div class="col-md-4 col-sm-4">
						<input type="text" id="rif" name="rif" required="" class="form-control" value="{{$provider->rif}}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
						@if(Auth::user()->authorized())
							<button type="submit" class="btn btn-block btn-success">Guardar&nbsp;<i class="fa fa-send"></i></button>
						@endif
					</div>
					<div class="col-md-3 col-sm-3">
						<a class="btn btn-link" href="{{route('providers.index')}}">Volver a la vista de proveedores</a>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>
	
		