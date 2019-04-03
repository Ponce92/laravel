<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{asset('css/fuentes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('framework/bootstrap/css/bootstrap.min.css')}}">
</head>

<body class="body">
<nav class="navbar navbar-expand navbar-light " style="height: 80px; background-color: rgba(254,254,254,.7);border-bottom: solid 1px rgb(210,210,210);">
    <a class="navbar-brand" href="/">
        <img src="{{asset('img/app/sic.png')}}" alt="Logo de sic" class="logo" style="
         height: 75px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        </ul>

        <ul class="navbar-nav">
            <li>
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li>
                <a class="nav-link" href="/">Registrarse</a>
            </li>
            <li>&nbsp;&nbsp;</li>
        </ul>

    </div>
</nav>

@yield('content')

</body>
</html>
