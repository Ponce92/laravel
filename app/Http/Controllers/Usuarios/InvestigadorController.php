<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Models\ProyectoRealizado;
use App\Models\Publicacion;
use Carbon\Carbon;
use DB;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvestigadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getInvestigador(Request $request)
    {
        $paises=Pais::all();
        $grados=GradosAcademicos::all();
        $areas=AreasConocimiento::all();
        $idUsuario=$request->get('verI');
        $perfil = DB::table('tbl_usuarios')
            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
            ->select('tbl_personas.rt_nombre_persona',
                        'tbl_personas.*',
                        'tbl_usuarios.rt_foto_usuario',
                        'tbl_usuarios.email',
                        'tbl_usuarios.pk_id_usuario')
            ->where('tbl_usuarios.pk_id_usuario','=',$idUsuario)
            ->first();
        $edad=Carbon::parse($perfil->rf_fecha_nacimiento)->age;

        /*
         *      Se obtienen los registros de los proyectos que ha realizado el Investigador
         */

        $proyectos=null;
        $count1=ProyectoRealizado::where('fk_id_usuario',$perfil->pk_id_usuario)->count();

        if($count1>0)
        {
            $proyectos=ProyectoRealizado::where('fk_id_usuario',$perfil->pk_id_usuario)->get();

        }
        /*
         *      Se obtienen los registros de las publicaciones que ha realizado el Investigador
         */
        $publicaciones=null;
        $count2=Publicacion::where('fk_id_usuario',$perfil->pk_id_usuario)->count();

        if($count1>0)
        {
            $publicaciones=Publicacion::where('fk_id_usuario',$perfil->pk_id_usuario)->get();

        }

        return view('Usuarios.DetallePerfil')->with('edad',$edad)
                    ->with('perfil',$perfil)
                    ->with('user',Auth::user())
                    ->with('paises',$paises)
                    ->with('areas',$areas)
                    ->with('grados',$grados)
                    ->with('proyectos',$proyectos)
                    ->with('count1',$count1)
                    ->with('publicaciones',$publicaciones)
                    ->with('count2',$count2);
    }

    public function getRegistrosInvestigadores(Request $request)
    {
        $user=Auth::user();
        $areas=AreasConocimiento::all();
        $registros=null;
        $count =0;
        $opt='todos';
        $bsq=null;
        $areas=AreasConocimiento::all();

        if($request->has('opcion')){// Se obtienen todos los datos si no se recibe el parametro select
            $opt=$request->get('opcion');

            if ($opt ==-1){//se obtiene todos los datos si el select es >>todos<<
                if ($request->has('busqueda')){//Busqueda en la selelcin de todos

                    $bsq=$request->get('busqueda');
                    $count=$this->Conteo(30,null,$bsq);

                    $registros=$this->filtrarRegistros(30,null,$bsq);
                }else{
                    //Si el request no trae el campo busqueda, se procede a sellecionar
                    /// todos los registros
                    $count= $this->Conteo(-1,null,null );
                    $registros = $this->obtenerTodosRegistros();
                }
            }else{
                if ($request->has('busqueda')){
                    //se fitran los datos si se revibe el parametro  de camop de busqueda
                    $bsq=$request->get('busqueda');

                    $count=$this->Conteo(20,$opt,$bsq);

                    $registros=$this->filtrarRegistros(20,$opt,$bsq);

                }else{
                    // Se filtran los datos si solo se recibe el campo >> Select <<

                    $count = $this->Conteo(10,$opt,null);

                    if ($count != 0){

                        $registros =$this->filtrarRegistros(-1,$opt,null);
                    }
                }

            }
        }else{
            $count=$this->Conteo(-1,null,null);
            $registros =$this->obtenerTodosRegistros();
        }



        return view('Usuarios.PerfilesInvestigadores')->with('user',$user)
            ->with('areas',$areas)
            ->with('registros',$registros)
            ->with('count',$count)
            ->with('opt',$opt)
            ->with('bsq',$bsq)
            ->with('areas',$areas);
    }

    public function getDataAjax(Request $request)
    {

        if ($request->ajax()){
            $id=$request->get('opcion');
            if ($id==-1){
                $registros = DB::table('tbl_usuarios')
                    ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                    ->select('tbl_personas.rt_nombre_persona')
                    ->where('tbl_usuarios.rt_estado','=','Activo')
                    ->orWhere('tbl_usuarios.rt_estado','=','Inactivo')
                    ->get();
            }else{
                $registros = DB::table('tbl_usuarios')
                    ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                    ->select('tbl_personas.rt_nombre_persona')
                    ->where('tbl_personas.fk_id_area','=',$id)
                    ->where('tbl_usuarios.rt_estado','=','Activo')
                    ->orWhere('tbl_usuarios.rt_estado','=','Inactivo')
                    ->get();
            }



            return \Response::json($registros);

        }else{
            return redirect('/dashboard');
        }
    }

    /*
     *      Funciones  privadas del controlador:
     */

    private function obtenerTodosRegistros(){
        $reg=null;

        $reg=DB::table('tbl_usuarios')
            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
            ->select('tbl_personas.rt_nombre_persona',
                'tbl_personas.rt_apellido_persona',
                'tbl_usuarios.rt_estado',
                'tbl_usuarios.rt_foto_usuario',
                'tbl_usuarios.pk_id_usuario',
                'tbl_usuarios.email',
                'tbl_personas.fk_id_area')
            ->where('tbl_usuarios.rt_estado','=','Activo')
            ->orWhere('tbl_usuarios.rt_estado','=','Inactivo')
            ->get();

        return $reg;
    }

    private function Conteo($bandera,$param,$nombre){
        $conteo=0;
        if($bandera==-1){
            $conteo=DB::table('tbl_usuarios')
                ->where('rt_estado','Inactivo')
                ->orWhere('rt_estado','Activo')
                ->count();
        }
        if($bandera==10){
            $conteo=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona')
                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.fk_id_area','=',$param)
                ->count();

        }
        if($bandera==20){
                $conteo=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona')
                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.fk_id_area','=',$param)
                ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                ->count();

        }
        if($bandera==30){
            $conteo=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona')
                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                ->count();

        }

        return $conteo;
    }

    private function  filtrarRegistros($band,$param,$nombre){
        $datos=null;

        if($band==-1){
            $datos=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.rt_apellido_persona',
                    'tbl_usuarios.rt_estado',
                    'tbl_usuarios.rt_foto_usuario',
                    'tbl_usuarios.pk_id_usuario',
                    'tbl_usuarios.email',
                    'tbl_personas.fk_id_area')

                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.fk_id_area','=',$param)
                ->get();
        }

        if($band==20){

            $datos=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.rt_apellido_persona',
                    'tbl_usuarios.rt_estado',
                    'tbl_usuarios.rt_foto_usuario',
                    'tbl_usuarios.pk_id_usuario',
                    'tbl_usuarios.email',
                    'tbl_personas.fk_id_area')

                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.fk_id_area','=',$param)
                ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                ->get();
        }
        if($band==30){
            $datos=DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.rt_apellido_persona',
                    'tbl_usuarios.rt_estado',
                    'tbl_usuarios.rt_foto_usuario',
                    'tbl_usuarios.pk_id_usuario',
                    'tbl_usuarios.email',
                    'tbl_personas.fk_id_area')

                ->whereIn('tbl_usuarios.rt_estado',['Activo','Inactivo'])
                ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                ->get();
        }
        return $datos;
    }
}
