<?php

namespace App\Http\Requests\Pais;

use Illuminate\Foundation\Http\FormRequest;

class CrearPaisRequest extends FormRequest
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
            'codigo'=>'required|integer|min:1|max:100|unique:tbl_paises,pk_id_pais',
            'nombre'=>'required|string|unique:tbl_paises,rt_nombre_pais'
        ];
    }

}
