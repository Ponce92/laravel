
@extends('Common.appLayout')
@section('title')
    <title>RIUES : : Login</title>

@stop

@section('cuerpo')
    <br>
    <div class="row justify-content-center">
        <div class="col col-xs-12 col-sm-12 col-md-5 col-lg-4">
            @include('Common.FlashMsj')
            <form class="login-riues" method="post" action="{{ route('login') }}">

                {{ csrf_field()  }}
                <div class="col-12">
                    <div class="row justify-content-center">
                        <h2 class="titulo">Login</h2>
                    </div>
                </div>
                <hr class="all">
                <div class="form-group mb-3 ">
                    <label for="usuario">Correo :</label>
                    <input type="text"
                           class="form-control {{ $errors->has('usuario') ? 'is-invalid' : '' }}"
                           name="usuario"
                           value="{{ old('usuario') }}"
                           id="usuario"
                           placeholder="Usuario">
                    {!! $errors->first('usuario','<div class="invalid-feedback">:message</div>' )!!}
                </div>

                <div class="form-group">
                    <label for="clave">Contraseña :</label>
                    <input type="password"
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                           name="password"
                           id="clave"
                           autocomplete="false"
                           placeholder="****">
                    {!! $errors->first('password','<div class="invalid-feedback">:message</div>' )!!}
                </div>
                {!! $errors->first('ss','<br><div class="alert alert-danger" role="alert">Errorr en la autenticacion del usuario</div>') !!}
                <br>
                <div class="form-group">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <button class="btn btn-default esq bttn-red">
                                    &nbsp;&nbsp; Ingresar &nbsp;&nbsp;
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <a
                                            class="btn btn-success esq"
                                            href="registros/create"
                                    >Crear Registro</a>
                                </div>

                            </div>
                        </div>


                    </div>


                    <br>
                <div class="row justify-content-center">
                    <a
                        href="{{route('getResetForm')}}"
                        style="color: #3e4548;margin-right: 25px;">¿Olvido sus credenciales? </a>
                </div>

            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="txt-pie">
                <br>
                Red de investigadores de la Universidad de Elsalvador
            </div>
        </div>
    </div>
@stop
@section('js')
    @parent

@stop
