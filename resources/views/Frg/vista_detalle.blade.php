
<div class="row">
    <div class=" col col-12">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 align-middle" style="align-content: center;display: flex;align-items: center">
                @if($proyecto->fk_id_titular == $user->pk_id_usuario)
                    <div class="row align-items-center" >
                        <div class="col">
                            <label for="#" class="editar-seccion">Editar &nbsp;&nbsp;</label>
                        </div>
                    </div>
                    <div class="col">
                        <i class="fas fa-toggle-off fa-2x inactivo switch-edt"
                           id="sw_dp"
                           onclick="ActivarForm(this.id)"
                        ></i>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <form action="{{route('proyecto.actualizar')}}" id="sw_dp_fr" method="post">
                    {{ csrf_field()  }}
                    <div class="row">
                        <div class="col col-6">
                            <div class="row">
                                <div class="col col-9">
                                    <h4 class="">Detalles:</h4>

                                </div>

                                <hr style="margin-top: 0px;">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    {{-- --}}

                                    <input type="text" value="{{$proyecto->getId()}}" name="_id" hidden>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fechaInicio">Fecha de inicio probable:</label>
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>

                                                    </div>
                                                    <input  type="text"
                                                            name="fechaInicio"
                                                            readonly
                                                            required
                                                            class="form-control fechass edt"
                                                            {{$errors->any() ? '':'disabled'}}
                                                            value="{{$detalle->getFechaInicio()}}"
                                                    >

                                                    <div class="invalid-feedback">Debe especificar una fecha de inicio</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="fechaFin">Fecha probable de finalización:</label>
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>

                                                    </div>
                                                    <input type="text"
                                                           name="fechaFin"
                                                           readonly
                                                           required
                                                           class="form-control fechass {{$errors->has('fechaFin')? 'is-invalid':''}} edt"
                                                            {{$errors->any() ? '':'disabled'}}
                                                            value="{{$detalle->getFechaFin()}}"
                                                    >
                                                    <div class="invalid-feedback">Debe especificar una fecha de finalización.</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col col-6">
                                            <div class="form-group">
                                                <label for="monto">Monto apróximado del proyecto:</label>
                                                <div class="input-group">
                                                    <label for="monto"></label>
                                                    <div class="input-group-prepend ">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                    <input  type="number"
                                                            id="monto"
                                                            name="monto"
                                                            class="form-control edt"
                                                            disabled
                                                            required
                                                            value="{{$detalle->getMonto()}}"
                                                    >
                                                    <div class="invalid-feedback">Debe ser mayor a cero</div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-5" style="margin-left: 15px;">
                            <div class="row">
                                <div class="col col-9">
                                    <h4 class="">Personalización:</h4>
                                </div>

                                <hr style="margin-top: 0px;">

                            </div>
                            <div class="row">
                                <div class="form-row">
                                    <div class="col-12">
                                        <ol id="selectable"style="width: 100%;max-height: 300px;border: 1px solid lavenderblush;overflow: auto">
                                            @foreach($iconos as $icon)
                                                <li class="ui-widget-content text-center" id="{{$icon->rt_icono}}" >
                                                    <i class="{{$icon->rt_icono}} fa-2x"
                                                       id="{{$icon->pk_codigo_icono}}"
                                                    ></i>
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">

                                    <div class="col-12">
                                        <label for="color">Seleccione color</label>
                                        <select name="colorIcon"
                                                id="colorIcon"
                                                class="form-control edt"
                                                disabled
                                        >
                                            <option value="" name="gris-rc">Color no especificado</option>
                                            @foreach($colores as $color)
                                                <option value="{{$color->pk_id_color}}" name="{{$color->rt_valor}}">
                                                    {{$color->rt_nombre}}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <br><br>
                                                <div class="text-center" style="width: 125px;padding-top: 15px;height: 125px;border: 1px solid rgb(210,210,210);">
                                                    <i class="" name="" id="iconDestini"></i>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-row">
                                    <input type="text" name="idInconoTxt" id="idInconoTxt" hidden value="" >
                                    <div class="col-1">
                                        <i class="fas fa-info-circle" style="color: orangered;">
                                        </i>
                                    </div>
                                    <div class="col-11">
                                        <p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>