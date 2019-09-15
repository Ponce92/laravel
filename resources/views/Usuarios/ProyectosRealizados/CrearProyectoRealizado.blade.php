@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
    <li class="breadcrumb-item">Perfil</li>
    <li class="breadcrumb-item"><a href="{{route('gestionProyectosRealizados')}}">Proyectos realizados</a></li>
    <li class="breadcrumb-item active">Agregar</li>
@endsection

@section('default')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header" style="background-color: #aa0000">
                    <div class="row justify-content-center">
                        <strong>
                            <h3 style="color: white;font-weight: bold;" class="titulo">Registro de proyecto realizado</h3>
                        </strong>
                    </div>
                </div>
                <div class="card-body">
                    <form id="frm-add" method="post"  action="{{route('agregarProyectosRealizado')}}">
                        {{ csrf_field()  }}
                        @if($errors->any())
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation">
                                     &nbsp;&nbsp; </i>Por favor, corrija los campos que se marcan en rojo.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombreProyecto">Título del Proyecto:</label>
                                    <input type="text"
                                           form="frm-add"
                                           class="form-control @if($errors->has('nombre')) is-invalid @endif"
                                           name="nombre"
                                           id="nombre"
                                           value="@if($errors->any()) {{old('nombre')}} @endif"
                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('nombre')}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="fechaIncicio">Fecha Incicio:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                    </div>
                                    <input type="text"
                                           form="frm-add"
                                           autocomplete="off"
                                           class="form-control @if($errors->has('fechaI')) is-invalid @endif"
                                           name="fechaI"
                                           id="fechaI"
                                           value="@if($errors->any()) {{old('fechaI') }} @endif"
                                           readonly
                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('fechaI')}}
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label for="fechaF">Fecha Finalización:</label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                    </div>
                                    <input type="text"
                                           autocomplete="off"
                                           form="frm-add"
                                           class="form-control @if($errors->has('fechaF')) is-invalid @endif"
                                           id="fechaF"
                                           readonly
                                           name="fechaF"
                                           value="@if($errors->any()) {{old('fechaF') }} @endif"

                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('fechaF')}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="area">Área de Conocimiento:</label>
                                <select name="area"
                                        id="area"
                                        class="form-control  mb-3"
                                        onchange="verificarSelcArea(this)"
                                        form="frm-add">
                                    @foreach($areas as $area)
                                        <option value="{{$area->pk_id_area}}" {{old('area') ==$area->pk_id_area ? 'selected':''}}>
                                            {{$area->rt_nombre_area}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="pais">País de ejecución :</label>
                                <select name="pais" id="pais" class="form-control  mb-3" form="frm-add">
                                    @foreach($paises as $pais)
                                        <option value="{{$pais->pk_id_pais}}" {{ old('pais') == $pais->pk_id_pais ? 'selected':'' }}>{{$pais->rt_nombre_pais}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="areaP">Especifique el área de conocimiento:</label>
                                <input type="text"
                                       name="area-c"
                                       id="area-c"
                                       value="@if($errors->any()) {{old('area-c')}} @endif"
                                       form="frm-add"
                                       class="form-control mb-3 @if($errors->has('area-c')) is-invalid @endif"
                                >
                                <div class="invalid-feedback">
                                    {{$errors->first('area-c')}}
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="descripcion">Descripción:</label>
                                <textarea   class="form-control  mb-3
                                                @if($errors->has('descripcion')) is-invalid @endif"
                                            rows="4"
                                            form="frm-add"
                                            autocomplete="off"
                                            cols="60"
                                            placeholder="Descripcion..."
                                            name="descripcion"
                                            id="descripcion"
                                >@if($errors->any()){{old('descripcion')}}@endif</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('descripcion')}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer align-content-end">
                    <div class="row justify-content-end">
                        <a href="{{route('gestionProyectosRealizados')}}">
                            <button class="btn bttn-exit btn-lg" style="color: white;">&nbsp;&nbsp;Cancelar&nbsp;&nbsp;</button>

                        </a>
                            <div class="col-1"></div>
                        <input type="submit" form="frm-add" class="btn bttn-red btn-lg" value="&nbsp;&nbsp;Guardar&nbsp;&nbsp;" />
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
        </div>


@endsection


@section('js')
    <script  src="{{asset('js/ProyectoRealizado/crearProyecto.js')}}"></script>
@endsection