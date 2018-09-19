<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        //Se manipula la fecha de nacimiento para que se muestra correctamente..........|
        $fecha=Carbon::createFromFormat('Y-m-d',$persona->rf_fecha_nacimiento);
        $fecha=$fecha->format('d-m-Y');
        $persona->rf_fecha_nacimiento=$fecha;

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

        $fecha=$request->get('fecha');

        $fecha=Carbon::createFromFormat('d-m-Y',$fecha);
        $fecha=$fecha->format('Y-m-d');
        $persona->rf_fecha_nacimiento=$fecha;

        $persona->fk_id_pais=$request->get('pais');

        $persona->fk_id_grado=$request->get('grado');

        $ar=AreasConocimiento::find($request->get('area'));
        $persona->rt_nombre_area=$ar->rt_nombre_area;


        $persona->rn_horas_dedicadas_investigacion=$request->get('horas');

        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');

        $persona->save();

        //Actualizacion de correo de usuario
        $user->email=$request->get('correo');
        $user->save();

        $persona=Persona::find($user->fk_id_persona);
        $fecha=Carbon::createFromFormat('Y-m-d',$persona->rf_fecha_nacimiento);
        $fecha=$fecha->format('d-m-Y');
        $persona->rf_fecha_nacimiento=$fecha;

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
