<?php

namespace App\Http\Controllers;

use App\Http\Requests\editarUsuarioRequest;
use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Models\Persona;
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
        $persona=Persona::find($user->id_persona);

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
        $persona=Persona::find($user->id_persona);

        $persona->nombre_persona=$request->input('nombres');
        $persona->apellido_persona=$request->input('apellidos');
        $persona->fecha_nacimiento=$request->get('fechaN');

        $persona->telefono_persona=$request->get('telefono');
        $persona->id_grado=$request->get('grado');
        $persona->id_area=$request->get('area');
        $persona->horas_dedicadas_investigacion=$request->input('horas_investigacion');

        $persona->institucion=$request->input('institucion');
        $persona->direccion=$request->input('direccion');

        $persona->save();

        $persona=Persona::find($user->id_persona);
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
        $persona=Persona::find($user->id_persona);

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

    /*------------------------------------------------------------------------------------------------------------------
     |  Funcionalidad Gestion de proyectos realizados del investigador.................................
     *------------------------------------------------------------------------------------------------------------------
    */

    public function verProyectosRealizados(){
        return view('gestionProyectosRealizados');
    }
    public function agregarProyectoRealizado(){}

    public function actualizarProyectoRealizados(){}

    public function eliminarProyectoRealizados(){

    }
    /*
     |  Funcionalidad de Gestion de publicaciones del investigador
     |  Autor: Azael Ponce
     */

    public function verPublicaciones()
    {
        return view('gestionPublicaciones');
    }
    public function agregarPublicacion(){}
    public function actualizarPublicacion(){}

    public function eliminarPublicacion(){}

}
