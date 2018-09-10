<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use Illuminate\Support\Facades\Storage;


use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Models\Persona;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


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
        $persona=Persona::find($user->fk_id_persona);

        if($request->hasFile('foto'))
        {

            $eliminar=$user->rt_foto_usuario;

            Storage::delete(public_path().'/avatar/'.$eliminar);

            $file = $request->file('foto');
            $name=time().str_random(4).$file->getClientOriginalName();

            $file->move(public_path().'/avatar/',$name);

            $user->rt_foto_usuario=$name;
            $user->save();

        }

        $persona->rt_nombre_persona=$request->get('nombres');
        $persona->rt_apellido_persona=$request->get('apellidos');
        $persona->rf_fecha_nacimiento=$request->get('fecha');
        $persona->fk_id_pais=$request->get('pais');

        $persona->rn_telefono_persona=$request->get('telefono');
        $persona->fk_id_grado=$request->get('grado');
        $persona->fk_id_area=$request->get('area');
        $persona->rn_horas_dedicadas_investigacion=$request->get('horas');

        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');

        $persona->save();


        $persona=Persona::find($user->fk_id_persona);
        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();

        $mensaje='Sus datos han sido actualizados correctamente.';

        return view('gestionDatosPersonales')->with('user',$user)
            ->with('persona',$persona)
            ->with('paises',$paises)
            ->with('areas',$areas)
            ->with('grados',$grados)
            ->with('status',$mensaje);
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
