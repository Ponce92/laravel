@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/riues-admin.css')}}">
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item active">Inicio</li>
@endsection


@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid" id="target">
        @include('AdminFragment.FrDefault')
    </div>

@endsection
