<!-- ----------------------------------------------------------------------------------------------
 |  Input de tipo seleccion de tipos de proyectos de investigacion . . .
 |----------------------------------------------------------------------------------------------
 |  Deben existir dos parametros en la vista para utilizarse :
 |  $tiposPoroyecto: Representa el valor de la coleccion de tipos de proyectos de investigacion
 |  $idTipoProyecto: Representa el valor del id seleccionado(en caso de existir)
-->

<label for="tipo_proyecto">Objetivo socioeconómico del proyecto:</label>
<select name="objetivo_proyecto"
        id="objetivo_proyecto"
        class="form-control mb-3 edt {{$errors->has('objetivo_proyecto') ? 'is-invalid':''}}"
        {{$errors->any() ? '':'disabled'}}
>
    <option value="" disabled>Estado del proyecto</option>
    @foreach($objetivosProyectos as $tipo )
        <option value="{{$tipo->getId()}}"
                {{$objetivo->getId() ==$tipo->getId() ? 'selected':''}}
        @if($errors->any())
            {{old('objetivo_proyecto')==$tipo->getId() ? 'selected':''}}
        @else
            {{$objetivo->getId()==$tipo->getId() ? 'selected':''}}
        @endif
        >
            {{$tipo->getDescripcion()}}
        </option>
    @endforeach
</select>