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
    
        $ar=AreasConocimiento::find($persona->fk_id_area);
        $persona['area']=$ar->rt_nombre_area;

        //Se manipula la fecha de nacimiento para que se muestra correctamente..........|
        $fecha=Carbon::createFromFormat('Y-m-d',$persona->rf_fecha_nacimiento);
        $fecha=$fecha->format('d-m-Y');
        $persona->rf_fecha_nacimiento=$fecha;

        $paises=Pais::where('rl_estado','=',true)->get();
        $grados=GradosAcademicos::where('rl_estado','=',true)->get();
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $otrasA=AreasConocimiento::where('pk_id_area','>',100)->get();

        return view('gestionDatosPersonales')->with('user',$user)
                                                    ->with('persona',$persona)
                                                    ->with('paises',$paises)
                                                    ->with('areas',$areas)
                                                    ->with('grados',$grados)
                                                    ->with('otrasA',$otrasA);
    }


    public function  editarDatosPersonales(Request $request)
    {
        $user=Auth::user();
        $persona=Persona::find($user->fk_id_persona);

        if($request->hasFile('foto'))
        {

            $eliminar=$user->rt_foto_usuario;

            Storage::disk('local')->delete('public/avatar/'.$eliminar);

            $file = $request->file('foto');
            $name=time().str_random(4).$file->getClientOriginalName();

            Storage::disk('local')->putFileAs(
                'public/avatar/',
                $file,
                $name
            );

//            $file->move(public_path().'/avatar/',$name);

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
        $persona->rl_sexo_persona=$request->get('sexo');
        $persona->rn_horas_dedicadas_investigacion=$request->get('horas');

        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');

        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $persona->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $persona->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $persona->fk_id_area=$request->get('area');
        }


        $persona->save();

        //Actualizacion de correo de usuario
        $user->email=$request->get('correo');
        $user->save();

        $persona=Persona::find($user->fk_id_persona);
        $fecha=Carbon::createFromFormat('Y-m-d',$persona->rf_fecha_nacimiento);
        $fecha=$fecha->format('d-m-Y');
        $persona->rf_fecha_nacimiento=$fecha;


        $mensaje='Sus datos han sido actualizados correctamente.';

        return redirect()->route('gestionDatosPersonales')->withsuccess('Sus datos han sido actualizados correctamente.');
    }
    /*------------------------------------------------------------------------------------------------------------------
     *  | Funcionalidad de edicion de usuarios del sistema..............................................................
     * -----------------------------------------------------------------------------------------------------------------
     */
//    public function editarUsuario(Request $request){
//
//
//        $frmU='Credenciales incorrectas';
//        $user=Auth::user();
//        $persona=Persona::find($user->pk_id_persona);
//
//        $paises=Pais::all();
//        $grados=GradosAcademicos::all();
//        $areas=AreasConocimiento::all();
//
//        return view('gestionDatosPersonales')->with('user',$user)
//            ->with('persona',$persona)
//            ->with('paises',$paises)
//            ->with('areas',$areas)
//            ->with('grados',$grados)
//            ->with('frmU',$frmU);
//
//    }


}
