@extends('layouts.app')
@section('view_descrip')
	Dashboard
@endsection
@section('content')
	<div class="row no-gutters animated slideInLeft">
	  <!-- Apply any bg-* class to to the icon to color it -->
	    <div class="col-sm-3 col-md-3">
	        <div class="panel panel-warning">
	            <div class="panel-heading">
	                <div class="row no-gutters">
	                    <div class="col-md-3 col-sm-3">
	                        <i class="fa fa-shopping-cart fa-5x"></i>
	                    </div>
	                    <div class="col-md-9 col-sm-9 text-right">
	                        <div class="huge"></div>
	                        <div>Ventas</div>
	                        <div style="font-size: 2em;" id="total_registros">{{ $sale }}</div>
	                    </div>
	                </div>
	            </div>
	            <a href="{{ route('sale.index') }}">
	                <div class="panel-footer">
	                    <span class="pull-left">Ver detalles</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	    </div>
	    <div class="col-sm-3 col-md-3">
	        <div class="panel panel-danger">
	            <div class="panel-heading">
	                <div class="row no-gutters">
	                    <div class="col-md-3 col-sm-3">
	                        <i class="fa fa-shopping-cart fa-5x"></i>
	                    </div>
	                    <div class="col-md-9 col-sm-9 text-right">
	                        <div class="huge"></div>
	                        <div>Compras</div>
	                        <div style="font-size: 2em;" id="total_registros">{{ $buy }}</div>
	                    </div>
	                </div>
	            </div>
	            <a href="{{ route('buy.index') }}">
	                <div class="panel-footer">
	                    <span class="pull-left">Ver detalles</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	    </div>
	    <div class="col-sm-3 col-md-3">
	        <div class="panel panel-success">
	            <div class="panel-heading">
	                <div class="row no-gutters">
	                    <div class="col-md-3 col-sm-3">
	                        <i class="fa fa-archive fa-5x"></i>
	                    </div>
	                    <div class="col-md-9 col-sm-9 text-right">
	                        <div class="huge"></div>
	                        <div>Inventario</div>
	                        <div style="font-size: 2em;" id="total_registros">{{ $stock }}</div>
	                    </div>
	                </div>
	            </div>
	            <a href="{{ route('stocktaking.index') }}">
	                <div class="panel-footer">
	                    <span class="pull-left">Ver detalles</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	    </div>
	    <div class="col-sm-3 col-md-3">
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	                <div class="row no-gutters">
	                    <div class="col-md-3 col-sm-3">
	                        <i class="fa fa-cog fa-spin fa-fw fa-5x"></i>
	                    </div>
	                    <div class="col-md-9 col-sm-9 text-right">
	                        <div class="huge"></div>
	                        <div>Configuración</div>
	                        <div style="font-size: 2em;" id="total_registros"></div>
	                    </div>
	                </div>
	            </div>
	            <a href="{{ route('config.index') }}">
	                <div class="panel-footer">
	                    <span class="pull-left">Ver detalles</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
	            </a>
	        </div>
	    </div>
	</div>
	@include('partials.flash')
	<div class="row no-gutters">
		<div class="col-md-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Compradores más recurrentes</h4>
				</div>
				<div class="panel-body">
					<ul class="list-group">
						@foreach($max_buyers as $row)
							<li class="list-group-item">
								{{ $row->name_complete }} - {{ $row->cedula }}
								<a href="{{ route('admin.buys.view.clients', ['user' => base64_encode($row->id)]) }}" class="pull-right">Ver Compras&nbsp;<i class="fa fa-external-link"></i></a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>3 Medicamentos mas vendidos en el mes</h4>
				</div>
				<div class="panel-body">
					<div id="chartdiv_pie" style="width: 100%;height:180px;"></div>		
				</div>
			</div>
		</div>
	</div>
	<br />
	<div class="row no-gutters">

		<h3 class="text-center"><span class="subrayado_rojo">Productos del Inventario en alerta</span></h3>
		<br/>
		<table class="table table-bordered table-hover" id="table">
			<thead>
				<tr>
					<th class="text-center">Producto</th>
					<th class="text-center">Componente</th>
					<th class="text-center">Proveedor</th>
					<th class="text-center">Cantidad</th>
				</tr>
			</thead>
			<tbody class="text-center">
				@foreach($alert_products as $row)
					<tr class="alert alert-danger">
						<td>{{ $row->product }}</td>
						<td>{{ $row->provider_product->name }}</td>
						<td>{{ $row->component }}</td>
						<td>{{ $row->quantity }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

<!-- modal verificación de contraseña -->
<div id="modal_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header login-header" style="background-color: #3c8dbc; color: white;">
                <h4 class="modal-title">Reestablecer contraseña por defecto</h4>
            </div>
            <form method="POST" id="form_contraseña" action="{{ route('user.change.password') }}">
            	{{ csrf_field() }}
	            <div class="modal-body">
					<div class="form-group row no-gutters">
						<label for="password" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Nueva Contraseña</label>
						<div class="col-md-4 col-sm-4">
							<input type="text" id="password" name="password" required="" class="form-control">
						</div>
					</div>
					<div class="form-group row no-gutters">
						<label for="repeat_password" class="control-label col-md-2 col-sm-2 col-md-offset-2 col-sm-offset-2">Repita Contraseña</label>
						<div class="col-md-4 col-sm-4">
							<input type="text" id="repeat_password" name="repeat_password" required="" class="form-control">
						</div>
					</div>
	            </div><!-- fin modal-body -->
	            <div class="modal-footer" style="">
	                <button type="submit" class="btn btn-success">Grabar</button>
	            </div>
			</form>
        </div><!-- fin modal-content -->
    </div><!-- fin modal-dialog -->
</div> <!-- fin modal -->

@endsection
@section('script')
	<script src="{{ asset('js/amcharts.js') }}"></script>
	<script src="{{ asset('js/serial.js') }}">  </script>
	<script src="{{ asset('js/pie.js') }}">  </script>

	<script>

		$(function(){

			// variable para verificar si el usuario reestablecio su contraseña
			var status_user = {{ Auth::user()->status }}

			status_user > 0 ? '' : $('#modal_password').modal('show')

			$('#form_contraseña').submit(function(e) {

				var pass = $('#password').val(),
					repeat_pass = $('#repeat_password').val()

				if(pass !== repeat_pass)
				{
					alert('Las contraseñas no coinciden')	

					return false;
				} 

			});

			var data = []

			@foreach ($total_medicinas as $row)
				data.push( { total: {{ $row->total }}, product: "{{ $row->product }}" } )
			@endforeach
			

	    	var chart1 = AmCharts.makeChart("chartdiv_pie", {
			    "type": "pie",
			    "innerRadius": "40%",
			    "gradientRatio": [0, 0, 0 ,-0.2, -0.4],
			    "gradientType" : "radial",
			    "dataProvider": data,
			    "balloonText": "[[value]]",
			    "valueField": "total",
			    "titleField": "product",
			    "labelsEnabled": true,
  				"autoMargins": false,
				"marginTop": 0,
				"marginBottom": 0,
				"marginLeft": 0,
				"marginRight": 0,
				"pullOutRadius": 0,
			    "balloon": {
			        "drop": true,
			        "adjustBorderColor": false,
			        "color": "#FFFFFF",
			        "fontSize": 20
			    },
			    "export": {
			        "enabled": true
			    }
			});

	    	jQuery( '.chart-input' ).off().on( 'input change', function() {
		        var property = jQuery( this ).data( 'property' );
		        var target = chart;
		        chart.startDuration = 0;

		        if ( property == 'topRadius' ) {
		          target = chart.graphs[ 0 ];
		          if ( this.value == 0 ) {
		            this.value = undefined;
		          }
		        }

		        target[ property ] = this.value;
		        chart.validateNow();
      		});
		      
		})
	</script>
@endsection