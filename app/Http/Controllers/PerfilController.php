<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /*
    |   Funcionalidad de Gestion de datos personales del investigador
    |   Desarrollado por: Azael Ponce................................
     */
    public function verDatosPersonales()
    {
        return view('gestionDatosPersonales');
    }

    public function  editarDatosPersonales(){

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
