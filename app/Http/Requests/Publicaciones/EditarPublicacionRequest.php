<?php

namespace App\Http\Requests\Publicaciones;

use Illuminate\Foundation\Http\FormRequest;

class EditarPublicacionRequest extends FormRequest
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
            'id'=>'required',
            'titulo'=>'string',
            'fecha'=>'required',
            'issn'=>'string|required_if:tipo,"libro" ',
            'nc'=>'numeric|required_if:tipo,"libro"',
            'np'=>'numeric|required_if:tipo,"libro"',
            'area-c'=>'required_if:area,"Otra Área de conocimiento"',
            'descripcion'=>'string|min:8|max:100',
            'enlace'=>'required_unless:tipo,"libro"|active_url',

        ];
    }

    public function messages()
    {
        return [
            'id.required'=>'Regrese a la ventana anterior e inténtelo de nuevo',
            'titulo.string'=>'Este campo es obligatorio',
            'titulo.max'=>'Este campo no puede contener más de 50 caraceteres',
            'titulo.min'=>'Este campo debe tener al menos 6 caracteres',
            'fecha.required'=>'Debe especificar una fecha para la publicación',
            'issn.numeric'=>'El formato no es el correcto',
            'issn.max'=>'El código ingresado contiene demasiados caracteres',
            'issn.min'=>'El código ingresado no es correcto',
            'nc.required_if'=>'Debe espeficicar el número de capítulo',
            'np.required_if'=>'Debe especificar un número de página',
            'area-c'=>'Debe especificar un Área de conocimiento',
            'enlace.required_with'=>'Debe proporcionar una url válido',
            'enlace.active_url'=>'El link proporcionado es incorrecto',

        ];
    }
}
