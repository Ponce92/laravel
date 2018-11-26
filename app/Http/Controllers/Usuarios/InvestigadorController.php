<?php

namespace App\Http\Controllers\Usuarios;
use App\Http\Controllers\Controller;

use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\LibrosPublicaciones;
use App\Models\ProyectosInvestigacion;
use App\Models\Notificacion;
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
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
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

        /*------------------------------------------------------------------------------
         |  |   Recuperamos los proyectos el que observa es administrador
         |------------------------------------------------------------------------------
         */
        $user=Auth::user();
        $misProyecto=ProyectosInvestigacion::where('fk_id_titular','=',$user->getId())->get();


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

                $area=$proyecto->area();
                $proyecto['area']=$area->rt_nombre_area;


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

                $area=$pub->area();
                $pub['area']=$area->rt_nombre_area;
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

                $area=$lib->area();
                $lib['area']=$area->rt_nombre_area;

            }
        }


        return view('Usuarios.DetallePerfil')
                    ->with('edad',$edad)
                    ->with('misProyectos',$misProyecto)
                    ->with('perfil',$perfil)
                    ->with('user',$user)
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
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $ida=7;

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
                            ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                            ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                            ->where('tbl_usuarios.fk_id_rol','<>',0)
                            ->get();
                    }else{

                        $join = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->where('tbl_usuarios.fk_id_estado','=',1)
                            ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                            ->where('tbl_usuarios.fk_id_rol','<>',0)
                            ->get();
                    }
                break;
            case $ida;                                      //Otras areas del conocimiento.   .      .
                if($request->has('busqueda')){
                    $nombre=$request->get('busqueda');
                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_personas.fk_id_area','>',100)
                        ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                        ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }else{

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_personas.fk_id_area','>',100)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                        ->get();
                }
                break;
            default:
                if($request->has('busqueda')){
                    $nombre=$request->get('busqueda');

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_persona.fk_id_area','=',$opt)
                        ->where('tbl_personas.rt_nombre_persona','=',$nombre)
                        ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
                }else{

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',1)
                        ->where('tbl_usuarios.pk_id_usuario','<>',$user->pk_id_usuario)
                        ->where('tbl_personas.fk_id_area','=',$opt)
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

    public function SolicitarReactivacion(){
        $user=Auth::user();

        $user->fk_id_estado=4;

        $user ->save();

        $ntf =new Notificacion();
        $ntf->pk_id_notificacion=str_random(12);
        $ntf->fk_id_usuario='@riues';
        $ntf->rl_vista=false;
        $ntf->rt_tipo_notificacion='SRA';
        $fech=Carbon::now();
        $ntf->rf_fecha_creacion=$fech->format('Y-m-d');
        $ntf->fk_id_usuario_remitente=$user->pk_id_usuario;

        $ntf->save();

        return redirect('/dashboard')->withsuccess("Tu solicitud a sido enviada al administrador");
    }

}
