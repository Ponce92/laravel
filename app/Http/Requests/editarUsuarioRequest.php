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

            'viejoPassword.required'=>'Debe introducir su contraseña actual',
            'password.required'=>'El campo es obligatorio',
            'password.max'=>'Su contraseña es demasiado larga',
            'password.min'=>'La contraseña debe tener al menos 6 caracteres',
            'error-02'=>'Formulario incorrecto',

        ];
    }
}
