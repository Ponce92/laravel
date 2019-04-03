<?php

namespace App\Http\Requests\ProyectoRealizado;


use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class editarProyectoRealizadoRequest extends FormRequest{
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
            'nombre'=>['string',
                Rule::unique('tbl_proyectos_realizados','rt_titulo_proyecto')
                    ->ignore($this->request->get('id'),'pk_id_proyecto')
                    ->where(function($query){
                        return $query->where('fk_id_usuario',$this->user()->pk_id_usuario);
                    }),
            ],

            'fechaI'=>'date|required',
            'fechaF'=>'date|required',
            'area'=>'numeric|required',
            'area-c'=>'string|required_if:area,"Otra area del concimiento"',
            'descripcion'=>'required|string|min:6|max:150'


        ];
    }
    public function messages()
    {
        return [
            'nombre.unique'=>'Ya posees otro proyecto con el mismo nombre',
            'nombre.string'=>'El campo debe ser una cadena de caracteres y no puede sesta vacio',
            'area-c.string'=>'Este campo es obligatorio',

            'fechaI.required'=>'Debes especificar una fecha de inicio del proyecto',
            'fechaI.date'=>'El formato de fecha no es valido',
            'fechaF.required'=>'Debes especificar una fecha de inicio del proyecto',
            'fechaF.date'=>'El formato de fecha no es valido',
            'descripcion.string'=>'El campo es obligatorio'

        ];
    }
}
