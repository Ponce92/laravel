<?php

namespace App\Http\Requests\Publicaciones;

use Illuminate\Foundation\Http\FormRequest;

class CrearPublicacionRequest extends FormRequest
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
            'titulo'=>'string',
            'fecha'=>'required',
            'issn'=>'string|required_if:tipo,"libro" |max:25|min:3',
            'nc'=>'numeric|required_if:tipo,"libro"',
            'np'=>'numeric|required_if:tipo,"libro"',
            'area-c'=>'required_if:area,"Otra area del concimiento"',
            'descripcion'=>'string|min:8|max:100',
            'enlace'=>'required_unless:tipo,"libro"|active_url',

        ];
    }

    public function messages()
    {
        return [
            'titulo.string'=>'Este campo es obligatorio',
            'titulo.max'=>'Este campo no puede contener mas de 50 caraceteres',
            'titulo.min'=>'Este campo debe tener almenos 6 caracteres',
            'fecha.required'=>'Debes especificar una fecha para la publicacion',
            'issn.numeric'=>'El formato no es el correcto',
            'issn.max'=>'El codigo ingresado debe contener como maximo 25 caraceteres',
            'issn.min'=>'El codigo ingresado no es correcto',
            'nc.required_if'=>'Debes espeficicar el numero de capitulo',
            'np.required_if'=>'Debes especificar un numero de pagina',
            'area-c'=>'Debes especificar un area de conocinineto',
            'enlace.required_with'=>'Debes proporcionar un url valido',
            'enlace.active_url'=>'El link proporcionado es incorrecto',

        ];
    }
}
