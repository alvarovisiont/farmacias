@extends('layouts.app')
@section('view_descrip')
    
@endsection
@section('content')
    <div class="row">
      <!-- Apply any bg-* class to to the icon to color it -->
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row no-gutters">
                        <div class="col-md-3 col-sm-3">
                            <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                        </div>
                        <div class="col-md-9 col-sm-9 text-right">
                            <div class="huge"></div>
                            <h4>Configuración</h4>
                            <div style="font-size: 2em;" id="total_registros"><i class="fa fa-config"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.flash')
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
                @if(count($config) == 0)
                  <div class="pull-right">
                       <a href="{{route('config.create')}}" class="btn btn-success btn-flat btn-md pull-right">Registrar Configuración&nbsp;&nbsp;<i class="fa fa-plus"></i></a>
                  </div>
                @endif
        </div>
        <div class="box-body">
            <table class="table table-bordered table-hover" id="table">
                <thead>
                    <tr>
                        <th class="text-center">Director</th>
                        <th class="text-center">Número Dt.</th>
                        <th class="text-center">Email Dt.</th>
                        <th class="text-center">Logo</th>
                        <th class="text-center">Iva %<br />(Pago Débito)</th>
                        @if(Auth::user()->authorized())
                            <th class="text-center">Acción</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($config as $row)
                        <tr>
                            <td>{{ $row->director }}</td>
                            <td>{{ $row->director_number }}</td>
                            <td>{{ $row->director_email }}</td>
                            <td><img src="{{ asset('img/logo/'.$row->logo) }}" alt="Sin logo" width="100px" height="50px"></td>
                            <td>{{ $row->iva_porcentaje }}</td>
                            @if(Auth::user()->authorized())
                                <td>
                                    <a href="{{ url('config/'.$row->id.'/edit') }}" class="letras-medianas" title="Editar"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="eliminar letras-medianas" title="Eliminar" data-eliminar = "{{$row->id}}"><i class="fa fa-trash"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ url('config/'.':USER') }}" id="form_eliminar" method="POST">
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