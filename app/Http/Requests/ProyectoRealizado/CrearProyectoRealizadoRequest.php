<?php

namespace App\Http\Requests\ProyectoRealizado;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CrearProyectoRealizadoRequest extends FormRequest
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
            'nombreArea-crt'=>Rule::unique('tbl_proyectos_realizados','rt_titulo_proyecto')
                                    ->where(function($query){
                                        return $query->where('fk_id_usuario',$this->user()->pk_id_usuario);
                                    }),
            'fechaInicio'=>'date|required',
            'fechaFin'=>'date|required',
            'area'=>'numeric|required',
            'descripcion'=>'required|string|min:6|max:150',


        ];
    }

    public  function messages()
    {
        return [
            'nombreArea-crt.unique'=>'Lo siento, tu ya tienes un proyecto con ese nombre.',
        ];
    }
}
