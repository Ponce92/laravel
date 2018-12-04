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
    <li class="breadcrumb-item active">Foros</li>


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

        <div class="table-responsive">
            @if(isset($foros))

                <!-- /* <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Foro del Proyecto</th>
                            <th scope="col">Red</th>
                            <th scope="col">Acronimo</th>
                            <th scope="col">Descripcion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foros as $foro )
                        <tr>
                            <td>


                                @foreach($forums as $f)
                                    <a href="/foros/show/{{$f->fk_id_proyecto == $foro->codigoProyecto ? $f->pk_id_foro:''}}">{{$f->fk_id_proyecto == $foro->codigoProyecto ? $foro->nombreProyecto:''}}</a>
                                    <a href="{{route('foros.shows', ['id' => $f->fk_id_proyecto == $foro->codigoProyecto ? $f->pk_id_foro:''])}}">{{$f->fk_id_proyecto == $foro->codigoProyecto ? $foro->nombreProyecto:''}}</a>
                                @endforeach


                            </td>
                            <td>{{$foro->rt_nombre_red}}</td>
                            <td>{{$foro->acronimoProyecto}}</td>
                            <td>{{$foro->descripcionProyecto}}</td>

                        </tr>

                            @endforeach
                        <br><br>
                        </tbody>
                </table> */ -->
                <div class="card-deck">
                    @foreach($foros as $r)

                        <div class="card"style="max-width: 18rem">
                            <div class="card-header text-center">
                                <i class=" {{$r['icono']}} fa-3x {{$r['color']}}"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="text-h4-card">
                                    {{$r->rt_nombre_red}}
                                </h4>
                                <label for="#">Proyecto asociado :  </label>
                                <br>
                                {{$r['nombreProyecto']}}
                                <br>

                            </div>
                            <div class="card-footer">
                                        @foreach($forums as $f)
                                           @if($f->fk_id_proyecto == $r->codigoProyecto )
                                              <a href="{{route('foros.shows', ['id' => $f->fk_id_proyecto == $r->codigoProyecto ? $f->pk_id_foro:''])}}">
                                           @endif
                                        @endforeach
                                        <div class="row justify-content-end">
                                            <button class="btn bttn bttn-red" style="color: white;">Ver Foro</button>
                                        </div>
                                    </a>

                                <div class="col-1"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br><br>
        </div>
        @else

            <div class="row cuerpo-seccion">
                <div class="col">

                    <div class="row">
                        <br>
                        <h4>A Actualmente No participas en ningun foro</h4>

                    </div>
                </div>
            </div>

        @endif


    </div>
    <br>

@endsection

@section('js')


@endsection