<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrosRequest extends FormRequest
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

            'nombre'=>'required|max:100|min:6 ',
            'apellido'=>'required|max:100|min:6 ',
            'foto'=>'required|mimes:png,jpg,jpeg',
            'fecha'=> 'date_format:"d-m-Y"|required',
            'horas'=>'digits_between:1,16|required',
            'correo' =>'required|email|required|unique:tbl_usuarios,email',
            'pais'=>'required',
            'area'=>'required',
            'sexo'=>'required',
            'grado'=>'required',
            'institucion'=>'required|min:6|max:150',
            'direccion'=>'required|min:8|max:150',
            'password'=>'required|confirmed'
        ];
    }
}
