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
            'area-c'=>'string|required_if:area,"Otra area del concimiento"',
            'descripcion'=>'string|min:4|max:250'

        ];
    }

    public function messages()
    {
        return [
            'titulo.min'=>'El titulo debe tener mas de 4 caracteres',
            'titulo.max'=>'El titulo es demasiado largo',
            'codigo.string'=>'El codigo no puede ir vacio',
            'acronimo.max'=>'El acronimo es demasiado largo',
            'acronimo.string'=>'Debes especificar un acronimo del proyecto',
            'area-c.required'=>'Especifica un valor para el area del conocimiento',
            'descripcion.string'=>'Especifica una descripcion del proyecto',
            'descripcion.max'=>'Longitud de la descripcion excede el maximo de caracteres'
        ];
    }
}
