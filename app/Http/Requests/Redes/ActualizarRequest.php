<?php

namespace App\Http\Requests\Redes;

use Illuminate\Foundation\Http\FormRequest;

class ActualizarRequest extends FormRequest
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
            'titulo'=>'string|min:3|max:100',
            'diciplina'=>'required',
            'colorIcon'=>'required',
            'idInconoTxt'=>'required'
        ];
    }
}
