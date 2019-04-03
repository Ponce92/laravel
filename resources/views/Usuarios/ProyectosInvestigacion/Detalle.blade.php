@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item ">Proyectos de investigacion</li>
    <li class="breadcrumb-item"><a href="#">Busqueda de proyectos</a></li>
    <li class="breadcrumb-item active" >Detalle</li>
@endsection

@section('default')

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Detalle de proyecto</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col col-12">
                @include('Common.FlashMsj')
            </div>
        </div>
        <div class="row cuerpo-seccion">


            <div id="bvt" style="min-height: 500px!important;width: 100%!important;">
                <ul class="ui-nav"  >
                    <li>
                        <a href="#tabs-1" style="font-weight: bold">
                            <i class="fas fa-paperclip"></i>&nbsp;&nbsp;Datos generales
                        </a>
                    </li>
                    <li>
                        <a href="#tabs-3" style="font-weight: bold">
                            <i class="fas fa-book"></i>&nbsp;&nbsp;Participantes
                        </a>
                    </li>
                </ul>
                <div id="tabs-1">
                    {{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}
                    <div class="row">
                        <div class="col-12">
                            <br>
                            <div class="row">
                                <div class="col-10">Datos Generales</div>
                                <div class="col-2 align-middle" style="align-content: center;display: flex;align-items: center">

                                </div>
                                <hr style="margin-top: 0px;">
                            </div>
                            <br>
                            <form action="{{route('proyecto.investigacion.actualizar')}}" method="post" id="sw_dg_fr" class="switch-edt">
                                {{ csrf_field()  }}
                                <input type="text" value="{{$proyecto->getId()}}" name="_id" hidden>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row justify-content-center">
                                            <div class="r" style="width: 200px;height: 200px;border: 2px solid rgb(210,210,210) ;">
                                                <i class="{{$proyecto->getDetalleProyecto()->getIcono()->getNombre()}} fa-6x {{$proyecto->getDetalleProyecto()->getColor()->getValor()}}" style="font-size: 150px;margin-top: 20px; margin-left:5px;" ></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="titulo">Titulo proyecto :</label>
                                                <input  type="text"
                                                        name="titulo"
                                                        id="titulo"
                                                        class="form-control mb-3"
                                                        value="{{$proyecto->getTitulo()}}"
                                                        readonly
                                                >
                                            </div>
                                            <div class="col-3">
                                                <label for="titulo">Codigo proyecto :</label>
                                                <input  type="text"
                                                        name="codigo"
                                                        id="codigo"
                                                        readonly
                                                        class="form-control mb-3"
                                                        value="{{$proyecto->getId()}}"
                                                >
                                            </div>
                                            <div class="col-3">
                                                <label for="titulo">Acronimo proyecto :</label>
                                                <input  type="text"
                                                        name="acronimo"
                                                        id="acronimo"
                                                        class="form-control mb-3"
                                                        value="{{$proyecto->getAcronimo()}}"
                                                        readonly
                                                >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="titulo">Titular del proyecto :</label>
                                                <input  type="text"
                                                        name="titular"
                                                        id="titular"
                                                        readonly
                                                        class="form-control mb-3"
                                                        value="{{$proyecto->getTitular()->getCorreo()}}"
                                                >
                                            </div>
                                            <div class="col-4">
                                                <label for="s">Estado del proyecto :</label>
                                                <select name="er" id="fde3t" class="form-control mb-3" disabled>
                                                    <option value="">
                                                        {{$proyecto->getEstado()->getEstado()}}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label for="sd">Tipo de proyecto de investigacion :</label>
                                                <select name="r" id="fde3twqer" disabled class="form-control mb-3">
                                                    <option value="">
                                                        {{$proyecto->getTipo()->getDescripcion()}}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1"></div>
                                </div>
                                {{--
                                    ============================================================================================================
                                --}}
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-9">
                                        <hr class="all">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col">
                                                        <label class="" for="area">Area de Conocimiento:</label>
                                                        <select id="area"
                                                                name="area"
                                                                class="form-control mb-3"
                                                                disabled
                                                        >

                                                                <option value=""
                                                                >
                                                                    {{$proyecto->getArea()->getId() <100 ? $proyecto->getArea()->getNombre():'Otras areas delconocimiento'}}
                                                                </option>

                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="area-c">Especifique Area:</label>
                                                        <input type="text"
                                                               name="area-c"
                                                               id="area-c"
                                                               class="form-control mb-3 {{$errors->has('area-c') ? 'is-invalid':''}} edt"
                                                               value="{{$proyecto->getArea()->getId() >100 ? $proyecto->getArea()->getNombre():''}}"
                                                               disabled
                                                        >
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col col-4">
                                                <label for="as">Objetivo socioeconomico</label>
                                                <select name="3d" id="fder" class="form-control mb-3" disabled>
                                                    <option value="daf">
                                                        {{$proyecto->getObjetivo()->getDescripcion()}}
                                                    </option>
                                                </select>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="descripcion">Descripcion Proyecto :</label>
                                                <textarea   name="descripcion"
                                                            id="descripcion"
                                                            cols="50"
                                                            rows="3"
                                                            {{$errors->any() ? '':'disabled'}}
                                                            class="form-control edt  mb-3
                                                        {{$errors->has('descripcion') ? 'is-invalid':''}}"
                                                            rows="10">@if($errors->any()){{old('descripcion')}}@else{{$proyecto->getDescripcion()}}@endif</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div id="tabs-2">{{-- Pestania de edicion del proyecto de investigacion, es editable si pertenece a RI-UES --}}

                </div>
                <div id="tabs-3">
                    <ul class="list-group" style="border-radius: 0px !important; min-width: 400px">
                        @foreach($colaboradores as $usuario)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col col-1" style="width: 100px">
                                        <img src="{{asset('avatar/'.$usuario->rt_foto_usuario)}}"
                                             alt="vista no disponible"
                                             class="img-thumbnail"
                                             width="100px"
                                        >
                                    </div>
                                    <div class="col col-6">

                                        <strong>
                                            <a href="#">{{$usuario->email}}</a>
                                        </strong>
                                    </div>
                                    <div class="col col-2">

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="pie-seccion">
            <div class="row justify-content-end">

                <div class="opciones-menu-click" id="opciones-menu-click" style="padding: 0px">
                    <i class="fas fa-cog fa-2x bttn bttn-ver"></i>
                </div>
                <ul class="webui-popover-content list-group">

                    <form action="{{route('solicitar.participar.proyecto')}}" name="part" id="part" method="post">
                        {{ csrf_field()  }}
                        <li class="list-group-item bttn-ver f-20" onclick="part.submit()">
                            <i class="fas fa-users f-24 "></i>
                            &nbsp;Solicitar Participacion
                            <input hidden type="text" name="idP" id="idP" value="{{$proyecto->getId()}}">
                        </li>
                    </form>
                </ul>
                <div class="col-1"></div>
            </div>
        </div>

    </div>
    <br>

@endsection

@section('js')
    <script  src="{{asset('js/ProyectoInvestigacion/Administrar.js')}}"></script>
    <script  src="{{asset('js/ProyectoInvestigacion/DetalleProyecto.js')}}"></script>

@endsection
