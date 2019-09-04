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
    <li class="breadcrumb-item active">Temáticas</li>
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">

        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Temáticas del Foro </h2>
            </div>
            <div class="col-4">
                <div class="row justify-content-end">
                    
                    <a href="{{route('tematicas.crear',['id'=>$idf])}}">
                        <button  class="btn bttn bttn-red">&nbsp;&nbsp; Agregar Temática &nbsp;&nbsp;</button>
                    </a>
                </div>
            </div>
        </div>
        <hr>
        @include('Common.FlashMsj')
        <div class="table-responsive">
                @if(isset($frs))
                    <table class="table table-bordered">

                        @foreach($frs as $tema )
                            <tr>
                                <td>{{$tema->fk_id_foro}}</td>
                                <td>
                                        <a href="{{route('respuestas.shows', ['id' => $tema->pk_id_tema, 'idf' => $tema->fk_id_foro  ])}}">{{$tema->titulo}}</a>
                                </td>
                                <td>{{$tema->body}}</td>
                                <td>{{$tema->id_creador}}
                                    <img src="{{asset('avatar/'.$user->rt_foto_usuario)}}"
                                         alt="vista no disponible"
                                         class="img-thumbnail"
                                    >
                                </td>
                                <td>{{$tema->re_count}}</td>
                                <td>{{$tema->visitas}}</td>
                                <td>{{$tema->fecha}}</td>

                            </tr>

                        @endforeach
                        <br><br>
                        </tbody>
                        */ -->
                        @foreach($frs as $tema )
                            <tr>
                                <div class="container">
                                    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
                                    <div class="well well-sm">
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                @foreach($perfiles as $p)
                                                    @if($p->pk_id_usuario == $tema->id_creador )
                                                        <img class="media-object" width="100" height="100" src="{{asset('avatar/')}}/{{$p->pk_id_usuario == $tema->id_creador ? $p->rt_foto_usuario:''}}">
                                                    @endif
                                                @endforeach
                                            </a>
                                            <div class="media-body">
                                                <h4><a class="media-heading" href="{{route('respuestas.shows', ['id' => $tema->pk_id_tema, 'idf' => $tema->fk_id_foro  ])}}">Título: {{$tema->titulo}}</a></h4>
                                                @foreach($perfiles as $p)
                                                    @if($p->pk_id_usuario == $tema->id_creador )
                                                        <p class="text-left text-info"  >By {{$p->rt_nombre_persona}}</p>
                                                    @endif
                                                @endforeach

                                                <p class="lead">{{$tema->body}}</p>
                                                <ul class="list-inline list-unstyled">
                                                    <li><span><i class="glyphicon glyphicon-calendar"></i> {{$tema->fecha}} </span></li>
                                                    <li>|</li>
                                                    <span> {{$tema->re_count}} <i class="glyphicon glyphicon-comment"></i> Respuestas</span>
                                                    <li>|</li>
                                                    <span><i class="glyphicon glyphicon-edit"></i><a href="{{route('respuestas.show',['id' => $tema->pk_id_tema ])}}"> Responder </a></span>
                                                    <li>|</li>
                                                    <span><i class="glyphicon glyphicon-trash"></i><a href="{{route('eliminar.tema',['id' => $tema->pk_id_tema ])}}"> Eliminar</a></span>


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
                    @include('AdminFragment.frg_default')
                 @endif


        </div>
        <br>
@endsection

@section('js')

@endsection