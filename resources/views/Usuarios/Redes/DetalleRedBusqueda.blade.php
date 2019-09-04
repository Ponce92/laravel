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
    <li class="breadcrumb-item "><a href="{{route('redes.busqueda')}}">Búsqueda de redes</a></li>
    <li class="breadcrumb-item active">{{$red->rt_nombre_red}}</li>


@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo" >Red: {{$red->rt_nombre_red}}</h2>
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
                            Solo el titular del proyecto de investigación tiene permiso para editar la red.
                        </div>
                        <div class="col-2"></div>
                    </div>
                @endif

            </div>
        </div>
        <hr>
        <br>
        <div class="row cuerpo-seccion">
            @include('Common.FlashMsj')

            <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <div class="row justify-content-center">
                            <div class="" style="width: 200px;height: 200px;border: 2px solid rgba(210,210,210);">
                                <i class="{{$valorIcono}} fa-6x {{$valorColor}}" style="font-size: 150px;margin-top: 20px; margin-left:5px;" ></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12">
                                <label for="titulo">Nombre de la red de investigadores:</label>
                                <input  type="text"
                                        class="form-control mb-3 disabled"
                                        id="titulo"
                                        name="titulo"
                                        readonly
                                        value="{{$red->rt_nombre_red}}"
                                >

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="diciplina">Tipo de red:</label>
                                    <div class="form-check">
                                        <input  type="radio"
                                                class="form-check-input"
                                                name="diciplina"
                                                id="radio1"
                                                value="true"
                                                readonly
                                                {{$red->rl_is_diciplinaria ? 'checked':''}}
                                        >
                                        <label for="radio1">Disciplinaria</label>
                                    </div>
                                    &nbsp;
                                    <div class="form-check">
                                        <input  type="radio"
                                                class="form-check-input"
                                                name="diciplina"
                                                id="radio2"
                                                value="false"
                                                readonly
                                                {{$red->rl_is_diciplinaria ? '':'checked'}}
                                        >
                                        <label for="radio2">Multidisciplinaria</label>
                                    </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">

                                    </div>
                                    <div class="col-6 justify-content-end">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row justify-content-end">
                                                    <a href="">
                                                        <button class="btn bttn bttn-red" style="color: white">Ver Proyecto</button>
                                                    </a>
                                                    &nbsp;&nbsp;&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label for="#"> Proyecto Relacionado:</label>
                                <hr style="margin-top: 0px">
                            </div>
                            <br>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-8">
                                        <Label>Nombre de proyecto</Label>
                                        <input type="text" class="form-control mb-3"
                                               value="{{$proyecto->rt_titulo_proyecto}}"
                                               disabled
                                        >
                                    </div>
                                    <div class="col-4">
                                        <label for="codigo">Código del proyecto :</label>
                                        <input  type="text"
                                                class="form-control"
                                                value="{{$proyecto->pk_id_proyecto_investigacion}}"
                                                disabled
                                        >

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="desc">Descripción:</label>
                                <textarea class="form-control" rows="4" cols="50" disabled style="background-color: rgb(245,245,245)">{{$proyecto->rd_descripcion_proyecto}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
        <div class="pie-seccion">
            <div class="row justify-content-end">
                <a href="{{route('redes.busqueda')}}">
                    <button id="" class="btn bttn bttn-exit btn-lg" style="color: white">
                        Regresar
                    </button>

                </a>
                <div class="col-1"></div>
            </div>
        </div>

    </div>


@endsection

@section('js')
    <script  src="{{asset('js/Redes/Redes.js')}}"></script>
@endsection



