<?php

namespace App\Http\Requests\DatosPersonales;

use Illuminate\Foundation\Http\FormRequest;

class EditarDatosPersonalesRequest extends FormRequest
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
            'nombres'=>'required|string|max:50',
            'apellidos'=>'required|string|max:50',
            'fecha'=>'required|date',
            'direccion'=>'required|min:15|max:200',

        ];
    }

    public function messages()
    {
        return[
            'nombres.required'=>'Este campo es requerido',
            'nombres.string'=>'Formato del campo es invalido',
            'nombres.max'=>'Limite de caracteres excedido',
            'apellidos.required'=>'Este campo es obligatorio',
            'apellidos.string'=>'El formato de caracteres no es correcto',
            'apellidos.max'=>'Limite de caracteres excedido',
            'fecha.required'=>'Debes especificar una fecha.',
            'direccion.required'=>'Este campo es obligatorio',
            'direccion.min'=>'una direccion valida tiene mas de 15 caracteres',
            'direccion.max'=>'Una direccion valida tiene menos de 200 caracteres'


        ];
    }
}
