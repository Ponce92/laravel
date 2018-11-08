<select name="tipo_proyecto"
        id="tipo_proyecto"
        class="form-control input-lg"
        >
    <option value="0">Selecione tipo de proyecto</option>
    @foreach($tiposProyectos as $tipo)
        <option value="{{$tipo->pk_id_tipo_proyecto}}">
            {{$tipo->rd_descripcion}}
        </option>
    @endforeach
</select>