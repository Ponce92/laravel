
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Login</title>

@stop

@section('cuerpo')
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col col-xs-12 col-sm-12 col-md-5 col-lg-4">

            <form class="login-riues" method="post" action="{{ route('login') }}">
                {{ csrf_field()  }}
                <div class="login-titulo">Login </div>
                <div class="form-group mb-3 ">
                    <label for="usuario">Usuario</label>
                    <input type="text"
                           class="form-control {{ $errors->has('usuario') ? 'is-invalid' : '' }}"
                           name="usuario"
                           value="{{ old('usuario') }}"
                           id="usuario"
                           placeholder="Usuario">
                    {!! $errors->first('usuario','<div class="invalid-feedback">:message</div>' )!!}
                </div>

                <div class="form-group">
                    <label for="clave">Contrasenia</label>
                    <input type="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           name="password"
                           id="clave"
                           placeholder="****">
                    {!! $errors->first('password','<div class="invalid-feedback">:message</div>' )!!}
                </div>
                {!! $errors->first('ss','<br><div class="alert alert-danger" role="alert">Errorr en la autenticacion del usuario</div>') !!}
                <br>
                <div class="form-group justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <button class="btn btn-default  " style="background-color: #aa0000;color: white;">
                                    &nbsp; Ingresar &nbsp;
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <a
                                        class="btn btn-success"
                                        href="registros/create"
                                        style="margin-right: 25px;">Crear Registro</a>
                            </div>
                        </div>


                    </div>

                <div class="row justify-content-center">
                    <a
                        href="{{route('getResetForm')}}"
                        style="color: #3e4548;margin-right: 25px;">Restablecer Credenciales</a>
                </div>

            </form>
        </div>
    </div>

@stop

@section('js')
    @parent

@stop