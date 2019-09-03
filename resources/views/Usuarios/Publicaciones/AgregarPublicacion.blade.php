@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Perfil</li>
    <li class="breadcrumb-item">Publicaciones</li>
    <li class="breadcrumb-item active">Agregar publicación</li>
@endsection

@section('default')

<div class="row">
    <div class="col-6 offset-3">
        <form method="post"  action="{{route('agregarPublicacion')}}">
            {{ csrf_field()  }}
            <div class="card">
                    <div class="card-header" style="background-color: #aa0000;">
                    <h2 class="titulo" style="color: white;">Nueva Publicación</h2>
                </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation">
                                            &nbsp;&nbsp; </i>Por favor corrija los campos que se marcan en rojo.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombreProyecto">Título de la Publicación:</label>
                                    <input type="text"
                                           autocomplete="off"
                                           class="form-control {{$errors->has('titulo') ? 'is-invalid':''}}"
                                           name="titulo"
                                           id="titulo"
                                           value="{{$errors->any() ? old('titulo'):''}}"
                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('titulo')}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">{{--   Tipo de publicación    --}}
                            <div class="col-6">
                                <label for="tipo">Tipo de publicación:</label>
                                <select name="tipo"
                                        class="form-control mb-3"
                                        id="tipo"
                                        onchange="verificarSelcTipo(this)"
                                >
                                    <option value="ac" {{old('tipo') =='ac' ? 'selected':''}}>Artículo Científico</option>
                                    <option value="nc"{{old('tipo') =='nc' ? 'selected':''}}>Nota científica</option>
                                    <option value="libro"{{old('tipo') == 'libro'? 'selected':''}}>Libro</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="col">
                                    <label for="fechaIncicio">Fecha de Publicación:</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                                        </div>
                                        <input type="link"
                                               autocomplete="off"
                                               name="fecha"
                                               class="form-control {{$errors->has('fecha') ? 'is-invalid':''}}"
                                               name="fecha"
                                               id="fecha"
                                               value="{{$errors->any() ? old('fecha'):''}}"
                                               readonly
                                        >
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fecha')}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label for="issn"> ISSN:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-book"></i></div>
                                    </div>
                                    <input type="text"
                                           name="issn"
                                           id="issn"
                                           class="form-control {{$errors->has('issn') ? 'is-invalid':''}}"
                                           value="{{$errors->any() ? old('issn'):''}}"
                                           placeholder="issn"
                                           disabled
                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('issn')}}
                                    </div>

                                </div>
                            </div>
                            <div class="col">
                                <label for="nc">Número de Capítulos:</label>
                                <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-indent"></i></div>
                                        </div>
                                    <input type="text"
                                           name="nc"
                                           id="nc"
                                           class="form-control {{$errors->has('nc') ? 'is-invalid':''}}"
                                           disabled
                                           value="{{$errors->any() ? old('nc'):''}}"
                                    >
                                    <div class="invalid-feedback">
                                        {{$errors->first('nc')}}
                                    </div>

                                </div>

                            </div>
                            <div class="col">
                                <label for="np">Número de páginas:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-file"></i></div>
                                    </div>
                                    <input type="text"
                                           name="np"
                                           id="np"
                                           class="form-control {{$errors->has('np') ? 'is-invalid':''}}"
                                           disabled
                                           value="{{$errors->any() ? old('np'):''}}"
                                    >
                                    <div class="invalid-feedback">{{$errors->first('np')}}</div>
                                </div>

                            </div>


                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="area">Área de Conocimiento:</label>
                                <select name="area"
                                        id="area"
                                        class="form-control  mb-3"
                                        onchange="verificarSelcArea(this)"
                                >
                                    @foreach($areas as $area)
                                        <option value="{{$area->pk_id_area}}" {{old('area') ==$area->pk_id_area ? 'selected':''}}>
                                            {{$area->rt_nombre_area}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="area-c">Especifique Área:</label>
                                <input type="text"
                                       name="area-c"
                                       id="area-c"
                                       class="form-control mb-3 {{$errors->has('area-c') ? 'is-invalid':''}}"
                                       value="{{$errors->any() ? old('area-c'):'' }}"
                                       disabled

                                >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="descripcion">Descripción:</label>
                                <textarea   class="form-control  mb-3 {{$errors->has('descripcion') ? 'is-invalid':''}}"
                                            rows="3"
                                            autocomplete="off"
                                            cols="60"
                                            placeholder="Descripción..."
                                            name="descripcion"
                                            id="descripcion"
                                >{{$errors->any() ? old('descripcion'):''}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('descripcion')}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="enlace"> Enlace de la Publicación:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-link"></i></div>
                                        </div>
                                        <input type="text"
                                               class="form-control {{$errors->has('enlace') ? 'is-invalid':''}}"
                                               id="enlace"
                                               name="enlace"
                                               value="{{$errors->any() ? old('enlace'):''}}"
                                               autocomplete="off"
                                        >
                                        <div class="invalid-feedback">
                                            {{$errors->first('enlace') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="card-footer">
                    <div class="row justify-content-end">
                        <a href="{{route('verPublicaciones')}}">
                            <button form="adfa" class="btn bttn-exit btn-lg" style="color: white;">&nbsp;&nbsp;Cancelar&nbsp;&nbsp;</button>
                        </a>
                        <div class="col-1"></div>
                        <input type="submit" class="btn bttn-red btn-lg" value="&nbsp;&nbsp;Guardar&nbsp;&nbsp;" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection


@section('js')
    <script  src="{{asset('js/Publicaciones/agregarPublicacion.js')}}"></script>
@endsection