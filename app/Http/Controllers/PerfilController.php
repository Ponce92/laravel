<?php

namespace App\Http\Controllers;

use App\Http\Requests\editarUsuarioRequest;
use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Models\Persona;
use App\Models\ProyectoRealizado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PerfilController extends Controller
{
    /*
    |   Funcionalidad de Gestion de datos personales del investigador
    |   Desarrollado por: Azael Ponce................................
     */
    public function verDatosPersonales(Request $request)
    {
        $user=Auth::user();
        $persona=Persona::find($user->fk_id_persona);

        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();

        return view('gestionDatosPersonales')->with('user',$user)
                                                    ->with('persona',$persona)
                                                    ->with('paises',$paises)
                                                    ->with('areas',$areas)
                                                    ->with('grados',$grados);
    }


    public function  editarDatosPersonales(Request $request)
    {
        $user=Auth::user();
        $persona=Persona::find($user->pk_id_persona);

        $persona->rt_nombre_persona=$request->input('nombres');
        $persona->rt_apellido_persona=$request->input('apellidos');
        $persona->rffecha_nacimiento=$request->get('fechaN');

        $persona->rn_telefono_persona=$request->get('telefono');
        $persona->fk_id_grado=$request->get('grado');
        $persona->fk_id_area=$request->get('area');
        $persona->fk_horas_dedicadas_investigacion=$request->input('horas_investigacion');

        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');

        $persona->save();

        $persona=Persona::find($user->pk_id_persona);
        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();

        $mensaje='exito';

        return view('gestionDatosPersonales')->with('user',$user)
            ->with('persona',$persona)
            ->with('paises',$paises)
            ->with('areas',$areas)
            ->with('grados',$grados)
            ->with('mensaje',$mensaje);
    }
    /*------------------------------------------------------------------------------------------------------------------
     *  | Funcionalidad de edicion de usuarios del sistema..............................................................
     * -----------------------------------------------------------------------------------------------------------------
     */
    public function editarUsuario(Request $request){

        return $request->all();

        $frmU='Credenciales incorrectas';
        $user=Auth::user();
        $persona=Persona::find($user->pk_id_persona);

        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();

        return view('gestionDatosPersonales')->with('user',$user)
            ->with('persona',$persona)
            ->with('paises',$paises)
            ->with('areas',$areas)
            ->with('grados',$grados)
            ->with('frmU',$frmU);

    }


}
