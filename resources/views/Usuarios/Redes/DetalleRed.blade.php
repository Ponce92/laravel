@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')

    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{route('redes.todas')}}">Mis redes</a></li>
    <li class="breadcrumb-item active">Detalle</li>


@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo" >{{$red->rt_nombre_red}}</h2>
            </div>
            <div class="col-2">
                @if($user->pk_id_usuario == $proyecto->fk_id_titular)
                    @if($errors->any())
                        <div class="row justify-content-end">
                            <div class="row align-items-center" >
                                <div class="col">
                                    <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                                </div>
                            </div>

                            <div class="col">
                                <i class="fas fa-toggle-on fa-2x activo" id="switch"></i>
                            </div>
                        </div>
                    @else
                        <div class="row justify-content-end">
                            <div class="row align-items-center" >
                                <div class="col">
                                    <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                                </div>
                            </div>

                            <div class="col">
                                <i class="fas fa-toggle-off fa-2x inactivo" id="switch"></i>
                            </div>
                        </div>
                    @endif

                @else
                    <div class="row justify-content-end">
                        <i class="far fa-question-circle help-rc" style="font-size: 30px;color: #454545"></i>
                        <div class="webui-popover-content">
                            Solo el titular del proyecto de investigacion tiene permisos para editar la red.
                        </div>
                        <div class="col-2"></div>
                    </div>
                @endif

            </div>
        </div>
        <hr>
        <div class="row">
            {{$errors->first()}}
        </div>
        <div class="row cuerpo-seccion">
            @include('Common.FlashMsj')

            <div class="col-12">
                <form action="{{route('act.red')}}" id="frm_act" name="frm_act" method="post">
                {{ csrf_field()  }}
                <div class="row">
                    <div class="col-6">
                        <label for="#"> Datos Generales :</label>
                        <hr style="margin-top: 0px">
                        <input type="text" id="id" name="id" hidden value="{{$red->pk_id_red}}">
                        <div class="form-group">
                            <label for="titulo">Nombre de la red de investigadores :</label>
                            <input  type="text"
                                    class="form-control mb-3 edt {{$errors->has('titulo') ? 'is-invalid':''}}"
                                    id="titulo"
                                    name="titulo"
                                    value="@if($errors->any()){{old('titulo')}}@else{{$red->rt_nombre_red}}@endif"
                                    {{$errors->any() ? '':'disabled'}}
                            >
                            <div class="invalid-feedback">{{$errors->first('titulo')}}</div>
                        </div>
                        <label for="diciplina">Tipo de red</label>
                        <div class="form-row">
                                    <div class="form-check mb-2">
                                        <input  type="radio"
                                                class="form-check-input edt"
                                                name="diciplina"
                                                id="radio1"
                                                value="true"
                                                disabled
                                                {{$red->rl_is_diciplinaria ? 'checked':''}}
                                        >
                                        <label for="radio1">Diciplinaria</label>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="form-check mb-2">
                                        <input  type="radio"
                                                class="form-check-input edt"
                                                name="diciplina"
                                                id="radio2"
                                                value="false"
                                                disabled
                                                {{$red->rl_is_diciplinaria ? '':'checked'}}
                                        >
                                        <label for="radio2">Multiciplinaria</label>
                                    </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="#"> Personalizacion :</label>
                        <hr style="margin-top: 0px">
                        @include('Frg.icono_color_frg')
                    </div>
                </div>
                </form>
                <br>
            </div>
            <div class="col-6">
                <div class="form-row">
                    <label for="#"> Proyecto Relacionado :</label>
                    <hr style="margin-top: 0px">
                    <div class="col-8">
                        <Label>Nombre proyecto</Label>
                        <input type="text" class="form-control mb-3"
                               value="{{$proyecto->rt_titulo_proyecto}}"
                               disabled
                        >
                    </div>
                    <div class="form-group col-4">
                        <label for="codigo">Codigo proyecto :</label>
                        <input  type="text"
                                class="form-control"
                                value="{{$proyecto->pk_id_proyecto_investigacion}}"
                                disabled
                        >
                    </div>


                </div>
                <div class="form-group">
                    <label for="desc">Descripcion :</label>
                    <textarea class="form-control" rows="2" disabled style="background-color: rgb(245,245,245)">{{$proyecto->rd_descripcion_proyecto}}</textarea>
                </div>
            </div>
        </div>
        <div class="pie-seccion">
            <div class="row justify-content-end">
                <a href="{{route('redes.todas')}}">
                    <button id="cancelar" class="btn bttn bttn-exit btn-lg" style="color: white">
                        Cancelar
                    </button>
                </a>
                &nbsp;&nbsp;

                <button id="actualizar" class="btn bttn bttn-red btn-lg" style="color: white" form="frm_act">
                    Actualizar
                </button>
                <div class="col-1"></div>
            </div>
        </div>

    </div>


@endsection

@section('js')
    <script  src="{{asset('js/Redes/Redes.js')}}"></script>
@endsection



