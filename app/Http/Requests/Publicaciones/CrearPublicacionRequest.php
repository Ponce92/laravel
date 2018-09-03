<?php

namespace App\Http\Requests\Publicaciones;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'titulo'=>Rule::unique('tbl_publicaciones','rt_titulo_publicacion')
                ->where(function($query){
                    return $query->where('fk_id_usuario',$this->user()->pk_id_usuario);
                }),
            'fecha'=>'required|string'

        ];
    }

    public function messages()
    {
        return [
          'titulo.unique'=>'Ya tienes una publicacion registrada con ese nombre'
        ];
    }
}
