@extends('layouts.app')
@section('view_descrip')
    
@endsection
@section('content')
    <div class="row">
      <!-- Apply any bg-* class to to the icon to color it -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-sm-3">
                            <i class="fa fa-archive fa-5x"></i>
                        </div>
                        <div class="col-md-9 col-sm-9 text-right">
                            <div class="huge"></div>
                            <div>Inventario</div>
                            <div style="font-size: 2em;" id="total_registros">{{count($stock)}}</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Totales</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row no-gutters">
        <div class="col-md-offset-6 col-sm-offset-6 col-md-2 col-sm-2">
            <a href="{{ url('stocktaking/pdf/'.$user_id) }}" target="_blank" class="btn btn-primary btn-outline">Generar PDF &nbsp;<i class="fa fa-file-pdf-o"></i></a>
        </div>
        <div class="col-md-3 col-sm-3">
            <a href="{{ url('stocktaking/excel/'.$user_id) }}" class="btn btn-success btn-outline">Generar Excel &nbsp;<i class="fa fa-file-excel-o"></i></a>
        </div>
    </div>
    <br />
    @include('partials.flash')
    <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
              <h2 class="box-title"><i class="fa fa-truck"></i>&nbsp;&nbsp;Productos Registrados</h2>
              <div class="pull-right">
                    @if(Auth::user()->nivel > 1)
                        <a href="{{route('stocktaking.create')}}" class="btn btn-danger btn-flat btn-md pull-right">Registrar Productos&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                    @endif
              </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Componente</th>
                        <th class="text-center">Grupo</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($stock as $row)
                        <tr>
                            <td>{{ $row->product }}</td>
                            <td>{{ $row->component }}</td>
                            <td>{{ $row->group_product->name }}</td>
                            <td>{{ $row->quantity }}</td>
                            <td>
                                <a href="{{ url('stocktaking/'.$row->id) }}" class="letras-medianas" title="Ver detalles"><i class="fa fa-search fa-1x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
@endsection