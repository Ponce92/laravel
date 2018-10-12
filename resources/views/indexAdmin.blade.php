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
        @if($user->fk_id_estado!= 1 )
            <div class="alert alert-warning">
                <i class="fas fa-info-circle"></i>&nbsp;&nbsp;No eres un usuario con permisos de ver el contenido completo de esta pgania, debes esperar al administrador..!
            </div>

        @endif

        @include('AdminFragment.FrDefault')
    </div>

@endsection
