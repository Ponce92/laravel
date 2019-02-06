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
        <li class="breadcrumb-item active">Mis redes</li>


@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo" >Mis redes</h2>
            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
        <div class="row cuerpo-seccion">

                @if(count($redes)>0)

                    @foreach($redes as $red)

                            <div class="card"style="width: 15rem;margin-left: 15px;">
                            <div class="card-header text-center">
                                <i class=" {{$red['icono']}} fa-3x {{$red['color']}}"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="text-h4-card">
                                    {{$red->rt_nombre_red}}
                                </h4>
                                <label for="#">Proyecto asociado :  </label>
                                <br>
                                {{$red['nombreProyecto']}}
                                <br>

                            </div>
                            <div class="card-footer">
                                <a href="{{route('redes.todas')}}/detalle/{{$red->pk_id_red}}">
                                    <div class="row justify-content-end">
                                        <button class="btn bttn bttn-red" style="color: white;">Ver detalle</button>
                                    </div>
                                </a>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    @endforeach


                @else
                    <div class="row">
                        <h4>
                            No tienes ninguna red a mostrar.
                        </h4>
                    </div>
                @endif

        </div>
    </div>
    <br>

@endsection

@section('js')
    <script  src="{{asset('js/DetalleInvestigador.js')}}"></script>
@endsection



