<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Datos necesarios de los grupos para los productos</h4></div>
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
					<label for="name" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Nombre</label>
					<div class="col-md-4 col-sm-4">
						<input type="text" id="name" name="name" required="" class="form-control" value="{{$group->name}}">
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
						@if(Auth::user()->authorized())
							<button type="submit" class="btn btn-block btn-danger">Guardar&nbsp;<i class="fa fa-send"></i></button>
						@endif
					</div>
					<div class="col-md-3 col-sm-3">
						<a class="btn btn-link" href="{{route('group.index')}}">Volver a la vista de Marcas</a>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>