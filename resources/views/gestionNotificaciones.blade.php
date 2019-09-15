
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
                                            <img src="{{asset('storage/avatar/'.$not->getRemitente()->getFoto())}}" width="75" class="rounded" alt="No imgage">
                                    </div>
                                    <div class="col-6">
                                        <strong>
                                                <a href="{{route('getPerfilInvestigador',['id'=>$not->getRemitente()->getId()])}}">
                                                    {{$not->getRemitente()->getCorreo()}}
                                                </a>
                                        </strong>
                                        {{$not->rt_tipo_notificacion =='SRI' ? 'Ha solicitado registrarse en el sistema.':''}}
                                        {{$not->rt_tipo_notificacion =='SRA' ? 'Ha solicitado reactivar su cuenta.':''}}
                                        {{$not->rt_tipo_notificacion =='RSR' ? 'Ha aceptado su solicitud':''}}
                                        {{$not->rt_tipo_notificacion =='NC' ? ', Ha comentado tu respuesta en el Foro':''}}
                                        {{$not->rt_tipo_notificacion =='NR' ? ', Ha agregado una respuesta a tu Temática':''}}
                                        {{$not->rt_tipo_notificacion =='NT' ? ', Ha agregado una nueva temática al Foro':''}}
                                        {{--
                                        Solicitud de de amistad
                                        --}}
                                        {{$not->rt_tipo_notificacion =='SSA' ? 'Ha solicitado agregarte a sus contactos':''}}
                                        {{$not->rt_tipo_notificacion =='RSA' ? 'Ha aceptado su solicitud de contacto':''}}
                                        @if($not->getTipo() =='SAI')
                                            ,Le ha invitado a participar en el proyecto
                                            <a href="{{route('getProyecto',['id'=>$not->getProyecto()->getId()])}}"> {{$not->getProyecto()->getTitulo()}} </a>
                                        @endif
                                        {{$not->rt_tipo_notificacion =='RAP' ? 'Ha aceptado su invitación al proyecto':''}}

                                        @if($not->getTipo() =='SPP')
                                            , Ha solicitado participar en el proyecto
                                            <a href="{{route('getProyecto',['id'=>$not->getProyecto()->getId()])}}">
                                                {{$not->getProyecto()->getTitulo()}}
                                            </a>
                                        @endif
                                        @if($not->getTipo() =='RPP')
                                            , Ha aceptado su unión al proyecto <a href="{{route('getProyecto',['id'=>$not->getProyecto()->getId()])}}">
                                                {{$not->getProyecto()->getTitulo()}}
                                            </a>
                                        @endif

                                    </div>

                                    <div class="col-3">

                                        @if($not->getTipo() =='SRI')
                                            <button name="{{$not->pk_id_notificacion}}"
                                                    class="btn bttn-exit-small"
                                                    onclick="rechazarUsuario(this.name)">
                                                Rechazar
                                            </button>

                                            <button name="{{$not->pk_id_notificacion}}"
                                                    class="btn bttn-red-small"
                                                    onclick="aceptarUsuario(this.name)">
                                                Activar
                                            </button>
                                        @endif
                                        @if($not->getTipo() =='SRA')
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
                                        @if($not->getTipo() =='SSA')
                                                <button name="{{$not->pk_id_notificacion}}"
                                                        class="btn bttn-exit-small"
                                                        onclick="eliminarNotificacion('{{$not->pk_id_notificacion}}')">
                                                    Rechazar
                                                </button>
                                                <form action="{{route('responder.amistad')}}" id="frm_23" method="post" name="frm_23" style="display: inline">
                                                    {{ csrf_field()  }}
                                                    <input type="text" id="idN" name="idN" hidden value="{{$not->pk_id_notificacion}}">
                                                    <button name="{{$not->pk_id_notificacion}}"
                                                            class="btn bttn-red-small"
                                                            onclick="frm_23.submit()">
                                                        Aceptar
                                                    </button>
                                                </form>

                                        @endif  
                                        @if($not->getTipo() =='NC')
                                                <a href="{{route('tematica.Index',['id'=>$not->rt_codigo_proyecto])}}" 
                                                   onclick="leerNotificacion('{{$not->pk_id_notificacion}}')"
                                                   >Ver Comentario</a>
                                               

                                        @endif
                                        @if($not->getTipo() =='NR')
                                                <a href="{{route('tematica.Index',['id'=>$not->rt_codigo_proyecto])}}" 
                                                   onclick="leerNotificacion('{{$not->pk_id_notificacion}}')"
                                                   >Ver Respuesta</a>
                                                

                                        @endif
                                        @if($not->getTipo() =='NT')
                                                <a href="{{route('tematica.Index',['id'=>$not->rt_codigo_proyecto])}}" 
                                                   onclick="leerNotificacion('{{$not->pk_id_notificacion}}')"
                                                   >Ver Temática</a>
                                                

                                        @endif
                                        @if($not->getTipo() =='SAI')
                                                <button name="{{$not->pk_id_notificacion}}"
                                                        class="btn bttn-exit-small"
                                                        onclick="eliminarNotificacion('{{$not->pk_id_notificacion}}')">
                                                    Rechazar
                                                </button>
                                                <form action="{{route('responder.invitacion.proyecto')}}" id="frm_24" method="post" name="frm_24" style="display: inline">
                                                    {{ csrf_field()  }}
                                                    <input type="text" id="id24" name="idN24" hidden value="{{$not->pk_id_notificacion}}">
                                                    <button class="btn bttn-red-small"
                                                            onclick="frm_24.submit()">
                                                        Aceptar
                                                    </button>
                                                </form>
                                        @endif
                                        @if($not->getTipo() =='SPP')
                                            <button name="{{$not->pk_id_notificacion}}"
                                                    class="btn bttn-exit-small"
                                                    onclick="eliminarNotificacion('{{$not->pk_id_notificacion}}')">
                                                Rechazar
                                            </button>
                                            <form action="{{route('esponder.participar.proyecto')}}" id="frm_25" method="post" name="frm_25" style="display: inline">
                                                {{ csrf_field()  }}
                                                <input type="text" id="id25" name="idN25" hidden value="{{$not->pk_id_notificacion}}">
                                                <button class="btn bttn-red-small"
                                                        onclick="frm_25.submit()">
                                                    Aceptar
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <div class="col-1">
                                        <div class="row justify-content-center" style="font-size: 26px">
                                            <div class="col">
                                                <i      title="Elimnar notificacion"
                                                        class="fas fa-trash-alt bttn bttn-ver"
                                                        onclick="eliminarNotificacion('{{$not->pk_id_notificacion}}')"></i>
                                                &nbsp;&nbsp;
                                                @if($not->rl_vista == true)
                                                    <i  title="Marcar como no leido"
                                                            class=" fas fa-eye bttn bttn-ver"></i>
                                                    @else
                                                    <i      title="Marcar como leido"
                                                            class="fas fa-eye-slash bttn bttn-ver"
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
                   @include('AdminFragment.frg_default')
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


        </div>
    @endif
    <div class="row" hidden>
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
@endsection

@section('js')
    <script src="{{asset('js/Notificaciones.js')}}" type="text/javascript"></script>
@endsection
