

<div class="row">
    <div class="col-12">
        <ol id="selectable" style="width: 100%;max-height: 300px;border: 1px solid lavenderblush;overflow: auto">
            @foreach($iconos as $icon)
                <li class="ui-widget-content text-center"
                    id="{{$icon->rt_icono}}"
                    name="{{$icon->getId()}}"
                >
                    <i class="{{$icon->rt_icono}} fa-2x"
                       id="{{$icon->getId()}}"
                    ></i>
                </li>
            @endforeach
        </ol>
        <br>
    </div>
    <br>
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <label for="color">Seleccione color</label>
                <select name="colorIcon"
                        id="colorIcon"
                        class="form-control edt"
                        disabled
                >
                    <option value="0" name="gris-rc" disabled>Color no especificado</option>
                    @foreach($colores as $col)
                        <option value="{{$col->getId()}}"
                                {{$col->getId() == $color->getId() ? 'selected':''}}
                          >
                            {{$col->rt_nombre}}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="col-4">
                <div class="row justify-content-center">
                    <div class="text-center" style="width: 125px;padding-top: 15px;height: 125px;border: 1px solid rgb(210,210,210);">
                        <input type="text"
                               name="idInconoTxt"
                               id="idInconoTxt"
                               hidden
                               value="{{$icono->getId()}}"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
