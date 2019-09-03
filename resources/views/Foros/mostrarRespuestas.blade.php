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
    <li class="breadcrumb-item"><a href="/foros">Foros</a></li>
    <li class="breadcrumb-item"><a href="/foros/show/{{$idf}}">Temáticas</a></li>
    <li class="breadcrumb-item active">Respuestas</li>


@endsection

@section('default')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-md-8">
                <h1 class="titulo-seccion titulo" >Respuestas al tema:
                    @foreach($temas as $f)
                        <h2>{{$f->pk_id_tema == $idt ? $f->titulo:''}}</h2>
                    @endforeach
                </h1>
            </div>
            <div class="col-md-4">
                <div class="row justify-content-end">
                    <button onclick="location.href = '{{ route('respuestas.show',['id' => $idt ]) }}'" id="btn-agregar" class="boton-rojo-riues" >&nbsp;&nbsp; Agregar Respuesta &nbsp;&nbsp;</button>
                    </a>
                </div>
            </div>
        </div>

        <hr>
        <br>
        @include('Common.FlashMsj')

        <div class="table-responsive">
            @if(isset($resps))
                <table class="table table-bordered">
                   <!-- /* <thead>
                    <tr>
                        <th scope="col">Id Respuesta</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Creado por</th>
                        <th scope="col">Respuesta</th>
                        <th scope="col">Multimedia</th>
                        <th scope="col">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resps as $r )
                        <tr>
                            <td>{{$r->pk_id_respuesta}}
                            </td>
                            <td>{{$r->fk_id_tema}}</td>
                            <td>{{$r->id_usuario}}</td>
                            <td>{{$r->body}}</td>
                            <td>{{$r->fk_id_multimedia}}</td>
                            <td>{{$r->fecha}}</td>

                        </tr>

                    @endforeach
                           </tbody> */ -->


                    @foreach($resps as $r )
                    <tr>
                        <div class="container">
                            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
                        <div class="well">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    @foreach($perfiles as $p)
                                        @if($p->pk_id_usuario == $r->id_usuario )
                                    <img class="media-object" width="100" height="100" src="{{asset('avatar/')}}/{{$p->pk_id_usuario == $r->id_usuario ? $p->rt_foto_usuario:''}}">
                                        @endif
                                    @endforeach

                                </a>
                                <div class="media-body">

                                    @foreach($perfiles as $p)
                                    @if($p->pk_id_usuario == $r->id_usuario )
                                    <p class="text-left text-info">Respuesta By {{$p->rt_nombre_persona}}</p>
                                    @endif
                                    @endforeach
                                    <p class="lead">{{$r->body}}</p>
                                    <ul class="list-inline list-unstyled">
                                        <li><span><i class="glyphicon glyphicon-calendar"></i> {{$r->fecha}} </span></li>
                                        <li>|</li>
                                        <span><i class="glyphicon glyphicon-edit"></i><a href="{{route('respuestas.show',['id' => $idt ])}}">  Responder </a></span>
                                        <li>|</li>
                                        <span><i class="glyphicon glyphicon-trash"></i> <a href="{{route('eliminar.respuesta',['id' => $r->pk_id_respuesta, 'idf' => $idf ])}}"> Eliminar</a></span>




                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>
                    </tr>
                    @endforeach


                </table>
        </div>
        @else

            <div class="row cuerpo-seccion">
                <div class="col">

                    <div class="row">
                        <br>
                        <h4>&nbsp;&nbsp; No se han agregado respuestas.</h4>

                    </div>
                </div>
            </div>

        @endif


    </div>
    <br>

@endsection

@section('js')


@endsection