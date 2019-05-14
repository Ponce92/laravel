@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/Tools/jquery.toolbar.css')}}">
@endsection


@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/foros">Foros</a></li>
    <li class="breadcrumb-item active"></li>
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('default')
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">{{$tematica->getTitulo()}} </h2>
            </div>
        </div>
        <hr>
        <br>
        @include('Common.FlashMsj')
        <div class="cuerpo-seccion" style="min-height: 400px;">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    {!!$tematica->getDesc()!!}
                </div>
            </div>
            <div class="row justify-content-end">
                {{-- <div class="col-md-3">
                    <div class="row align-content-center">
                        <div class="col-md-2">
                            <img src="{{asset('/avatar/'.$tematica->getUser()->getFoto())}}"
                                 alt="Nombre de la persona"
                                 title="{{$tematica->getUser()->getCorreo()}}"
                                 class="rounded-circle"
                                 width="50"
                                 height="50"
                                 style="border: 1px solid rgb(165,165,165);"
                            >
                        </div>
                        <div class="col-md-9">
                            <strong>{{$tematica->getFecha()}} &nbsp;&nbsp;</strong>
                            <br>
                            {{$tematica->getUser()->getCorreo()}}
                        </div>
                    </div>
                </div> --}}
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h3>
                        <strong> {{count($tematica->getRespuestas())}} Respuestas</strong>
                    </h3>
                </div>
                <hr>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @foreach($tematica->getRespuestas() as $res)
                        <div class="row">
                            <div class="col-md-1">
                                <i class="fas fa-info-circle fa-3x" style="color:rgb(110,110,110);"></i>
                            </div>
                            <div class="col-md-11">
                                <div class="row">
                                    {!! $res->getDesc() !!}
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-md-3">
                                        <div class="row align-content-center">
                                            <div class="col-md-2">
                                                <img src="{{asset('/avatar/'.$res->getUser()->getFoto())}}"
                                                     alt="Nombre de la persona"
                                                     title="{{$res->getUser()->getCorreo()}}"
                                                     class="rounded-circle"
                                                     width="50"
                                                     height="50"
                                                     style="border: 1px solid rgb(165,165,165);"
                                                >
                                            </div>
                                            <div class="col-md-9">
                                                <strong>{{$res->getFecha()}} &nbsp;&nbsp;</strong>
                                                <br>
                                                {{$res->getUser()->getCorreo()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr>
                                    <div class="col-md-12">
                                        @foreach ($res->getComentarios() as $com)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>
                                                        {{$com->getValor()}} -&nbsp;
                                                        <strong style="color:rgb(110,110,110);">{{$com->getUser()->getCorreo()}}</strong>
                                                        &nbsp;
                                                        <span style="color:rgb(200,200,200);">{{$com->getFecha()}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12">
                                        <form class="{{$res->getId()}} frm" action="{{route('tematica.comentar')}}" method="post">
                                            {{ csrf_field()  }}
                                            <div class="form-row">
                                                <input type="text" hidden name="tem" value="{{$tematica->getId()}}">
                                                <input  name="res" hidden type="text" name="" value="{{$res->getId()}}">
                                                <label for="comm"> Comentario :</label>
                                                <textarea required id="comm" name="comm" class="comm form-control mb-4" rows="2" ></textarea>
                                            </div>
                                            <div class="form-row justify-content-end">
                                                <button type="button"
                                                        class="btn bttn bttn-exit"
                                                        name="button"
                                                        style="color:#fff;"
                                                        onclick="ocultar('{{$res->getId()}}')">Cancelar</button>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="submit"
                                                        class="btn bttn bttn-red"
                                                        name="button">Responder</button>
                                            </div>
                                        </form>
                                        <a href="#"  class="linkComent {{$res->getId()}}" onclick="mostrar('{{$res->getId()}}')">
                                            <strong>Comentar . . .</strong>
                                        </a>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <h2>Tu respuesta</h2>
                <br>
                <div class="col-md-12">
                    <form method="post" id="agregar" action="{{route('tematica.respuesta')}}" enctype="multipart/form-data">
                        {{ csrf_field()  }}
                        <input type="hidden" name="idt" value="{{$tematica->getId()}}">

                        <br>
                        <div class="form-group">

                            <div class="col-md-12">
                                <label for="descripcion">Descripcion :</label>
                                <textarea id="desc"
                                          class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                          name="desc"
                                          cols="8"
                                          rows="10"
                                          required=true
                                          >
                                </textarea>
                                @if ($errors->has('desc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif

                            </div>

                        </div>
                        <div class="form-row justify-content-end">
                            <button type="submit" class="btn btn-lg bttn bttn-red" style="margin-rigth:50px;">Agregar Respuesta</button>

                        </div>

                    </form>
                </div>


            </div>

        </div>
        <div class="row justify-content-end">
            {{-- <button type="button" class="btn btn-lg bttn bttn-red" data-toggle="modal" data-target="#responderTematica">
                Agregar Respuesta
            </button> --}}
            <div class="col-md-1"></div>
        </div>
        <br>

    <div class="pie-seccion">
    </div>
    {{--  ##################################       Modal de respuesta a tematica   ################################--}}


</div>
    <br>

@endsection

@section('js')
<script src="{{asset('framework/TextoEnriquecido/ckeditor/ckeditor.js')}}"></script>
<script>
    $('.frm').hide();
    CKEDITOR.replace( 'desc' ,{
        language:'es',
    });

    CKEDITOR.replace();


    function mostrar(id) {
        $('a.'+id).hide();
        $('form.'+id).show();
    }

    function ocultar(id){
        $('a.'+id).show();
        $('form.'+id).hide();
    }
</script>
@endsection
