<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editarUsuarioRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'viejoPassword'=>'required|string',
            'password'=>'required|string|max:50|min:6',
        ];
    }

    public function messages()
    {

        return [

            'viejoPassword.required'=>'Debe introducir tu contrasenia actual',
            'password.required'=>'El campo es obligatorio',
            'password.max'=>'Tu contrasenia es demasiado larga',
            'password.min'=>'La contrasenia debe tener almenos 6 caracteres',
            'error-02'=>'formulario incorrecto',

        ];
    }
}
