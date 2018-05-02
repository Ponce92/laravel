
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Registro</title>
@stop

@section('cuerpo')
    <br>
    <div class="row justify-content-center">
        <div class="col col-xs-10 col-sm-12 col-md-5 col-lg-5 div-registro">
            <div class="row menu-slide">
                <div class="col col-4 sub-menu">
                    <li class="far fa-id-badge fa-2x s-menu" id="ff1"></li>
                </div>
                <div class="col col-4 sub-menu">
                    <li class="fas fa-paperclip fa-2x s-menu" id="ff2"></li>
                </div>
                <div class="col col-4 sub-menu">
                    <li class="far fa-bookmark fa-2x s-menu" id="ff3"></li>
                </div>
            </div>


            <div class="row secciones">
                <form action="/registro" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <br>
                    <div class="row form" id="f1" >
                        <div class="col-12">
                            <div class="form-row mb-5">
                                <div class="col">
                                    <input type="text" class="form-control" id="nombre_txt" name="nombre_txt" placeholder="Nombres">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="apellido_txt" nam="apellido_txt" placeholder="Apellidos">
                                </div>
                            </div>

                            <div class="input-group mb-5">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Direccion</span>
                                </div>
                                <input  class="form-control" type="text" id="direccion_txt">
                            </div>

                            <div class="input-group mb-5" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text">E-mail</span>
                                </div>
                                <input type="email" class="form-control" id="email_txt" placeholder="ejemplo@gmail.com">
                            </div>

                            <div class="form-row mb-4">
                                <div class="col">
                                    <p>Fecha Nacimiento</p>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">dd/mm/aa</span>
                                        </div>
                                        <input type="text" class="form-control" readonly="readonly" id="datepicker">
                                    </div>
                                </div>
                                <div class="col">
                                    <p>Sexo :</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="op1" name="sexo" value="1">
                                        <label class="form-check-label" for="op1"> Hombre </label>
                                        <input class="form-check-input" type="radio" id="op2" name="sexo" value="0" >
                                        <label class="form-check-label" for="op2">Mujer </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end mb-5">
                                <button class="btn riues-btn"  id="riues-reg-btn1" >
                                    Siguiente <span class="fas fa-angle-right"></span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <!--
                        *|  Segundo panel del formulario
                    -->
                    <div class="row form" id="f2">
                        <div class="col col-12">
                            <div class="form-row mb-5">
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <img id="img_destino" src="{{asset('img.png')}}" alt="Foto Investigador">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="custom-file">
                                            <label for="file_url" class="custom-file-label">Foto...</label>
                                            <input type="file" class="custom-file-input" accept=".png,.jpg,.jpeg">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-6">
                                    <div class="form-group">
                                        @include('Common.SelectGradoAcademico')
                                    </div>
                                    <div class="form-group">
                                        @include('Common.SelectPaises')
                                    </div>
                                    <label for="horas">Horas dedicadas a investigar :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Horas</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="#"  aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row mb-5">
                            <div class="col-5 justify-content-start">
                                <button class="btn riues-btn"  id="riues-reg-btn22" >
                                    <span class="fas fa-angle-left"></span>  Paso Anterior
                                </button>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5 align-self-end">
                                <button class="btn riues-btn"  id="riues-reg-btn2" >
                                    Siguiente <span class="fas fa-angle-right"></span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <!--
                        *|  Parte 3 del formulario de registro.
                    -->

                    <div class="row form" id="f3">
                        <div class="col col-10 offset-1">

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Usuario</div>
                                </div>
                                <input type="text"class="form-control" id="usuario_txt">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Password</div>
                                </div>
                                <input type="password"class="form-control" id="clave_txt">
                            </div>

                            <div class="input-group mb-5">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Repita Password</div>
                                </div>
                                <input type="password"class="form-control" id="clave_2_txt">
                            </div>
                        </div>

                        <div class="row mb-5" style="position: relative;margin-bottom: 10px">
                            <div class="col-5 col justify-content-start">
                                <button class="btn riues-btn"  id="riues-reg-btn33" >
                                    <span class="fas fa-angle-left"></span> Paso Anterior
                                </button>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5 justify-content-end">
                                <button class="btn riues-btn"  id="riues-reg-btn3" >
                                    Crear Registro <span class="fas fa-angle-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script  src="{{asset('js/registro.js')}}"></script>
@stop