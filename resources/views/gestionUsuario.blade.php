@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">perfil</li>
    <li class="breadcrumb-item active">usuario</li>
@endsection


@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        {{--        Sección de Usuario del investigador      --}}
        <br>
        <div class="row">
            <div class="col-10">
                <h2 class="titulo-seccion titulo">Usuario</h2>
            </div>

            <div class="col-2 align-middle" style="align-content: center;display: flex;align-items: center">
                <div class="row align-items-center" >
                    <div class="col">
                        <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                    </div>
                </div>

                <div class="col">
                    @if($errors->any())
                        <i class="fas fa-toggle-on fa-2x activo" id="switch-usuario">  </i>
                    @else
                        <i class="fas fa-toggle-off fa-2x inactivo" id="switch-usuario">  </i>
                    @endif
                </div>
            </div>
            <hr>
            <br>
        </div>
        <form id="frm-usuario"
              name="frm-usuario"
              action="{{route('actualizarUsuario')}}"
              method="post"
        >
            {{ csrf_field()  }}

            <div class="row">
                @if($errors->any())
                    <div class=" col alert alert-danger">
                        <i class="fas fa-exclamation-triangle">  </i>&nbsp;&nbsp; Por favor corrija los campos indicados.
                    </div>
                @endif
                @if(isset($estado))
                    <div class="col alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ $estado }}
                    </div>

                @endif
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="correo">E-Mail: </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email"
                               form="frm-usuario"
                               name="email"
                               id="email-e"
                               value="{{$user->email}}"
                               class="form-control"
                               disabled
                        >
                    </div>

                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-6">
                    <label for="viejoPassword">Ingrese la antigua contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input  type="password"
                                form="frm-usuario"
                                name="viejoPassword"
                                id="viejoPassword"
                                class="form-control @if($errors->has('viejoPassword')) is-invalid @endif"
                                required
                                @if($errors->any())
                                @else
                                disabled
                                @endif
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('viejoPassword') }}
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col">
                    <label for="nuevaClave">Ingrese su nueva contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input  type="password"
                                form="frm-usuario"
                                name="password"
                                id="password"
                                class="form-control @if($errors->has('password')) is-invalid @endif"
                                required
                                required
                               @if($errors->any())
                                @else
                                    disabled
                                @endif
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('password')}}
                        </div>
                    </div>
                </div>

                <div class="col">
                    <label for="fonfirm">Confirme su contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                        <input type="password"
                               form="frm-usuario"
                               name="password_confirmation"
                               id="password_confirmation"
                               class="form-control @if($errors->has('password_confirmation')) is-invalid @endif"
                               required
                               @if($errors->any())
                                   @else
                                   disabled
                                   @endif
                        >
                        <div class="invalid-feedback">
                            {{$errors->first('password_confirmation')}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </form>
        <div class="row pie-seccion">
            <div class="col col-10"></div>
            <div class="col col-1">
                <button class="boton-rojo-riues"
                        id="btn-usuario"
                        form="frm-usuario"
                        @if($errors->any())
                        @else
                        disabled
                        @endif
                >
                    Actualizar
                </button>
            </div>

        </div>

    </div>
    <br>
@endsection

@section('js')
    <script  src="{{asset('js/usuario.js')}}"></script>
@endsection



