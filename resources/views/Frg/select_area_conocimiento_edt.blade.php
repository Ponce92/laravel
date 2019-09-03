
<div class="col">
    <label class="" for="area">Área de Conocimiento:</label>
    <select id="area"
            name="area"
            onchange="verificarSelcArea(this)"
            class="form-control mb-3 edt"
            {{$errors->any() ? '':'disabled'}}
    >
        <option value="" disabled>Seleccione Área de conocimiento</option>
        @foreach($areas as $obj)
            <option value="{{$obj->pk_id_area}}"
            @if($errors->any())
                {{old('area') ==$obj->getId() ? 'selected':''}}
            @else
                @if($area->pk_id_area < 100)
                    {{$obj->pk_id_area ==$area->pk_id_area ? 'selected':''}}
                @else
                    {{$obj->rt_nombre_area == 'Otra área de conocimiento' ? 'selected':''}}
                @endif
            @endif

            >
                {{$obj->rt_nombre_area}}
            </option>
        @endforeach
    </select>
</div>
<div class="col">
    <label for="area-c">Especifique Área:</label>
    <input type="text"
           name="area-c"
           id="area-c"
           class="form-control mb-3 {{$errors->has('area-c') ? 'is-invalid':''}} edt"
           value="@if(!$errors->any()){{$area->pk_id_area >100 ? $area->rt_nombre_area:''}}@else{{old('area-c')}}@endif"
           disabled
    >
    <div class="invalid-feedback">{{$errors->first('area-c')}}</div>
</div>