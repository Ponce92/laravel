<?php

namespace App\Http\Controllers;


use DB;

use App\Models\Publicacion;
use App\Models\AreasConocimiento;

use App\Http\Requests\Publicaciones\CrearPublicacionRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function verPublicaciones(Request $request)
    {
        $user=Auth::user();
        $id=Auth::id();
        $count=Publicacion::where('fk_id_usuario',$id)->count();
        $areas=AreasConocimiento::all();

        if($count>0)
        {
            $publicaciones=Publicacion::where('fk_id_usuario',$id)->get();

            return view('gestionPublicaciones')->with('publicaciones',$publicaciones)
                                                    ->with('areas',$areas)
                                                    ->with('user',$user);
        }else{

            return view('gestionPublicaciones')->with('areas',$areas)
                                                    ->with('user',$user);
        }
    }

    public function crearPublicacion(CrearPublicacionRequest $request)
    {
        $user=Auth::user();

        $titulo=$request->get('titulo');
        $tipo=$request->get('tipo');
        $area=$request->get('area');
        $fecha=$request->get('fecha');
        $desc=$request->get('descripcion');
        $url=$request->get('enlace');

        $obj=new Publicacion();


        $obj->fk_id_usuario=$user->pk_id_usuario;
        $obj->rt_titulo_publicacion=$titulo;
        $obj->rf_fecha_publicacion=$fecha;
        $obj->rd_descripcion_publicacion=$desc;
        $obj->rt_tipo_publicacion=$tipo;
        $obj->fk_id_area=$area;
        $obj->rt_enlace_publicacion=$url;

        $obj->save();
        $areas=AreasConocimiento::all();

        $publicaciones=Publicacion::where('fk_id_usuario',$user->pk_id_usuario)->get();



        return view('gestionPublicaciones')->with('publicaciones',$publicaciones)
            ->with('areas',$areas)
            ->with('status','El registro de su publicacion se almacenado correctamente')
            ->with('user',$user);
    }

    public function actualizarPublicacion(Request $request)
    {

        $user=Auth::user();
        $id=$request->get('id_pu');

        $titulo=$request->get('titulo-edt');
        $tipo=$request->get('tipo-edt');
        $area=$request->get('area-edt');
        $fecha=$request->get('fecha-edt');
        $desc=$request->get('descripcion-edt');
        $url=$request->get('enlace-edt');

        $obj=Publicacion::find($id);

        $obj->rt_titulo_publicacion=$titulo;
        $obj->rf_fecha_publicacion=$fecha;
        $obj->rd_descripcion_publicacion=$desc;
        $obj->rt_tipo_publicacion=$tipo;
        $obj->fk_id_area=$area;
        $obj->rt_enlace_publicacion=$url;

        $obj->save();

        $publicaciones=Publicacion::where('fk_id_usuario',$user->pk_id_usuario)->get();
        $areas=AreasConocimiento::all();

        $msj="El registro de la publicacion se ha actualizado correctamente";


        return view('gestionPublicaciones')  ->with('publicaciones',$publicaciones)
            ->with('areas',$areas)
            ->with('status',$msj)
            ->with('user',$user);
    }

    public function eliminarPublicacion(Request $request)
    {
        $id=$request->get('id_obj');
        $user=Auth::user();

        $count=Publicacion::where('pk_id_publicacion',$id)->count();
        if($count >0){

            $model=Publicacion::find($id);
            $model->delete();

            $publicaciones=Publicacion::where('fk_id_usuario',$user->pk_id_usuario)->get();
            $areas=AreasConocimiento::all();
            $msj="La publicacion se ha eliminado correctamente.";


            return view('gestionPublicaciones')  ->with('publicaciones',$publicaciones)
                ->with('areas',$areas)
                ->with('status',$msj)
                ->with('user',$user);
        }else{

            $publicaciones=Publicacion::where('fk_id_usuario',$user->pk_id_usuario)->get();
            $areas=AreasConocimiento::all();


            return view('gestionPublicaciones')  ->with('user',$user)
                ->with('publicaciones',$publicaciones)
                ->with('areas',$areas)
                ->withErrors(['id'=>'El recurso que hacia referencia este codigo ya no existe.']);
        }
    }

//    ================================================================
    public function getPublicacionAjax(Request $request){
        if ($request->ajax()){
            $id=$request->get('id');

            $var=DB::table('tbl_publicaciones')
                ->join('tbl_areas_conocimiento','tbl_publicaciones.fk_id_area','=','tbl_areas_conocimiento.pk_id_area')
                ->select('tbl_publicaciones.*','tbl_areas_conocimiento.rt_nombre_area')
                ->where('tbl_publicaciones.pk_id_publicacion','=',$id)
                ->get();
            return \Response::json($var);

        }else{
            return redirect('/dashboard');
        }
    }
}
