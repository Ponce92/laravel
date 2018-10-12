@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo">Notificaciones</h2>
            </div>
        </div>
        @include('Common.FlashMsj')
        <hr style="margin-top: 0px;">
        <br>
        <div class="row cuerpo-seccion">
            <div class="container-fluid">
                @if(count($notificaciones) != 0)
                    <ul class="list-group" style="border-radius: 0px !important; min-width: 400px" >
                    @foreach($notificaciones as $not)
                            <li class="list-group-item  {{$not->rl_vista == false ? 'ntf-not':'ntf' }}">
                                <div class="row">
                                    <div class="col-1" style="min-width: 100px">
                                        <img src="{{asset('avatar/'.$not->rt_foto_usuario)}}" width="75" class="rounded" alt="No imgage">
                                    </div>
                                    <div class="col-6">
                                        <strong>
                                            <a href="">
                                                {{$not->email}}
                                            </a>
                                        </strong>
                                        {{$not->rt_tipo_notificacion =='SRI' ? 'ha solicitado registrarse en el sistema.':''}}
                                    </div>
                                    <div class="col-3">
                                        @if($not->rt_tipo_notificacion == 'SRI')

                                                <button name="{{$not->pk_id_notificacion}}"
                                                        class="btn bttn-exit-small"
                                                        onclick="rechazarUsuario(this.name)">
                                                    Rechazar
                                                </button>

                                            <button name="{{$not->pk_id_notificacion}}"
                                                    class="btn bttn-red-small"
                                                    onclick="aceptarUsuario(this.name)">
                                                Aceptar
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-1">
                                        <div class="row justify-content-center" style="font-size: 26px">
                                            <div class="col">
                                                <i
                                                        class="fas fa-trash-alt bttn bttn-ver"
                                                        onclick="eliminarNotificacion('{{$not->pk_id_notificacion}}')"></i>
                                                &nbsp;&nbsp;
                                                @if($not->rl_vista == true)
                                                    <i class="fas fa-eye bttn bttn-ver"></i>
                                                    @else
                                                    <i  class="fas fa-eye-slash bttn bttn-ver"
                                                        onclick="leerNotificacion('{{$not->pk_id_notificacion}}')"></i>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                    @endforeach
                    </ul>

                @else
                    <br><br>
                    <div class="row justify-content-center">
                        <h3 style="font-weight: bold;font-size: 30px;color: gray">
                            "No tienes notificaciones nuevas"
                        </h3>
                    </div>
                @endif
            </div>

        </div>
        <br><br>
    </div>
    <br>
    <br>
    @if($user->fk_id_rol == 0)
        <div class="row" hidden>
            <div class="col">
                <form id="frm_aceptar" name="frm_aceptar" action="{{route('notificaciones.aceptar')}}" method="post">
                    {{ csrf_field()  }}
                    <input type="text" id="codigo_aceptar" name="codigo_aceptar">
                </form>
            </div>
            <div class="col">
                <form id="frm_rechazar" name="frm_rechazar" action="{{route('notificaciones.rechazar')}}" method="post">
                    {{ csrf_field()  }}
                    <input type="text" id="codigo_rechazar" name="codigo_rechazar">
                </form>
            </div>
            <div class="col">
                <form id="frm_eliminar" name="frm_eliminar" action="{{route('notificaciones.eliminar')}}" method="post">
                    {{ csrf_field()  }}
                    <input type="text" id="codigo_eliminar" name="codigo_eliminar">
                </form>
            </div>
            <div class="col">
                <form id="frm_leida" name="frm_leida" action="{{route('notificaciones.leida')}}" method="post">
                    {{ csrf_field()  }}
                    <input type="text" id="codigo_leida" name="codigo_leida">
                </form>
            </div>

        </div>
    @endif
@endsection

@section('js')
    <script src="{{asset('js/Notificaciones.js')}}" type="text/javascript"></script>
@endsection



