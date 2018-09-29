<?php

namespace App\Http\Controllers\Administrador;

use App\Models\LibrosPublicaciones;
use App\Models\ProyectoRealizado;
use App\Models\Publicacion;
use Carbon\Carbon;
use DB;

use App\Models\Persona;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GestionInvestigadoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index(Request $request)
    {
        $user=Auth::user();
        $bsq=null;
        $fkId=2;
        $Invs=[];

        if ($request->has('opcion'))
        {
            $fkId=$request->get('opcion');

            if($request->has('busqueda')){
                $bsq=$request->get('busqueda');


                    $count=DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',$fkId)
                        ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->count();

                    $join = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->where('tbl_usuarios.fk_id_estado','=',$fkId)
                        ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                        ->where('tbl_usuarios.fk_id_rol','<>',0)
                        ->get();
            }else{
                $count=DB::table('tbl_usuarios')
                    ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                    ->where('tbl_usuarios.fk_id_estado','=',$fkId)
                    ->where('tbl_usuarios.fk_id_rol','<>',0)
                    ->count();

                $join = DB::table('tbl_usuarios')
                    ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                    ->where('tbl_usuarios.fk_id_estado','=',$fkId)
                    ->where('tbl_usuarios.fk_id_rol','<>',0)
                    ->get();

            }

        }else{
            $join = DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->where('tbl_usuarios.fk_id_estado','=',2)
                ->where('tbl_usuarios.fk_id_rol','<>',0)
                ->get();

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
            $edad=Carbon::createFromFormat('Y-m-d',$js->rf_fecha_nacimiento);
            $Invs[$i]['edad']=Carbon::parse($edad)->age;


            $pub=Publicacion::where('fk_id_usuario','=',$js->pk_id_usuario)->count();
            $lib=LibrosPublicaciones::where('fk_id_usuario','=',$js->pk_id_usuario)->count();

            $Invs[$i]['npu']=$pub+$lib;
            $Invs[$i]['npr']=ProyectoRealizado::where('fk_id_usuario','=',$js->pk_id_usuario)->count();

            $i++;
        }

        return view('RootAdmin.GestionRegistrosInvestigadores')
            ->with('opt',$fkId)
            ->with('user',Auth::user())
            ->with('invs',$Invs);

    }



    public function getDataAjax(Request $request)
    {

        if ($request->ajax()){
            $fkId=$request->get('txt');


            $join = DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona')
                ->where('tbl_usuarios.fk_id_estado','=',$fkId)
                ->where('tbl_usuarios.fk_id_rol','<>',0)
                ->get();


            return \Response::json($join);

        }else{
            return redirect('/dashboard');
        }
    }


}
