@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item ">Proyectos de investigacion</li>
    <li class="breadcrumb-item active">Busqueda</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-6">
                <h2 class="titulo-seccion titulo">Mis proyectos de investigacion</h2>
            </div>
            <div class="col-6">
                <div class="row justify-content-end">
                    <div class="col-6">
                        <form id="filtrar" action="{{route('Busqueda.Proyectos')}}" method="get">
                            <select name="tipo_proyecto"
                                    id="tipo_proyecto"
                                    form="filtrar"
                                    class="form-control input-lg"
                                    onchange="this.form.submit()"
                            >
                                <option value="-1" {{$bsq ==-1 ? 'selected':''}}>Selecione tipo de proyecto</option>
                                @foreach($tiposProyectos as $tipo)
                                    <option value="{{$tipo->pk_id_tipo_proyecto}}" {{$bsq ==$tipo->pk_id_tipo_proyecto ? 'selected':''}}>
                                        {{$tipo->rd_descripcion}}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                    </div>

                    <div class="col-1"></div>
                </div>
            </div>

        </div>
        <hr>
        <br>
        <div class="row cuerpo-seccion">
            <div class="container-fluid">
                @include('Common.FlashMsj')
                <div class="row">
                    @if(count($proyectos) !=0 )
                        @foreach($proyectos as $prj)
                            <div class="card mb-3" style="width: 18rem;margin-left: 15px">
                                <div class="card-header">
                                    <div class="row justify-content-center">
                                        <i class="{{$prj->getDetalleProyecto()->getIcono()->getNombre()}}
                                                    fa-4x
                                                    {{$prj->getDetalleProyecto()->getColor()->getValor()}}"></i>
                                        {{--<i class="{{$prj['icono']}} fa-3x {{$prj['color']}}"></i>--}}
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="cb-tit-prj">
                                        {{$prj->rt_titulo_proyecto}}
                                    </h4>
                                </div>
                                <div class="card-footer">
                                    <div class="row justify-content-end">
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="{{route('ver.detalle.proyecto')}}/{{$prj->getId()}}">
                                            <button class="btn bttn-red btn-lg">
                                                Ver detalle
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <br><br><br><br>
                        <div class="col-10 offset-1">
                            <h1 style="color: rgb(100,100,100);font-weight: bold;font-family: 'Open Sans'">
                                "No hemos encontrado proyectos disponibles"
                            </h1>
                        </div>

                    @endif
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
@endsection

@section('js')

@endsection



