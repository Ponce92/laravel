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

            'nombre'=>' alpha | required ',
            'apellido'=>' alpha | required ',
            'foto'=>' image | required ',
            'fecha'=> 'date_format:"Y-m-d"|required',
            'hora'=>'digits_between:1,24',
            'telefono'=> 'digits:8 |required',
            'correo' =>'email | required',
            //'password' => 'required | min:6 | regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/^ | confirmed',
            //'password' => 'confirmed|min:6 | required',
            //'password'=>'required|string|max:50|min:6',
        ];
    }
}
