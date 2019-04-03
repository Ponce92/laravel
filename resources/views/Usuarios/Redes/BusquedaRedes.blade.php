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
<li class="breadcrumb-item active">Busqueda de redes</li>


@endsection

@section('default')
<div class="container-fluid area-trabajo" id="area-trabajo">
    <br>
    <div class="row cabeza-seccion">
        <div class="col-6">
            <h2 class="titulo-seccion titulo" >Redes de investigadores</h2>
        </div>
        <div class="col-6">
            <div class="row justify-content-end">
                <div class="col-6">
                    <form id="filtrar" action="{{route('redes.busqueda')}}" method="get">
                        <select name="tipo_proyecto"
                                id="tipo_proyecto"
                                class="form-control input-lg"
                        >
                            <option value="0" {{$bsq ==0 ? 'selected':''}}>Selecione tipo de proyecto</option>
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
    @include('Common.FlashMsj')
    <div class="row cuerpo-seccion">
        @if(count($redes)>0)
            <div class="col-md-12">
                <div class="row">
                @foreach($redes as $red)

                    <div class="card mb-3"   style="width: 15rem;margin-left: 15px;" >
                        <div class="card-header text-center">
                            <i class=" {{$red->rt_icono}} fa-3x {{$red->rt_valor}}"></i>
                        </div>
                        <div class="card-body">
                            <h4 class="text-h4-card">
                                {{$red->rt_nombre_red}}
                            </h4>
                            <label for="#">Proyecto asociado :  </label>
                            <br>
                            {{--{{$red->}}--}}
                            <br>

                        </div>
                        <div class="card-footer">
                            <a href="{{route('redes.busqueda')}}/detalle/{{$red->pk_id_red}}">
                                <div class="row justify-content-end">
                                    <button class="btn bttn bttn-red" style="color: white;">Ver detalle</button>
                                </div>
                            </a>
                            <div class="col-1"></div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="col-md-12">
                <div class="row justify-content-end">
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            {{ $redes->links('Frg.link') }}
                        </div>
                    </div>
                </div>
            </div>

        @else
            @include('AdminFragment.frg_default')
        @endif
    </div>
</div>
<br>

@endsection

@section('js')
<script  src="{{asset('js/Redes/Redes.js')}}"></script>
@endsection



