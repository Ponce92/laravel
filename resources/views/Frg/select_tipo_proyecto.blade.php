<!-- ----------------------------------------------------------------------------------------------
 |  Input de tipo seleccion de tipos de proyectos de investigacion . . .
 |----------------------------------------------------------------------------------------------
 |  Deben existir dos parametros en la vista para utilizarse :
 |  $tiposPoroyecto: Representa el valor de la coleccion de tipos de proyectos de investigacion
 |  $idTipoProyecto: Representa el valor del id seleccionado(en caso de existir)
-->


<label for="tipo_proyecto">Tipo de poryecto de investigacion</label>
<select name="tipo_proyecto"
        id="tipo_proyecto"
        class="form-control mb-3 edt {{$errors->has('tipo_proyecto') ? 'is-invalid':''}}"
        {{$errors->any() ? '':'disabled'}}
>
    <option value="0" {{$idTipoProyecto !=-1 ? 'disabled':''}}>Selecione tipo de proyecto</option>
    @foreach($tiposProyectos as $tipo)
        <option value="{{$tipo->pk_id_tipo_proyecto}}" {{$idTipoProyecto ==$tipo->pk_id_tipo_proyecto ? 'selected':''}}
                @if($errors->any())
                    {{old('tipo_proyecto')==$tipo->pk_id_tipo_proyecto ? 'selected':''}}
                @else
                    {{$idTipoProyecto==$tipo->pk_id_tipo_proyecto ? 'selected':''}}
                @endif
        >
            {{$tipo->rd_descripcion}}
        </option>
    @endforeach
</select>