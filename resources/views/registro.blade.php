
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Registro</title>
@stop

@section('cuerpo')
    <br>
    <div class="row justify-content-center">
        <div class="col col-xs-10 col-sm-12 col-md-5 col-lg-5">
            <div class="row menu-slide">
                <div class="col col-4 sub-menu">
                    <li class="far fa-id-badge fa-2x s-menu" id="f1"></li>
                </div>
                <div class="col col-4 sub-menu">
                    <li class="fas fa-paperclip fa-2x s-menu" id="f2"></li>
                </div>
                <div class="col col-4 sub-menu">
                    <li class="far fa-bookmark fa-2x s-menu" id="f3"></li>
                </div>
            </div>
            <div class="row secciones">
                <div class="col-12 form" id="f1">
                    <br>
                    <form action="#" class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control mb-6 mr-sm-5 mb-sm-0" id="nombres" placeholder="Nombres">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control mb-6 mr-sm-5 mb-sm-0" id="apellidos" placeholder="Apellidos">
                        </div>
                    </form>
                    <br>
                    <form action="#">
                        <input type="email" class="form-control" id="email1" placeholder="e-mail">
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <form action="#">
                                <div class="form-group">
                                    <label for="fechaN">Fecha nacimiento:</label>
                                    <br>
                                    <input type="text" id="datepicker">
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <p >Sexo :</p>
                            <input type="radio" id="op1" name="sexo" value="1">
                            <label for="op1">Hombre</label>
                            <input type="radio" id="op2" name="sexo" value="0">
                            <label for="op2">Mujer</label>

                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-end">
                        <button class="btn   riues-btn " id="reg-btn-1" >Siguiente <span class="fas fa-angle-right"></span></button>
                    </div>
                </div>
                <div class="col-12 form" id="f2">
                    <br>
                    <div class="row img-form">
                        <div class="col col-5">
                            <img id="img_destino" src="{{asset('img.png')}}" alt="Foto Investigador" required>
                        </div>
                        <div class="col col-7" style="padding: 5px;">
                            <form action="">
                                <label for="file_url">Seleccione un foto :</label>
                                <input type="file" id="file_url" accept=".png,.jpg,.jpeg" style="color: transparent">
                            </form>
                            <form action="#">
                                <div class="form-group">
                                    <label for="grado">Grado academico: </label>
                                    <select id="grado" class="form-control" >

                                    </select>
                                </div>

                                
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <form action="#">
                            <div class="form-group">
                                <label for="pais">Pais :</label>
                                <select name="pais" id="" class="form-control">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" placeholder="Direccion">
                            </div>
                            <div class="form-group">
                                <label for="horas">Horas dedicadas a investigacion</label>
                                <input type="number" placeholder="Horas">
                            </div>
                        </form>
                    </div>
                    <br>
                    
                </div>
                <div class="col-12 form" id="f3">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ducimus ea eius, facilis maxime minima neque porro provident tempore vel.
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script  src="{{asset('js/registro.js')}}"></script>
@stop