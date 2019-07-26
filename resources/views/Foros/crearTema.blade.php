<!-- Modal -->
<div class="modal fade" id="crearTema" >
    <form method="POST" action="/foros" enctype="multipart/form-data">
        {{ csrf_field()  }}
        <div class="modal-dialog modal-lg" role="document">
            <br>
            <br>
            <br>
            <br>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Ingrese los Datos de la Temática</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cancelar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if($errors->any())
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-danger">
                                <i class="fas fa-info-circle" style="color: #aa0000"></i>
                                {{$errors->first()}}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="modal-body">
                    <div class="form-group row">
                        <label for="titulo" class="col-md-4 col-form-label text-md-right">Titulo del Tema</label>
                        <div class="col-md-6">
                            <input type="hidden" name="idf" value="{{$idf}}">
                            <input id="titulo" type="text" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" value="{{ old('titulo') }}" required autofocus>

                            @if ($errors->has('titulo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('titulo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion</label>
                        <div class="col-md-6">
                            <textarea id="descripcion" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion"  required >
                            </textarea>
                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </form>
</div>