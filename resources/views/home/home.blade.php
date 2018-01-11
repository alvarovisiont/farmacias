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
	<div class="row no-gutters">
		<div class="col-md-6 col-sm-6">
			<div id="chartdiv" style="width: 100%;height:380px;font-size: 11px;"></div>
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

@endsection
@section('script')
	<script src="{{ asset('js/amcharts.js') }}"></script>
	<script src="{{ asset('js/serial.js') }}">  </script>
	<script src="{{ asset('js/pie.js') }}">  </script>

	<script>

		$(function(){

			var objetos = [{"categoria": "Debe", "saldo": {{ $total_balance[0]->total_spend }}, "color": "#BDBDBD"},{
				"categoria": "Haber", "saldo": {{ $total_balance[0]->total_sale }}, "color": "#8A0829"
			}]

			var chart = AmCharts.makeChart( "chartdiv", {
		        "type": "serial",
		        "theme": "none",
		        "depth3D": 20,
		        "angle": 30,
		        "legend": {
		          "horizontalGap": 10,
		          "useGraphSettings": true,
		          "markerSize": 10
		        },
		        "dataProvider": objetos,
		        "valueAxes": [ {
		          "stackType": "regular",
		          "axisAlpha": 0,
		          "gridAlpha": 0
		        } ],
		        "graphs": [ {
		          "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
		          "fillAlphas": 0.8,
		          "labelText": "[[value]]",
		          "lineAlpha": 0.3,
		          "title": "Flujo de dinero al mes",
		          "type": "column",
		          "color": "#FFF",
		          "valueField": "saldo",
		          "colorField" : "color",
		          "fillColors" : "#8A0829",
		        }
		        ],
		        "categoryField": "categoria",
		        "categoryAxis": {
		          "gridPosition": "start",
		          "axisAlpha": 0,
		          "gridAlpha": 0,
		          "position": "left"
		        }

	    	})

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