<?php

namespace App\Http\Controllers;

use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Models\Persona;
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

    }

    /*
     |  Funcionalidad Gestion de proyectos realizados del investigador.................................
     |  Autor: Azael Ponce
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
