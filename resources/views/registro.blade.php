
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
                <form action="">
                    <br>
                    <div class="col col-12 form" id="f1">
                        <div class="form-group form-inline">
                            <input type="text" class="form-control mb-6 mr-sm-5 mb-sm-0" id="nombre_txt" placeholder="Nombres">
                            <input type="text" class="form-control mb-6 mr-sm-5 mb-sm-0" id="apellido_txt" placeholder="Apellidos">
                        </div>
                        <div class="form-group">
                            <input  class="form-control" type="text" placeholder="Direccion">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email_txt" placeholder="e-mail">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="fecha_dt">Fecha nacimiento :</label>
                                    <input type="text" class="form-control" id="datepicker">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <p>sexo :</p>
                                    <input  type="radio" id="op1" name="sexo" value="1">
                                    <label for="op1"> Hombre </label>
                                    <input type="radio" id="op2" name="sexo" value="0" >
                                    <label for="op2">Mujer </label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <button class="btn riues-btn"  id="riues-reg-btn1" >
                                Siguiente <span class="fas fa-angle-right"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col col-12 form" id="f2">
                        <div class="row">
                            <div class="col col-4">
                                <div class="row">
                                    <img id="img_destino" src="{{asset('img.png')}}" alt="Foto Investigador" required>
                                </div>
                                <div class="row">
                                    <label for="file_url">Seleccione un foto :</label>
                                    <input type="file" id="file_url" accept=".png,.jpg,.jpeg" style="color: transparent">
                                </div>
                            </div>
                            <div class="col col-7" style="padding: 5px;">
                                <div class="form-group">
                                    <label for="grado">Grado academico: </label>
                                    <select id="grado" class="form-control" >
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pais">Pais :</label>
                                    <select name="pais"  class="form-control">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="horas">Horas dedicadas a investigacion</label>
                                    <input class="form-control" type="number" placeholder="Horas">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-6 justify-content-start">
                                <button class="btn riues-btn"  id="riues-reg-btn22" >
                                    <span class="fas fa-angle-left"></span>  Paso Anterior
                                </button>
                            </div>
                            <div class="col col-6 justify-content-end">
                                <button class="btn riues-btn"  id="riues-reg-btn2" >
                                    Siguiente <span class="fas fa-angle-right"></span>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col col-12 form" id="f3">
                        <div class="row">
                            <div class="form-group" style="width: 80%;margin: auto">
                                <input class="form-control" type="text" id="usuario_txt" placeholder="Usuario">
                            </div>
                            <div class="form-group" style="width: 80%;margin: auto">
                                <input type="password" class="form-control" id="password_txt" placeholder="Contrasenia">
                            </div>
                            <div class="form-group" style="margin: auto;width:80%;">
                                <input type="password" class="form-control" id="password-repeat" placeholder="Repita Contrasenia" >
                            </div>

                        </div>
                        <div class="row" style="position: relative;margin-bottom: 10px">
                            <div class="col-6 col justify-content-start">
                                <button class="btn riues-btn"  id="riues-reg-btn33" >
                                    <span class="fas fa-angle-left"></span> Paso Anterior
                                </button>
                            </div>
                            <div class="col col-6 justify-content-end">
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