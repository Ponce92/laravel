<?php

namespace App\Http\Requests\Objetivo;

use Illuminate\Foundation\Http\FormRequest;

class CrearObjetivoRequest extends FormRequest
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
            'descripcion'=>'required|string|min:3|unique:tbl_objetivos_socioeconomicos_proyectos,rd_descripcion_objetivo'
        ];
    }
}
