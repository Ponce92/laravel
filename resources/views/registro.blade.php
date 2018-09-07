
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Registro</title>
@stop

@section('cuerpo')

    <div class="container-fluid area-trabajo" id="area-trabajo" >
        <div class="">
            <form class="form-group" method="POST" action="/registros" enctype="multipart/form-data">
            {{ csrf_field()  }}

                            <!-- Form Name -->
            <br>
            <legend>Datos Personales</legend>
            <br>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                             <ul>
                                 @foreach($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                     @endforeach
                             </ul>
                    </div>
                    @endif


            <div class="row">
                <div class="form-group col-md-6">
                 <label class="" for="foto">Cargar foto</label>
                    <!-- File Button -->
                    <br>
                    <input id="foto" name="foto" class="input-file" type="file">
                 </div>

            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <!-- Text input-->
                    <label class="" for="nombre">Nombres</label>
                    <input id="nombre" name="nombre" placeholder="" form="frm-registro" class="form-control input-md" required="" type="text">
                </div>
                <div class="form-group col-md-6">
                    <!-- Text input-->
                    <label class="" for="apellido">Apellidos</label>
                    <input id="apellido" name="apellido" form="frm-registro" placeholder="" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
            <!-- Text input-->
                <label class="" for="fecha">Fecha</label>
                    <input id="fecha" name="fecha" placeholder="AAAA-MM-DD" form="frm-registro" class="form-control input-md" type="text">
                </div>
                <div class="form-group col-md-6">
                    <!-- Multiple Radios (inline) -->
                    <label class="" for="sexo">Sexo</label>
                    <br>
                    <label class="radio-inline" for="sexo-0">
                        <input name="sexo" id="sexo-0" value="true" form="frm-registro" checked="checked" type="radio">
                        H
                    </label>
                    <label class="radio-inline" for="sexo-1">
                        <input name="sexo" id="sexo-1" form="frm-registro" value="false" type="radio">
                        M
                    </label>

                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
            <!-- Appended Input-->
                <label class="" for="telefono">Teléfono</label>
                    <div class="input-group">
                        <input id="telefono" name="telefono" class="form-control" form="frm-registro" placeholder="Móvil o Fijo" required="" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <!-- Select Basic -->
                    <label class="" for="grado">Grado Academico </label>
                    <select id="grado" name="grado" class="form-control">
                        @foreach($grados as $grado)
                            <option value="{{$grado->id_grado}}">
                                {{$grado->nombre_grado}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <!-- Select Basic -->
                    <label class="" for="horas">Horas de investigacion</label>
                    <input class="form-control"
                           id="horas"
                           name="horas_investigacion"
                           type="number"
                           value=""
                           form="frm-registro"
                    >
                </div>
            </div>



            <div class="row">
                <div class="form-group col-md-6">
                    <!-- Select Basic -->
                    <label class="" for="areas">Area de Conocimiento</label>
                    <select id="areas" name="areas" class="form-control">
                        @foreach($areas as $area)
                            <option value="{{$area->id_area}}">
                                {{$area->nombre_area}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <!-- Select Basic -->
                    <label class="" for="nacionalidad">Nacionalidad</label>
                    <select id="nacionalidad" name="nacionalidad" class="form-control">
                        @foreach($paises as $pais)
                            <option value="{{$pais->id_pais}}" >
                                {{$pais->nombre_pais}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
            <!-- Text input-->
                <label class="" for="institucion">Institucion</label>
                    <input id="institucion" name="institucion" form="frm-registro" placeholder="A la que pertenece" class="form-control" required="" type="text">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
            <!-- Text input-->
                <label class="" for="direccion">Direccion</label>
                    <input id="direccion" name="direccion" form="frm-registro" placeholder="" class="form-control " type="text">
                </div>
            </div>

            <br>
            <!-- Form Name -->
            <legend>Usuario</legend>
            <br>

            <!-- Text input-->
            <div class="row">
                <div class="form-group col-md-8">
                <label for="correo">Correo</label>
                    <input id="correo" name="correo" form="frm-registro" placeholder="@Correo electronico" class="form-control input-md" required="" type="text">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
            <!-- Password input-->
                <label  for="contrasenia1">Contraseña</label>
                    <input id="contrasenia1" name="contrasenia1" form="frm-registro" placeholder="Ingrese la contraseña" class="form-control input-md" required="" type="password">
                    <span class="help-block">6 Caracteres como minimo</span>
                </div>
                <div class="form-group col-md-6">
            <!-- Password input-->
                <label for="contrasenia2">Contraseña</label>
                    <input id="contrasenia2" name="contrasenia2" form="frm-registro" placeholder="Repita la Contraseña" class="form-control input-md" required="" type="password">
                </div>

            </div>
            <div class="row">
            <div class="form-group col-md-6">
                <!-- Button -->
                <label for="btnregistro"></label>
                <button id="btnregistro" name="btnregistro"  type="submit" class="btn btn-danger">Registrarse</button>
            </div>
            </div>
            </form>
        </div>
    </div>



@stop

@section('js')

@stop