@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Datos requeridos del Usuario</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ url($ruta) }}">
                    @if($edit)
                        {{method_field('PATCH')}}
                        <input type="hidden" name="password" value="{{$user->password}}">
                    @endif
                    {{csrf_field()}}
                        
                    <input type="hidden" name="status" value="0">

                    <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                        <label for="user" class="col-md-4 control-label">User</label>

                        <div class="col-md-6">
                            <input id="user" type="text" class="form-control" name="user" value="{{ $user->user ? $user->user : old('user') }}" required>

                            @if ($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @if(!$edit)
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} oculto">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group oculto">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                    @endif
                    
                    <div class="form-group{{ $errors->has('nombre_farmacia') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Nombre Farmacia</label>

                        <div class="col-md-6">
                            <input type="text" id="nombre_farmacia" name="nombre_farmacia" class="form-control" required value="{{$user->nombre_farmacia ? $user->nombre_farmacia : old('nombre_farmacia')}}">

                            @if ($errors->has('nombre_farmacia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre_farmacia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nivel') ? ' has-error' : '' }}">
                        <label for="nivel" class="col-md-4 control-label">Nivel</label>

                        <div class="col-md-6">
                            <select name="nivel" id="nivel" required="" class="form-control">
                                <option value=""></option>
                                <option value="1" {{$user && $user->nivel == 1 ? 'selected' : ''}}>Admin</option>
                                <option value="2" {{$user && $user->nivel == 2 ? 'selected' : ''}}>Farmacia</option>
                            </select>

                            @if ($errors->has('nivel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nivel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
                        <label for="nivel" class="col-md-4 control-label">Rol</label>

                        <div class="col-md-6">
                            <select name="rol" id="rol" required="" class="form-control">
                                <option value=""></option>
                                <option value="1" {{$user && $user->rol == 1 ? 'selected' : ''}}>Con Permisos</option>
                                <option value="2" {{$user && $user->rol == 2 ? 'selected' : ''}}>Restringido</option>
                            </select>

                            @if ($errors->has('nivel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nivel') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label for="estado" class="col-md-4 control-label">Estado</label>

                        <div class="col-md-6">
                            <select name="estado" id="estado" required="" class="form-control">
                                <option value=""></option>
                                @foreach($estados as $row)
                                    <option value="{{ $row->id }}" {{ $edit && $row->id == $user->estado ? 'selected' : ''}}>{{$row->estado}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('estado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('estado') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                        <label for="municipio" class="col-md-4 control-label">Municipio</label>

                        <div class="col-md-6">
                            <select name="municipio" id="municipio" required="" class="form-control">
                                <option value=""></option>
                                @foreach($municipios as $row)
                                    <option value="{{ $row->id_municipio }}" {{ $edit && $row->id_municipio == $user->municipio ? 'selected' : ''}}>{{$row->municipio}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('municipio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('municipio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('parroquia') ? ' has-error' : '' }}">
                        <label for="parroquia" class="col-md-4 control-label">parroquia</label>

                        <div class="col-md-6">
                            <select name="parroquia" id="parroquia" required="" class="form-control">
                                <option value=""></option>
                                @foreach($parroquias as $row)
                                    <option value="{{ $row->id }}" {{ $edit && $row->id == $user->parroquia ? 'selected' : ''}}>{{$row->parroquia}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('parroquia'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parroquia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-md-offset-4 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Registrar &nbsp;<i class="fa fa-send"></i>
                            </button>
                        </div>
                        <div class="col-md-5 col-sm-5">
                            <a href="{{route('users.index')}}">Regresar a la vista de usuarios</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
