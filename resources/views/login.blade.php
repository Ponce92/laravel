
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Login</title>

@stop

@section('cuerpo')
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col col-xs-12 col-sm-12 col-md-5 col-lg-4">

            <form class="login-riues">
                <div class="login-titulo">Login </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                </div>
                <br>
                <div class="form-group">
                    <label for="clave">Contrasenia</label>
                    <input type="password" class="form-control" id="clave" placeholder="****">
                </div>
                <br>
                <div class="form-group justify-content-center">
                    <div class="row justify-content-center">
                        <button class="btn btn-default  riues-btn">Login</button>
                    </div>

                </div>
                <div class="row justify-content-end">
                    <a href="registro" style="color: #3e4548;margin-right: 25px;">Crear Registro</a>
                </div>

            </form>
        </div>
    </div>

@stop

@section('js')
    @parent

@stop