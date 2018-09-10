<?php

namespace App\Http\Controllers\Administrador;

use DB;

use App\Models\Usuario;
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
        $persona=Persona::find($user->fk_id_persona);
        $bsq=null;

        if ($request->has('opcion'))
        {

            $opcion=$request->get('opcion');
            switch ($request->get('opcion'))
            {
                case 'solicitudes':

                    if($request->has('busqueda')){
                        $bsq=$request->get('busqueda');

                        $count=DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Nuevo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Nuevo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->get();

                    } else{
                        $count= DB::table('tbl_usuarios')->where('rt_estado','Nuevo')->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Nuevo')
                            ->get();

                    }
                    break;

                case 'activacion':

                    if($request->has('busqueda'))
                    {
                        $bsq=$request->get('busqueda');

                        $count=DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Pendiente')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Pendiente')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->get();

                    }else{

                    $count= DB::table('tbl_usuarios')->where('rt_estado','Pendiente')->count();

                    $registros = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->select('tbl_personas.rt_nombre_persona',
                            'tbl_personas.rt_apellido_persona',
                            'tbl_usuarios.rt_foto_usuario',
                            'tbl_usuarios.pk_id_usuario',
                            'tbl_usuarios.rt_estado',
                            'tbl_usuarios.email')
                        ->where('tbl_usuarios.rt_estado','=','Pendiente')
                        ->get();
                        }
                    break;
                case 'inactivos':
                    if($request->has('busqueda'))
                    {
                        $bsq=$request->get('busqueda');

                        $count=DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Inactivo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Inactivo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->get();

                    }else{
                        $count= DB::table('tbl_usuarios')->where('rt_estado','Inactivo')->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Inactivo')
                            ->get();

                    }


                    break;
                case 'activos':
                    if ($request->has('busqueda'))
                    {
                        $bsq=$request->get('busqueda');

                        $count=DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Activo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Activo')
                            ->where('tbl_personas.rt_nombre_persona','=',$bsq )
                            ->get();
                    } else{
                        $count= DB::table('tbl_usuarios')->where('rt_estado','Activo')->count();

                        $registros = DB::table('tbl_usuarios')
                            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                            ->select('tbl_personas.rt_nombre_persona',
                                'tbl_personas.rt_apellido_persona',
                                'tbl_usuarios.rt_foto_usuario',
                                'tbl_usuarios.pk_id_usuario',
                                'tbl_usuarios.rt_estado',
                                'tbl_usuarios.email')
                            ->where('tbl_usuarios.rt_estado','=','Activo')
                            ->get();
                    }

                    break;

            }

        }else{
            $opcion='solicitudes';
            $count= DB::table('tbl_usuarios')->where('rt_estado','Nuevo')->count();

            $registros = DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.rt_apellido_persona',
                    'tbl_usuarios.rt_estado',
                    'tbl_usuarios.rt_foto_usuario',
                    'tbl_usuarios.pk_id_usuario',
                    'tbl_usuarios.email')
                ->where('tbl_usuarios.rt_estado','=','Nuevo')
                ->get();

        }


        return view('RootAdmin.GestionRegistrosInvestigadores')->with('user',$user)
                                                                    ->with('count1',$count)
                                                                    ->with('nuevos',$registros)
                                                                    ->with('opt',$opcion)
                                                                    ->with('bsq',$bsq);
    }


    /*      Funcion   que recibe un id de usuario mediante ajax y recupera los datos de dicho usuario
     *      Retorna un join de la tabla usuario y persona junto con en numero de publicaciones y numero de proyectos
     */

    public function getDataAjax(Request $request)
    {

        if ($request->ajax()){
            $id=$request->get('opcion');

            switch ($request->get('opcion'))
            {
                case 'solicitudes':
                    $registros = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->select('tbl_personas.rt_nombre_persona')
                        ->where('tbl_usuarios.rt_estado','=','Nuevo')
                        ->get();
                    break;

                case 'activacion':

                    $registros = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->select('tbl_personas.rt_nombre_persona')
                        ->where('tbl_usuarios.rt_estado','=','Pendiente')
                        ->get();
                    break;
                case 'inactivos':
                    $registros = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->select('tbl_personas.rt_nombre_persona')
                        ->where('tbl_usuarios.rt_estado','=','Inactivo')
                        ->get();
                    break;
                case 'activos':
                    $registros = DB::table('tbl_usuarios')
                        ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                        ->select('tbl_personas.rt_nombre_persona')
                        ->where('tbl_usuarios.rt_estado','=','Activo')
                        ->get();
                    break;

            }

            return \Response::json($registros);

        }else{
            return redirect('/dashboard');
        }
    }

}
