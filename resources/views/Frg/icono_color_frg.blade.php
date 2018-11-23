

<div class="row">
    <div class="col-12">
        <ol id="selectable" style="width: 100%;max-height: 300px;border: 1px solid lavenderblush;overflow: auto">
            @foreach($iconos as $icon)
            <li class="ui-widget-content text-center"
                id="{{$icon->rt_icono}}"
                name="{{$icon->pk_codigo_icono}}"
            >
                <i class="{{$icon->rt_icono}} fa-2x"
                   id="{{$icon->pk_codigo_icono}}"
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
                        class="form-control edt {{$errors->has('colorIcon') ? 'is-invalid':''}}"
                        {{$errors->any() ? '':'disabled'}}
                >
                    <option value="0" name="gris-rc">Color no especificado</option>
                    @foreach($colores as $color)
                        <option value="{{$color->pk_id_color}}"
                            @if($errors->any())
                                {{old('colorIcon') == $color->pk_id_color ? 'selected':''}}
                            @else
                                {{$color->pk_id_color == $codigoColor ? '':'selected'}}
                            @endif
                                name="{{$color->rt_valor}}"
                        >
                            {{$color->rt_nombre}}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{$errors->first('colorIcon')}}</div>
            </div>
            <div class="col-4">
                <div class="row justify-content-center">
                    <div class="text-center" style="width: 125px;padding-top: 15px;height: 125px;border: 1px solid rgb(210,210,210);">
                        <input type="text" name="idInconoTxt" id="idInconoTxt" hidden value="{{$valorIcono}}" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
