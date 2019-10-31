@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item ">Ajustes</li>
    <li class="breadcrumb-item active">Estados de Proyectos</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Estados de Proyectos</h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end" style="padding-right: 25px;">
                    <a href="{{ route('estado.crear') }}">
                        <button class="btn bttn-red">
                            &nbsp;&nbsp;Agregar &nbsp;&nbsp;
                        </button>

                    </a>
                </div>
            </div>
        </div>
        <hr class="all" style="margin-top: 0px;">
        <div class="cuerpo-seccion">
            <br>
            @include('Common.FlashMsj')
            <div class="row">
                @if(count($list) > 0)
                    <div class=" col col-12">
                        <div class="row justify-content-end" style="padding-right: 25px;">
                            <p>
                                {{$list->total()}} registros | página {{$list->currentPage()}} de {{$list-> lastPage()}}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <td class="td" align="center" style="width: 25px;">Código</td>
                                    <td class="td" align="center">Nombre</td>
                                    <td class="td" align="center">Estado</td>
                                    <td class="td" align="center">Acciones</td>
                                    </thead>
                                    @foreach ($list as $obj)
                                        <tr>
                                            <td align="center">
                                                {{ $obj->getId() }}
                                            </td>
                                            <td align="center">{{ $obj->getNombre() }}</td>
                                            <td align="center">{{ $obj->getEstadoo() ? 'Activo':'Inactivo' }}</td>
                                            <td align="center" class="align-middle">
                                                <a href="{{ route('estado.editar',[$id=$obj->getId()]) }}">
                                                    <i class="fas fa-edit bttn" style="font-size: 26px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="pagination" style="padding-right: 25px;"> {{ $list->links('Frg.link ')}} </div>

                        </div>
                    </div>
                @else
                    @include('AdminFragment.frg_default')

                @endif
            </div>

        </div>
    </div>

@endsection

@section('js')
    @if($errors->any())
    <script type="text/javascript">
    $('#btn_crear').click();
    </script>
    @endif
@endsection