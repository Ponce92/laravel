@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Proyectos de investigacion</li>
    <li class="breadcrumb-item"><a href="{{route('misproyectos.investigacion')}}">Mis proyectos</a></li>
    <li class="breadcrumb-item">Registrar proyecto</li>
@endsection

@section('default')
        <div class="row justify-content-center">
            <div class="col-8 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-center">
                            <h3 class="titulo">Registro de proyecto de investigacion.</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation">
                                             </i>Porfavor corrija los campos que se marcan en rojo.
                                        {{$errors->first()}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form name="frm" id="frm" action="{{route('registrar.proyecto.investigacion')}}" method="post">{{-- Formulario de registro de proyecto de investigacion --}}
                            {{ csrf_field()  }}
                            <div id="form-tabs" style="min-height: 600px">
                                <ul>
                                    <li><a href="#tab-1">Datos generales</a></li>
                                    <li><a href="#tab-2">Detalles del proyectos
                                            @if($errors->has('fi') || $errors->has('ff') || $errors->has('monto')  || $errors->has('obj') || $errors->has('descObj'))
                                                <span class="badge badge-danger">*</span>
                                            @endif
                                    </a></li>
                                    <li><a href="#tab-4">
                                            Red de investigadores
                                            @if($errors->has('paisRed') || $errors->has('tipoRed') || $errors->has('red'))
                                                <span class="badge badge-danger">*</span>
                                            @endif

                                        </a>
                                    </li>
                                    <li><a href="#tab-5">Personalizacion</a></li>
                                </ul>
                                <div id="tab-1">
                                    <br>
                                    <h5 class="sub-titulo">Datos generales</h5>
                                    <hr style="margin-top: 0px;">
                                    <div class="form-row">
                                        <div class="col-12">
                                            <label for="nombre">Titulo del Proyecto <h5 class="srt">*</h5></label>
                                            <div class="input-group mb-3">
                                                <input type="text"
                                                       name="nombre"
                                                       id="nombre"
                                                       class="form-control {{$errors->has('nombre') ? 'is-invalid':''}}"
                                                       value="{{$errors->any()  ?   old('nombre'):''}}"
                                                >
                                                <div class="invalid-feedback">{{$errors->first('nombre')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-4">
                                            <label for="codigo">Codigo
                                                <i class="fas fa-info-circle help-rc" data-placement="horizontal"></i>
                                                <div  class="webui-popover-content">
                                                    <p>Si no es especificado un codigo se  generara uno aleatorio</p>
                                                </div>
                                            </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-bars"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                       name="codigo"
                                                       id="codigo"
                                                       class="form-control {{$errors->has('codigo') ? 'is-invalid':''}}"
                                                       value=" {{$errors->any() ? old('codigo'):''}}"
                                                >
                                                <div class="invalid-feedback">{{$errors->first('codigo')}}</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="acronimo">Acronimo<h5 class="srt">*</h5></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-bars"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                       name="acronimo"
                                                       id="acronimo"
                                                       value="{{$errors->any() ? old('acronimo'):''}}"
                                                       class="form-control {{$errors->has('acronimo') ? 'is-invalid':''}}"
                                                >
                                                <div class="invalid-feedback">{{$errors->first('acronimo')}}</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="tipoP">Tipo de proyecto <h5 class="srt">*</h5></label>
                                            <select name="tipoP"
                                                    id="tipoP"
                                                    class="form-control {{$errors->has('tipoP')   ?  'is-invalid':''}}"
                                            >
                                                <option value="" >No especificado</option>
                                                @foreach($tiposProyectos as $tipo)
                                                    <option value="{{$tipo->pk_id_tipo_proyecto}}"
                                                            {{old('tipoP') == $tipo->pk_id_tipo_proyecto ? 'selected':''}}>
                                                        {{$tipo->rd_descripcion}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Especifica el tipo de proyecto.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">{{-- Areas del conocimiento del pruecto de investigacion --}}
                                        <div class="col-6">
                                            <label for="area">Area Conocimiento <h5 class="srt">*</h5> </label>
                                            <select name="area"
                                                    id="area"
                                                    class="form-control {{$errors->has('area') ? 'is-invalid':''}}"
                                                    onchange="verificarSelcArea(this)"
                                            >
                                                <option value="" selected>No especificada</option>
                                                @foreach($areas as $area)
                                                    <option value="{{$area->pk_id_area}}" {{old('area') ==$area->pk_id_area ? 'selected':''}} >
                                                        {{$area->rt_nombre_area}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Especifique un area.</div>
                                        </div>
                                        <div class="col-6">
                                            <label for="area-c">Especifique Area:</label>
                                            <input type="text"
                                                   name="area-c"
                                                   id="area-c"
                                                   class="form-control {{$errors->has('area-c') ? 'is-invalid':''}}"
                                                   value="{{$errors->any() ? old('area-c'):'' }}"
                                                   disabled
                                            >
                                            <div class="invalid-feedback">{{$errors->first('area-c')}}</div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="pais">Pais de ejecucion</label>
                                            <select name="pais"
                                                    id="pais"
                                                    class="form-control {{$errors->has('pais') ? 'is-invalid':''}}"
                                            >
                                                <option value="" selected>No especificado</option>
                                                @foreach($paises as $pais)
                                                    <option value="{{$pais->pk_id_pais}}" {{old('pais') == $pais->pk_id_pais ? 'selected':''}}>
                                                        {{$pais->rt_nombre_pais}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Especifique un pais de ejecucion.
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="estadoP">Estado del proyecto :</label>
                                            <select name="estadoP"
                                                    id="estadoP"
                                                    class="form-control mb-3 {{$errors->has('estadoP') ? 'is-invalid':''}}"
                                            >
                                                <option value="" selected>No especificado</option>
                                                @foreach($estados as $estado)
                                                    <option value="{{$estado->pk_id_estado}}"
                                                            {{$estado->pk_id_estado == old('estadoP') ? 'selected':''}}
                                                    >
                                                        {{$estado->rt_nombre_estado}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Debe especificar el estado actual del proyecto.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="Obj">Objetivo socioeconomico :</label>
                                            <select name="Obj"
                                                    id="Obj"
                                                    class="form-control mb-3 {{$errors->has('Obj')   ?  'is-invalid':''}}"
                                            >
                                                <option value="" >No especificado</option>
                                                @foreach($objetivosS as $obj)
                                                    <option value="{{$obj->pk_codigo_objetivo}}"
                                                            {{old('Obj') == $obj->pk_codigo_objetivo ? 'selected':''}}>
                                                        {{$obj->rd_descripcion_objetivo}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Debes especificar el objetivo socioeconomico del proyecto.
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <label for="desc">Descripcion del proyecto <h5 class="srt">*</h5></label>
                                        <textarea name="desc" id="desc" cols="30" rows="4" class="form-control {{$errors->has('desc') ? 'is-invalid':''}}"></textarea>
                                        <div class="invalid-feedback">Este campo es obligatorio</div>
                                    </div>
                                </div> {{-- ++++++++++++++++++++++++++++++Fin datos generales del proyecto++++++++++++++++++++++++++++  --}}


                                <div id="tab-2">
                                    <br>
                                    <h5 class="sub-titulo">Financiamiento</h5>
                                    <hr style="margin-top: 0px;">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="tipo">Fuente de financiameto :</label>
                                            <select name="tipoFuente"
                                            id="tipoFuente"
                                            class="form-control mb-3"
                                            disabled
                                            >
                                                <option value="4">Mixto</option>
                                                <option value="3" selected>Externa</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="monto">Monto de la inversion <h5 class="srt">*</h5></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </div>
                                                </div>
                                                <input type="number"
                                                       name="monto"
                                                       id="monto"
                                                       class="form-control {{$errors->has('monto') ? 'is-invalid':''}}"
                                                       value="{{old('monto')}}"
                                                >
                                                <div class="invalid-feedback">{{$errors->first('monto')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h5 class="sub-titulo">Fechas estimadas</h5>
                                    <hr style="margin-top: 0px">
                                    <div class="form-row">
                                        <div class="col-6">
                                            <label for="fi">Fecha Inicial <h5 class="srt">*</h5></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                       name="fi"
                                                       id="fi"
                                                       class="form-control {{$errors->has('fi') ? 'is-invalid':''}}"
                                                       value="{{old('fi')}}"
                                                       readonly
                                                >
                                                <div class="invalid-feedback">{{$errors->first('fi')}}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="ff">Fecha final <h5 class="srt">*</h5></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                       name="ff"
                                                       id="ff"
                                                       class="form-control {{$errors->has('ff') ? 'is-invalid':''}}"
                                                       value="{{old('ff')}}"
                                                       readonly
                                                >
                                                <div class="invalid-feedback">{{$errors->first('ff')}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>{{-- Fin de seccion de datos complementarios del proyecto de investigacion --}}


                                <div id="tab-4">
                                    <div class="form-row">
                                        <div class="col-8">
                                            <label for="red">Nombre de la red de investigadores <h5 class="srt">*</h5></label>
                                            <input type="text"
                                                   name="red"
                                                   id="red"
                                                   class="form-control {{$errors->has('red') ? 'is-invalid':''}}"
                                                   value="{{old('red')}}"
                                            >
                                            <div class="invalid-feedback">{{$errors->first('red')}}</div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-5">
                                            <label for="tipoRed">Tipo de red <h5 class="srt">*</h5></label>
                                            <select name="tipoRed"
                                                    id="tipoRed"
                                                    class="form-control {{$errors->has('tipoRed') ? 'is-invalid':''}}"
                                            >
                                                <option value="">No especificado</option>
                                                 <option value="1">Diciplinaria</option>
                                                <option value="2">Multidiciplinaria</option>
                                            </select>
                                            <div class="invalid-feedback">Especifique el tipo de red de investigadores.</div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-1">
                                            <i class="fas fa-info-circle" style="color: orangered;">
                                             </i>
                                        </div>
                                        <div class="col-11">
                                            <p>
                                                El nombre de la red de ivestigadores se utilizara para labores de interaccion
                                                entre los integrantes del proyecto de investigacion.
                                            </p>
                                        </div>
                                    </div>
                                </div>{{--                         Fin del formulario de la red de investigadores                   --}}



                                <div id="tab-5">
                                    <h5 class="sub-titulo">
                                        Personalizacion
                                    </h5>
                                    <hr style="margin-top: 0px">

                                    <div class="form-row">
                                        <div class="col-12">
                                            <ol id="selectable"style="width: 100%;max-height: 300px;border: 1px solid lavenderblush;overflow: auto">
                                              @foreach($iconos as $icon)
                                                  <li class="ui-widget-content text-center" id="{{$icon->rt_icono}}" >
                                                      <i class="{{$icon->rt_icono}} fa-2x"
                                                         id="{{$icon->pk_codigo_icono}}"
                                                      ></i>
                                                  </li>
                                              @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">

                                        <div class="col-6">
                                            <label for="color">Seleccione color</label>
                                            <select name="colorIcon"
                                                    id="colorIcon"
                                                    class="form-control"

                                            >
                                                <option value="" name="gris-rc">Color no especificado</option>
                                                @foreach($colores as $color)
                                                    <option value="{{$color->pk_id_color}}" name="{{$color->rt_valor}}">
                                                        {{$color->rt_nombre}}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-6">
                                            <div class="row justify-content-center">
                                                <div class="col-6">
                                                    <div class="text-center" style="width: 125px;padding-top: 15px;height: 125px;border: 1px solid rgb(210,210,210);">
                                                        <i class="" name="" id="iconDestini"></i>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="form-row">
                                        <input type="text" name="idInconoTxt" hidden >
                                        <div class="col-1">
                                            <i class="fas fa-info-circle" style="color: orangered;">
                                            </i>
                                        </div>
                                        <div class="col-11">
                                            <p>
                                              El icono servira para identificar tanto el proyecto de investigaicon como a la red de investigadores
                                                <br>
                                                Se aplicara un icono y tema por defecto si hace no se especifica una configuracion.
                                            </p>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-end">
                            <a href="{{route('misproyectos.investigacion')}}">
                            <button class="btn btn-lg bttn-exit">
                                    Cancelar
                            </button>
                            </a>
                            <div class="col-1"></div>
                            <a href="">
                                <button class=" btn btn-lg bttn-red" form="frm">
                                    Registrar
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script  src="{{asset('js/ProyectoInvestigacion/ProyectoInvestigacion.js')}}"></script>
@endsection



