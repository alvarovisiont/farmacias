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
                            <i class="fa fa-heart-o fa-5x"></i>
                        </div>
                        <div class="col-md-9 col-sm-9 text-right">
                            <div class="huge"></div>
                            <div>Marcas</div>
                            <div style="font-size: 2em;" id="total_registros">{{count($trademark)}}</div>
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
    @include('partials.flash')
    <div class="box box-danger color-palette-box">
        <div class="box-header with-border">
              <h2 class="box-title"><i class="fa fa-truck"></i>&nbsp;&nbsp;Marcas Registradas</h2>
              <div class="pull-right">
                   <a href="{{route('trademark.create')}}" class="btn btn-warning btn-flat btn-md pull-right">Registrar Marca&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
              </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        @if(Auth::user()->authorized())
                            <th class="text-center">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($trademark as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            @if(Auth::user()->authorized())
                                <td>
                                    <a href="{{ url('trademark/'.$row->id.'/edit') }}" class="letras-medianas" title="Editar"><i class="fa fa-edit fa-1x"></i></a>
                                    <a href="#" class="eliminar letras-medianas" title="Eliminar" data-eliminar = "{{$row->id}}"><i class="fa fa-trash fa-1x"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ url('trademark/'.':USER') }}" id="form_eliminar" method="POST">
        {{csrf_field()}}
        {{method_field('DELETE')}}
    </form>
@endsection

@section('script')
    <script>
        $(function(){
            $('.eliminar').click(function(e){

                e.preventDefault()

                var form = $('#form_eliminar'),
                    id   = $(this).data('eliminar'),
                    agree = confirm('Esta seguro de querer borrar este registro?')

                if(agree)
                {
                    ruta = form.prop('action').replace(':USER',id)
                    form.attr('action',ruta)
                    form.submit()
                }
                
            })      
        })
    </script>
@endsection