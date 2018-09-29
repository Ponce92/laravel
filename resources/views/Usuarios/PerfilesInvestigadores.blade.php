@extends('Common.adminLayout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">

@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item">Invetigadores</li>
    <li class="breadcrumb-item active">Registros</li>

@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-9">

                        <h2 class="title titulo">
                            Perfiles de investigadores
                        </h2>
                    </div>
                    <div class="col-3">
                        <form name="frm-tip" id="frm-tip" method="get" >
                            <div class="input-group">
                                <select class="custom-select custom-select-lg"
                                        id="opt"
                                        style="color: #aa0000"
                                        name="opt"
                                        onchange="this.form.submit()"
                                        style="font-weight: bold"
                                >
                                    <option value="100" {{100 ==$fkId ? 'selected':''}}>Todas las areas</option>
                                    @foreach($areas as $area)
                                        <option value="{{$area->pk_id_area}}" {{$area->pk_id_area ==$fkId ? 'selected':''}}>{{$area->rt_nombre_area}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <input type="text"
                           name="busqueda"
                           id="busqueda"
                           form="frm-tip"
                           value="@if(isset($bsq)){{$bsq}} @endif"
                           class="form-control"
                           url="{{route('getNombresPerfilesAjax')}}"
                    >
                    <div class="input-group-append">
                        <div class="input-group-text bttn-ver" onclick="formulario()" style="background-color: #aa0000">

                            <i class="fas fa-search" style="color: white;"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        {{--Busqueda fin--}}

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered ">
                    <thead hidden>
                    <tr>
                        <td class="3"></td>
                        <td colspan="2"></td>
                        <td colspan="3"></td>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($invs))
                        @foreach($invs as $obj)
                            <tr scope="row">
                                <td  colspan="1" rowspan="3" align="center" class="align-middle" style="width: 200px!important;">
                                    <img src="{{asset('avatar/')}}/{{$obj['foto']}}"
                                         alt="{{$obj['foto']}}"
                                         class=" img img-thumbnail"
                                         width="150px"
                                    />
                                </td>
                                <td colspan="2">
                                    <strong>Nombre:</strong>
                                    {{$obj['nombre']}}&nbsp;
                                    {{$obj['apellido']}}
                                </td>
                                <td colspan="1">
                                    <strong>Sexo :</strong>{{$obj['sexo'] ==1 ?  "Mujer":'Hombre'}}
                                </td>
                                <td colspan="1">
                                    <strong>Edad:</strong>
                                </td>

                                <td colspan="1" rowspan="3" align="center" class="align-middle">
                                    <a href="{{route('getPerfilesInvestigadores')}}/detalle/{{$obj['id']}} ">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"></i>
                                    </a>
                                </td>
                                <td colspan="1" rowspan="3" class="align-middle" align="center">

                                    <i class="fas fa-cog fa-2x bttn bttn-ver b"></i>
                                    <div id="toolbar-options" class="hidden">
                                        <a href="#"><i class="fa fa-users">  Agregar a contactos</i></a>
                                        <a href="#"><i class="fa fa-chart-pie">  Invitar a proyecto</i></a>
                                    </div>

                                </td>
                            </tr>
                            <tr scope="row">
                                <td colspan="4">
                                    <strong>Correo Electronico :</strong>{{$obj['email']}}
                                </td>

                            </tr>
                            <tr scope="row">

                                <td colspan="1">
                                    <strong>Publicaciones:</strong>{{$obj['npu']}}
                                </td>
                                <td colspan="1">
                                    <strong>Proyectos realizados:</strong>{{$obj['npr']}}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        @endforeach
                    @else
                        <p>no tienes nada que hacer </p>
                    @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <br>
@endsection

@section('js')

    <script  src="{{asset('js/tools/jquery.toolbar.min.js')}}"></script>
    <script  src="{{asset('js/PefilesInvestigadores.js')}}"></script>
@endsection

