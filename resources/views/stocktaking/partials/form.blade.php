<form action="{{ url($ruta) }}" method="POST" id="form_registrar" class="form-horizontal">
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
		<label for="code_product" class="control-label col-md-2 col-sm-2">Código Producto</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" id="code_product" name="code_product" required="" class="form-control" value="{{$stock->code_product}}">
		</div>
	</div>
	<div class="form-group">
		<label for="providers_id" class="control-label col-md-2 col-sm-2">Proveedor</label>
		<div class="col-md-4 col-sm-4">
			<select name="providers_id" id="providers_id" required="" class="form-control">
				<option value=""></option>
				@foreach($providers as $row)	
					<option value="{{ $row->id }}" {{ $edit && $row->id == $stock->providers_id ? 'selected' : ''}}>{{$row->name}}</option>
				@endforeach
			</select>
		</div>
		<label for="product" class="control-label col-md-2 col-sm-2">Producto</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" id="product" name="product" required="" class="form-control" value="{{$stock->product}}">
		</div>
	</div>
	<div class="form-group">
		<label for="component" class="control-label col-md-2 col-sm-2">Componente</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" id="component" name="component" class="form-control" value="{{$stock->component}}">
		</div>
		<label for="trademarks_id" class="control-label col-md-2 col-sm-2">Marca</label>
		<div class="col-md-4 col-sm-4">
			<select name="trademarks_id" id="trademarks_id" required="" class="form-control">
				<option value=""></option>
				@foreach($trademarks as $row)	
					<option value="{{ $row->id }}" {{ $edit && $row->id == $stock->trademarks_id ? 'selected' : ''}}>{{$row->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="groups_id" class="control-label col-md-2 col-sm-2">Grupo</label>
		<div class="col-md-4 col-sm-4">
			<select name="groups_id" id="groups_id" required="" class="form-control">
				<option value=""></option>
				@foreach($groups as $row)	
					<option value="{{ $row->id }}" {{ $edit && $row->id == $stock->groups_id ? 'selected' : ''}}>{{$row->name}}</option>
				@endforeach
			</select>
		</div>
		<label for="quantity" class="control-label col-md-2 col-sm-2">Cantidad</label>
		<div class="col-md-4 col-sm-4">
			<input type="number" id="quantity" name="quantity" required="" class="form-control" value="{{$stock->quantity}}">
		</div>
	</div>
	<div class="form-group">
		<label for="price" class="control-label col-md-2 col-sm-2">Precio Venta</label>
		<div class="col-md-4 col-sm-4">
			<input type="number" step="any" id="price" name="price" required="" class="form-control" value="{{$stock->price}}">
		</div>
		<label for="buying_price_provider" class="control-label col-md-2 col-sm-2">Precio Comprado</label>
		<div class="col-md-4 col-sm-4">
			<input type="number" step="any" id="buying_price_provider" name="buying_price_provider" required="" class="form-control" value="{{$stock->buying_price_provider}}">
		</div>
	</div>
	<div class="form-group">
		<label for="config_currencies_iva_id" class="control-label col-md-2 col-sm-2">Iva %</label>
		<div class="col-md-4 col-sm-4">
			<select name="config_currencies_iva_id" id="config_currencies_iva_id" required="" class="form-control">
				<option value=""></option>
				<option value="0" {{ $edit && $stock->config_currencies_iva_id == 0 ? 'selected' : ''}} >Excento</option>
				@foreach($config_currencies as $row)	
					@if($row->type == 1)
						<option value="{{ $row->id }}" {{ $edit && $row->id == $stock->config_currencies_iva_id ? 'selected' : ''}}>{{$row->percentage}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<label for="config_currencies_discount_id" class="control-label col-md-2 col-sm-2">Descuento %</label>
		<div class="col-md-4 col-sm-4">
			<select name="config_currencies_discount_id" id="config_currencies_discount_id" required="" class="form-control">
				<option value=""></option>
				<option value="0" {{ $edit && $stock->config_currencies_discount_id == 0 ? 'selected' : ''}}>Excento</option>
				@foreach($config_currencies as $row)	
					@if($row->type == 2)
						<option value="{{ $row->id }}" {{ $edit && $row->id == $stock->config_currencies_discount_id ? 'selected' : ''}}>{{$row->percentage}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="replace1" class="control-label col-md-2 col-sm-2">Fecha Adquirido</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" id="buying_date" name="buying_date" required="" class="form-control fecha" value="{{$edit ? date('d-m-Y',strtotime($stock->buying_date)) : '' }}">
		</div>
		<label for="replace1" class="control-label col-md-2 col-sm-2">Fecha Expensión</label>
		<div class="col-md-4 col-sm-4">
			<input type="text" id="date_of_expense" name="date_of_expense" required="" class="form-control fecha" value="{{$edit ? date('d-m-Y',strtotime($stock->date_of_expense)) : '' }}">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-4 col-sm-4 col-sm-offset-4 col-md-offset-4">
			@if(Auth::user()->authorized())
				<button type="submit" class="btn btn-block btn-success">Guardar&nbsp;<i class="fa fa-send"></i></button>
			@endif
		</div>
		<div class="col-md-3 col-sm-3 col-md-offset-1 col-sm-offset-1 ">
			<a class="btn btn-link" href="{{route('stocktaking.index')}}">Volver a la vista de Inventario</a>
		</div>
	</div>
</form>