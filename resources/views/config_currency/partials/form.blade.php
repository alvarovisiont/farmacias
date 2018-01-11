<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading"><h4>Datos necesarios de la Configuración</h4></div>
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
					<label for="percentage" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Porcentaje</label>
					<div class="col-md-4 col-sm-4">
						<input type="number" step="any" id="percentage" name="percentage" required="" class="form-control" value="{{$currency->percentage}}" min="0" max="100">
					</div>
				</div>
				<div class="form-group">
					<label for="replace1" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Tipo</label>
					<div class="col-md-4 col-sm-4">
						<select name="type" id="type" class="form-control" required="">
							<option value=""></option>
							<option value="1">Iva</option>
							<option value="2">Descuento</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 col-sm-4 col-sm-offset-3 col-md-offset-3">
						@if(Auth::user()->authorized())
							<button type="submit" class="btn btn-block btn-danger">Guardar&nbsp;<i class="fa fa-send"></i></button>
						@endif
					</div>
					<div class="col-md-3 col-sm-3">
						<a class="btn btn-link" href="{{route('config_currency.index')}}">Volver a la vista de Configuración</a>
					</div>
				</div>
			</form>
		</div>
	</div>	
</div>