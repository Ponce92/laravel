@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Inicio</a></li>
    <li class="breadcrumb-item ">Proyectos de investigación</li>
    <li class="breadcrumb-item active">Búsqueda</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-6">
                <h2 class="titulo-seccion titulo">Mis proyectos de investigación</h2>
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
                                <option value="-1" {{$bsq ==-1 ? 'selected':''}}>Seleccione el tipo de proyecto</option>
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
                                        <i class="{{$prj->rt_icono}}
                                                    fa-4x
                                                    {{$prj->rt_valor}}"></i>
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
                                        <a href="{{route('ver.detalle.proyecto')}}/{{$prj->pk_id_proyecto_investigacion}}">
                                            <button class="btn bttn-red btn-lg">
                                                Ver detalle
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @include('AdminFragment.frg_default')

                    @endif
                </div>
                <div class="row justify-content-end">
                    {{$proyectos->links('Frg.link')}}
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
@endsection

@section('js')

@endsection



