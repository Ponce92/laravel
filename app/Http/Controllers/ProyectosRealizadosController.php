<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRealizado\CrearProyectoRealizadoRequest;
use App\Http\Requests\ProyectoRealizado\EliminarProyectoRealizadoRequest;
use App\Http\Requests\ProyectoRealizado\ActualizarProyectoRealizadoRequest;
use App\Models\AreasConocimiento;
use App\Models\ProyectoRealizado;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProyectosRealizadosController extends Controller
{
    public function verProyectos()
    {
        $areas=AreasConocimiento::all();
        $id=Auth::id();
        $count=ProyectoRealizado::where('fk_id_usuario',$id)->count();

        if($count>0)
        {
            $proyectos=ProyectoRealizado::where('fk_id_usuario',$id)->get();

            return view('gestionProyectosRealizados')->with('proyectos',$proyectos)
                                                            ->with('areas',$areas);
        }else{

            return view('gestionProyectosRealizados')->with('areas',$areas);
        }

    }

    public function agregarProyecto(CrearProyectoRealizadoRequest $request)
    {
        $user=Auth::user();

        $nombre=$request->get('nombreArea-crt');
        $fi=$request->get('fechaInicio');
        $ff=$request->get('fechaFin');
        $id_area=$request->get('area');
        $desc=$request->get('descripcion');


        $proyecto= new ProyectoRealizado;

        $proyecto->rt_titulo_proyecto=$nombre;
        $proyecto->rf_fecha_inicio_proyecto=$fi;
        $proyecto->rf_fecha_fin_proyecto=$ff;
        $proyecto->fk_id_area=$id_area;
        $proyecto->rd_descripcion_proyecto=$desc;
        $proyecto->fk_id_usuario=$user->pk_id_usuario;

        $proyecto->save();

        $proyectos=ProyectoRealizado::where('fk_id_usuario',$user->pk_id_usuario)->get();
        $areas=AreasConocimiento::all();
        $msj="El registro ha sido almacenado correctamente";


        return view('gestionProyectosRealizados')  ->with('proyectos',$proyectos)
                                                        ->with('areas',$areas)
                                                        ->with('status',$msj);

    }

    public function eliminarProyecto(Request $request)
    {
        $id=$request->get('idd');

        $count=ProyectoRealizado::where('pk_id_proyecto',$id)->count();
        if($count >0){

            $user=Auth::user();

            $proyecto=ProyectoRealizado::find($id);
            $proyecto->delete();

            $proyectos=ProyectoRealizado::where('fk_id_usuario',$user->pk_id_usuario)->get();
            $areas=AreasConocimiento::all();
            $msj="El registro a sido eliminado correctamente.";


            return view('gestionProyectosRealizados')  ->with('proyectos',$proyectos)
                ->with('areas',$areas)
                ->with('status',$msj);
        }else{
            $user=Auth::user();
            $proyectos=ProyectoRealizado::where('fk_id_usuario',$user->pk_id_usuario)->get();
            $areas=AreasConocimiento::all();


            return view('gestionProyectosRealizados')  ->with('proyectos',$proyectos)
                ->with('areas',$areas)
                ->withErrors(['id'=>'El recurso que hacia referencia este codigo ya no existe.']);
        }

    }

    public function editarProyecto(Request $request)
    {
        $user=Auth::user();
        $id=$request->get('id');

        $nombre=$request->get('nombre-edt');
        $fi=$request->get('fechaInicio-edt');
        $ff=$request->get('fechafin-edt');
        $desc=$request->get('txtArea-edt');


        $proyecto=ProyectoRealizado::find($id);

        $proyecto->rt_titulo_proyecto=$nombre;
        $proyecto->rf_fecha_inicio_proyecto=$fi;
        $proyecto->rf_fecha_fin_proyecto=$ff;
        $proyecto->rd_descripcion_proyecto=$desc;

        $proyecto->save();

        $proyectos=ProyectoRealizado::where('fk_id_usuario',$user->pk_id_usuario)->get();
        $areas=AreasConocimiento::all();
        $msj="El registro del proyecto se ha actualizado correctamente";


        return view('gestionProyectosRealizados')  ->with('proyectos',$proyectos)
                                                        ->with('areas',$areas)
                                                        ->with('status',$msj);
    }
    /*=================================================================================================================
     *  | Funciones ajax para de control de proyectos realizados..
     * ===============================================================================================================
     */
    public function getProyectosAjax(Request $request){
        if ($request->ajax()){
            $id=$request->get('id');

            $var=DB::table('tbl_proyectos_realizados')
                        ->join('tbl_areas_conocimiento','tbl_proyectos_realizados.fk_id_area','=','tbl_areas_conocimiento.pk_id_area')
                        ->select('tbl_proyectos_realizados.*','tbl_areas_conocimiento.rt_nombre_area')
                        ->where('tbl_proyectos_realizados.pk_id_proyecto','=',$id)
                        ->get();
            return \Response::json($var);

        }else{
            return redirect('/dashboard');
        }
    }
}
