<label for="Grado">Grado Academico :</label>
<select name="grado" id="grado"  class="custom-select">
    <option value="000">-- Grado Academico --</option>
    @foreach($GradosAcademicos as $grado)
        <option value="{{$grado->id_grado}}">{{$grado->nombre_grado}}</option>
    @endforeach
</select>