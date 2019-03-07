@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">
@endsection


@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item active">Foros</li>
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-10">
                <h2 class="titulo-seccion titulo" >Mis Foros</h2>
            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
        <div class="col-md-12 cuerpo-seccion" style="min-height: 400px;">
            <div class="row">
                @if(count($foros) > 0 )
                    <table class="table">
                        <thead>
                        <tr style="background-color: #aa0000;color: #fff;" >
                            <th scope="col"></th>
                            <th scope="col">Red Asociada</th>
                            <th scope="col">Tematicas</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foros as $obj)
                            <tr style="font-weight: bold;">
                                <td align="center"><i class="fa fa-globe  fa-2x bttn"></i></td>
                                <td>{{$obj->rt_nombre_red}}</td>
                                <td>{{$obj->co}}</td>
                                <td align="center">
                                    <a href="{{route('tematicas.index',['id'=>$obj->pk_id_foro])}}">
                                        <i class="fas fa-eye fa-2x bttn bttn-ver"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                @else
                    @include('AdminFragment.frg_default')
                @endif
            </div>

        </div>

        <div class="col-md-12 pie-seccion">
            @if(count($foros) > 0 )
                <div class="row justify-content-end">
                    {{ $foros->links('Frg.link') }}
                    <div class="col-md-1"></div>
                </div>

            @endif
        </div>

    </div>
    <br>
@endsection

@section('js')


@endsection