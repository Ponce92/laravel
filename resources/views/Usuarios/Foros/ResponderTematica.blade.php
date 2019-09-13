@extends('Common.adminLayout')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comun.css')}}">
@endsection

@section('menuIzq')
    @include('AdminFragment.FrgMenIzq')
@endsection

@section('menu-sup-02')
    <li class="breadcrumb-item"><a href="">Inicio</a></li>
    <li class="breadcrumb-item"><a href="">Foros</a></li>
    <li class="breadcrumb-item"><a href="">{{$tematica->getTitulo()}}</a></li>
    <li class="breadcrumb-item active">Responder</li>
@endsection

@section('default')
    <script src="{{asset('framework/TextoEnriquecido/ckeditor/ckeditor.js')}}"></script>
    <div class="container-fluid area-trabajo" id="area-trabajo">
        <br>
        <div class="row cabeza-seccion">
            <div class="col-8">
                <h2 class="titulo-seccion titulo">Responder</h2>
            </div>

        </div>
        <hr>

        <div class="row">
            <div class="col col-12">
                @include('Common.FlashMsj')
            </div>
        </div>
        <div class="row cuerpo-seccion">
            <div class="col-md-12">
                <form method="post" id="agregar" action="{{route('tematica.respuesta')}}" enctype="multipart/form-data">
                    {{ csrf_field()  }}
                    <input type="hidden" name="idt" value="{{$tematica->getId()}}">

                    <br>
                    <div class="form-group">

                        <div class="col-md-12">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="desc"
                                      class="form-control {{ $errors->has('descripcion') ? ' is-invalid' : '' }}"
                                      name="desc"
                                      cols="8"
                                      rows="10"
                                      required>
                            </textarea>
                            @if ($errors->has('desc'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif

                        </div>

                    </div>

                </form>
            </div>


        </div>
        <br>
        <div class="pie-seccion">
            <div class="row justify-content-end">
                <div class="col-md-3 col-sm-6">
                    <button type="reset" class="btn btn-lg bttn bttn-exit" style="color: #fff" >Cancelar</button>
                    &nbsp;
                    <button type="submit"
                            form="agregar"
                            class="btn btn-lg bttn bttn-red"
                            onclick="this.form.submit()"
                    >Agregar tema</button>
                </div>
            </div>

        </div>

    </div>
    <br>
    <script>
        CKEDITOR.replace( 'desc' ,{
            language:'es',
        });
    </script>

@endsection
