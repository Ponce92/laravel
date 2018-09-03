<label for="pais">Pais :</label>
<select name="pais" id="pais"  class="custom-select">
    <option value="000">-- Seleccione Pais --</option>
    @foreach($paises as $pais)
        <option value="{{$pais->id_pais}}">{{$pais->nombre_pais}}</option>
    @endforeach
</select>
