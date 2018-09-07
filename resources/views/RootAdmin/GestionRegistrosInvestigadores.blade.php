@extends('Common.adminLayout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')

    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-10">
                        <h2 class="title" style="font-weight: bold">Solicitudes de registro</h2>
                    </div>
                    <div class="col-2"></div>
                    <hr>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                @if($count1 != 0)
                    <div class="row">
                        <table class="table">
                            <tbody>
                                @foreach($nuevos as $obj)
                                    <tr>
                                        <td class="align-middle" width="80px">
                                            <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                        </td>
                                        <td >
                                            <div class="row">
                                                <div class="col">
                                                    <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                    <b></b><br>
                                                    <b>Correo :</b>{{$obj->rt_correo_usuario}}<br>
                                                </div>
                                            </div>
                                        </td>
                                        <td></td><td></td>
                                        <td class="align-middle">
                                            <i class="fas fa-eye fa-2x bttn bttn-ver"></i>
                                        </td>
                                        <td class="align-middle">
                                            <i class="fas fa-toggle-off fa-2x bttn bttn-ver " ></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <h3 style="color: #555555; font-weight: bold">No Hay solicitudes nuevas.</h3>
                    <br>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-10">
                        <h2 class="title" style="font-weight: bold">Usuarios Activos</h2>
                    </div>
                    <div class="col-2"></div>
                    <hr>

                </div>
            </div>

            <div class="col-12">
                @if($count2 !=0)
                    <div class="row">
                        <table class="table">
                            <tbody>
                            @foreach($Activos as $obj)
                                <tr>
                                    <td class="align-middle" width="80px">
                                        <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                    </td>
                                    <td >
                                        <div class="row">
                                            <div class="col">
                                                <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                <b></b><br>
                                                <b>Correo :</b>{{$obj->rt_correo_usuario}}<br>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td><td></td>
                                    <td class="align-middle">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"></i>
                                    </td>
                                    <td class="align-middle">
                                        <i class="fas fa-toggle-off fa-2x bttn bttn-ver " ></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 style="color: #555555; font-weight: bold">No hay registros que mostrar.</h3>
                    <br>
                @endif

            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-12">
                <div class="row">
                    <div class="col-10">
                        <h2 class="title" style="font-weight: bold">Usuarios Inactivos</h2>
                    </div>
                    <div class="col-2"></div>
                    <hr>

                </div>
            </div>

            <div class="col-12">
                @if($count3 !=0)
                    <div class="row">
                        <table class="table">
                            <tbody>
                            @foreach($Inactivos as $obj)
                                <tr>
                                    <td class="align-middle" width="80px">
                                        <img class="avatar" src="{{asset('avatar/'.$obj->rt_foto_usuario)}}" alt="Error al cargar foto">
                                    </td>
                                    <td >
                                        <div class="row">
                                            <div class="col">
                                                <b>{{$obj->rt_nombre_persona}}&nbsp;{{$obj->rt_apellido_persona}}</b><br>
                                                <b> Ultima conexion:</b>

                                                <br>
                                                <b>Correo :</b>{{$obj->rt_correo_usuario}}<br>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td><td></td>
                                    <td class="align-middle">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"></i>
                                    </td>
                                    <td class="align-middle">
                                        <i class="fas fa-toggle-off fa-2x bttn bttn-ver " ></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h3 style="color: #555555; font-weight: bold">No hay registros que mostrar.</h3>
                    <br>
                @endif

            </div>
        </div>
    </div>
    <br>
@endsection

@section('js')
    <script  src="{{asset('js/GestionInvestigadores.js')}}"></script>
@endsection

