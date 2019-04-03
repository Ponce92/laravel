<!-- ----------------------------------------------------------------------------------------------
 |  Input de tipo seleccion de estados del proyectos de investigacion . . .
 |----------------------------------------------------------------------------------------------
 |  Deben existir dos parametros en la vista para utilizarse :
-->

    <label for="estado_proyecto">Estado del proyecto</label>
    <select name="estado_proyecto"
            id="estado_proyecto"
            class="form-control mb-3 edt"
            {{$errors->any() ? '':'disabled'}}
    >
        <option value="" disabled>Estado del proyecto</option>
        @foreach($estadosProyectos as $tipo)
            <option value="{{$tipo->getId()}}"
                    {{$estadoProyecto->getId() == $tipo->getId() ? 'selected':''}}
            @if($errors->any())
                {{old('estado_proyecto')==$tipo->getId() ? 'selected':''}}
                    @else
                {{$estadoProyecto->getId() == $tipo->getId() ? 'selected':''}}
                    @endif
            >
                {{$tipo->getEstado()}}
            </option>
        @endforeach
    </select>
