<?php

namespace App\Http\Controllers\Usuarios;
use App\Http\Controllers\Controller;

use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\LibrosPublicaciones;
use App\Models\Pais;
use App\Models\ProyectoRealizado;
use App\Models\Publicacion;

use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvestigadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getInvestigador($id)
    {
        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();
        $perfil = DB::table('tbl_usuarios')
            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
            ->select('tbl_personas.rt_nombre_persona',
                        'tbl_personas.*',
                        'tbl_usuarios.rt_foto_usuario',
                        'tbl_usuarios.email',
                        'tbl_usuarios.pk_id_usuario')
            ->where('tbl_usuarios.pk_id_usuario','=',$id)
            ->first();
        $edad=Carbon::parse($perfil->rf_fecha_nacimiento)->age;

        /*
         *      Se obtienen los registros de los proyectos que ha realizado el Investigador
         */

        $proyectos=null;
        $countA=ProyectoRealizado::where('fk_id_usuario',$id)->count();

        if($countA>0)
        {
            $proyectos=ProyectoRealizado::where('fk_id_usuario',$id)->get();

            foreach ($proyectos as $proyecto){
                $fi=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_inicio_proyecto);
                $fi=$fi->format('d-m-Y');
                $proyecto->rf_fecha_inicio_proyecto=$fi;

                $ff=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_fin_proyecto);
                $ff=$ff->format('d-m-Y');
                $proyecto->rf_fecha_fin_proyecto=$ff;
            }



        }

        /*
         |     Publicaciones normales
         */
        $publicaciones=null;
        $countB=Publicacion::where('fk_id_usuario',$id)->count();

        if($countB > 0)
        {
            $publicaciones=Publicacion::where('fk_id_usuario',$id)->get();
            foreach ($publicaciones as $pub){
                $ff=Carbon::createFromFormat('Y-m-d',$pub->rf_fecha_publicacion);
                $ff=$ff->format('d-m-Y');

                $pub->rf_fecha_publicacion=$ff;
            }

        }

        $libros=null;
        $countC=LibrosPublicaciones::where('fk_id_usuario',$id)->count();

        if($countC>0){
            $libros=LibrosPublicaciones::where('fk_id_usuario',$id)->get();

            foreach ($libros as $lib){

                $ff=Carbon::createFromFormat('Y-m-d',$lib->rf_fecha);
                $ff=$ff->format('d-m-Y');

                $lib->rf_fecha=$ff;
            }
        }


        return view('Usuarios.DetallePerfil')->with('edad',$edad)
                    ->with('perfil',$perfil)
                    ->with('user',Auth::user())
                    ->with('paises',$paises)
                    ->with('areas',$areas)
                    ->with('grados',$grados)
                    ->with('proyectos',$proyectos)
                    ->with('countA',$countA)
                    ->with('countC',$countC)
                    ->with('libros',$libros)
                    ->with('publicaciones',$publicaciones)
                    ->with('countB',$countB);
    }

    public function getRegistrosInvestigadores(Request $request)
    {
        $user=Auth::user();
        $bsq=null;
        $Invs=[];
        $opt=100;
        $areas=AreasConocimiento::all();
        $ida=DB::table('tbl_areas_conocimiento')->max('pk_id_area');

        if($request->has('opt')){
            $opt=$request->get('opt');
        }

        switch ($opt){
            case 100:
                    if($request->has('busqueda')){
                        $nombre=$request->get('busqueda');
                        $join = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->where('tbl_usuarios.fk_id_estado','=',1)
                            ->where('tbl_personas.rl_tipo_area','=',false)
                            ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                            ->where('tbl_usuarios.fk_id_rol','<>',0)
                            ->get();
                    }else{

                        $join = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->where('tbl_usuarios.fk_id_estado','=',1)
                            ->where('tbl_personas.rl_tipo_area','=',false)
                            ->where('tbl_usuarios.fk_id_rol','<>',0)
                            ->get();
                    }
                break;
            case $ida;
                if($request->has('busqueda')){
                    $nombre=$request->get('busqueda');
                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_personas.rl_tipo_area','=',true)
                        ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }else{

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_personas.rl_tipo_area','=',true)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }
                break;
            default:
                if($request->has('busqueda')){
                    $nombre=$request->get('busqueda');

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_persona.rn_id_area','=',$opt)
                        ->where('tbl_personas.rl_tipo_area','=',false)
                        ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }else{

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_personas.rn_id_area','=',$opt)
                        ->where('tbl_personas.rl_tipo_area','=',false)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }
        }


        $i=0;
        foreach ($join as $js)
        {
            //..Atributos necesarios para mostrar datos en la vista ...............
            $Invs[$i]['nombre']=$js->rt_nombre_persona;
            $Invs[$i]['apellido']=$js->rt_apellido_persona;
            $Invs[$i]['foto']=$js->rt_foto_usuario;
            $Invs[$i]['email']=$js->email;
            $Invs[$i]['sexo']=$js->rl_sexo_persona;
            $Invs[$i]['id']=$js->pk_id_usuario;
            $Invs[$i]['estado']=$js->fk_id_estado;


            //Valores tratados del investigador

            $pub=Publicacion::where('fk_id_usuario','=',$js->pk_id_usuario)->count();
            $lib=LibrosPublicaciones::where('fk_id_usuario','=',$js->pk_id_usuario)->count();

            $Invs[$i]['npu']=$pub+$lib;
            $Invs[$i]['npr']=ProyectoRealizado::where('fk_id_usuario','=',$js->pk_id_usuario)->count();

            $i++;
        }



        return view('Usuarios.PerfilesInvestigadores')->with('user',$user)
            ->with('invs',$Invs)
            ->with('fkId',$opt)
            ->with('areas',$areas);

    }

    public function getDataAjax(Request $request)
    {

        if ($request->ajax()){
            $registros=$request->get('opcion');

            return \Response::json($registros);

        }else{
            return redirect('/dashboard');
        }
    }

    /*
     *      Funciones  privadas del controlador:
     */

}
