<!Doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="{{asset('favicon.ico')}}" />
    @yield('title')
    
    <link rel="stylesheet" type="text/css" href="{{asset('framework/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('framework/jquery/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/appLayout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fuentes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/fontawesome-all.min.css')}}">
</head>
<body>
<div class="container-fluid" style="height: 80px;">
    <div class="row riues-row">
        <div class="col col-sm-12 col-md-4 col-lg-3">
            <img src="{{asset('img/app/sic.png')}}" alt="Logo de sic" class="logo">
        </div>

        <div class="col visible-md col-sm-0 col-md-8 col-lg-9">
            <div class="row justify-content-center">
                <div class="col-8" style="color:rgb(105,105,105); margin-top:10px;">
                    <h2> Red de Investigadores UES </h2>
                </div>
            </div>
        </div>
    </div>

    @yield('cuerpo')
</div>
</body>

    <script  src="{{asset('framework/jquery/jquery.min.js')}}"></script>
    <script  src="{{asset('framework/jquery/jquery-ui.min.js')}}"></script>
    @yield('js')
</html>