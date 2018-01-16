<!DOCTYPE html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicons.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">

  </head>

    <body class="hold-transition">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                         <span class="sr-only">Toggle Navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}"><b>{{ config('app.name') }}</b></a>
                 </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Recuperar Contraseña</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="login-logo">
        <center><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="Logo" style="height:75px"></center>
          
        </div><!-- /.login-logo -->
        <div class="col-md-5 col-sm-5 col-md-offset-4 col-sm-offset-4"> 
            @if (count($errors) > 0)
                  <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                       <li>{{$error}}</li>
                     @endforeach
                   </ul>  
                  </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Email Recovery</strong></div>
                <div class="panel-body">
                    <form id="form-login" action="{{ route('mail.recover')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group has-feedback">
                          <input  class="form-control" type="text" name="email" id="email" placeholder="Email">
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="row">
                          <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
                            <button id="b-login" type="submit" class="btn btn-primary btn-block">Send&nbsp;<i class="fa fa-send"></i></button>
                          </div><!-- /.col -->
                        </div>
                  </form>
                </div>
            </div>
        </div>
    </body>
</html>