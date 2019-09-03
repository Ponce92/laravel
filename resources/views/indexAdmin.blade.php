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
    @include('Common.FlashMsj')
    <div class="container-fluid" id="target">

        @if($user->fk_id_estado == "Inactivo")
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>&nbsp;&nbsp;Su cuenta ha sido desactivada.
                    </div>
                </div>
            </div>

            <br>

        @endif

        @if($user->fk_id_estado == 4  )
            <div class="alert alert-warning">
                <i class="fas fa-info-circle"></i>&nbsp;&nbsp;Usted no es un usuario con permisos para ver el contenido completo de esta página, debe esperar la autorización del administrador.
            </div>

        @endif

        @if($user->getEstado()->getNombre() =='Pendiente'   )
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle"></i>&nbsp;&nbsp;Usted no es un usuario con permisos para ver el contenido completo de esta página, debe esperar la autorización del administrador.
                </div>

            @endif





        @include('AdminFragment.FrDefault')

            <br>
            @if($user->fk_id_estado == 0  )
            <div class="row">
                <div class="col col-12">
                    <div class="row justify-content-end">
                        <form action="{{route('notificacion.reactivacion')}}"  method="post" id="frm-slr" name="frm-slr" >
                            <input type="text"  hidden value="{{$user->getId()}}" name="idU">
                               {{ csrf_field()}}
                            <button class="btn btn-lg bttn bttn-red"
                                    type="submit"
                                    form="frm-slr">
                                Solicitar reactivación
                            </button>
                        </form>
                        <div class="col-1"></div>
                    </div>
                </div>

            </div>
                @endif
    </div>

@endsection
