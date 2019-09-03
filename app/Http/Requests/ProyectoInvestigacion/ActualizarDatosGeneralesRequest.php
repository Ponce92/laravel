<?php

namespace App\Http\Requests\ProyectoInvestigacion;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarDatosGeneralesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'titulo'=>'string|min:4|max:100',
            'codigo'=>'string',
            'acronimo'=>'string|max:50',
            'estado_proyecto'=>'required',
            'tipo_proyecto'=>'required',
            'area'=>'required',
            'area-c'=>'string|required_if:area,"Otra Área del conocimiento"',
            'descripcion'=>'string|min:4|max:250'

        ];
    }

    public function messages()
    {
        return [
            'titulo.min'=>'El titulo debe tener más de 4 caracteres',
            'titulo.max'=>'El titulo es demasiado largo',
            'codigo.string'=>'El código no puede estar vacío',
            'acronimo.max'=>'El acrónimo es demasiado largo',
            'acronimo.string'=>'Debes especificar un acrónimo del proyecto',
            'area-c.required'=>'Especifíca un valor para el Área del conocimiento',
            'descripcion.string'=>'Especifíca una descripción del proyecto',
            'descripcion.max'=>'Longitud de la descripción excede el máximo de caracteres'
        ];
    }
}
