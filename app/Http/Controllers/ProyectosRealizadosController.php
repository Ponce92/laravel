<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRealizado\CrearProyectoRealizadoRequest;
use App\Http\Requests\ProyectoRealizado\editarProyectoRealizadoRequest;
use App\Models\AreasConocimiento;
use App\Models\Pais;
use App\Models\ProyectoRealizado;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProyectosRealizadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function verProyectos()
    {
        $user=Auth::user();
        $areas=AreasConocimiento::all();
        $paises=Pais::all();
        $id=Auth::id();
        $count=ProyectoRealizado::where('fk_id_usuario',$id)->count();

        if($count>0)
        {
            $proyectos=ProyectoRealizado::where('fk_id_usuario',$id)->get();

            foreach ($proyectos as $proyecto){
                $fi=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_inicio_proyecto);
                $fi=$fi->format('d-m-Y');
                $proyecto->rf_fecha_inicio_proyecto=$fi;

                $ff=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_fin_proyecto);
                $ff=$ff->format('d-m-Y');
                $proyecto->rf_fecha_fin_proyecto=$ff;

                $ar=AreasConocimiento::find($proyecto->fk_id_area);
                $proyecto['area']=$ar->rt_nombre_area;

            }

            return view('gestionProyectosRealizados')->with('proyectos',$proyectos)
                                                            ->with('areas',$areas)
                                                            ->with('user',$user)
                                                            ->with('paises',$paises);
        }else{

            return view('gestionProyectosRealizados')->with('areas',$areas)
                                                            ->with('user',$user)
                                                            ->with('paises',$paises);
        }

    }

    public function agregarProyectoForm(Request $request)
    {
        $user=Auth::user();
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $paises=Pais::where('rl_estado','=',true)->get();


        return view('Usuarios.ProyectosRealizados.CrearProyectoRealizado')
                                    ->with('user',$user)
                                    ->with('paises',$paises)
                                    ->with('areas',$areas);
    }

    public function agregarProyecto(CrearProyectoRealizadoRequest $request)
    {
        $user=Auth::user();
        $paises=Pais::all();

        $areas=AreasConocimiento::all();

        if (!$this->valFechas($request->get('fechaI'),$request->get('fechaF'))){
            return back()
                ->withInput()
                ->with('user',$user)
                ->with('areas',$areas)
                ->with('paises',$paises)
                ->withErrors(['fechaI'=>'La fecha de inicio no puede ser mayor a la fecha de finalizacion']);
        }
        $fi=Carbon::createFromFormat('d-m-Y',$request->get('fechaI'));
        $ff=Carbon::createFromFormat('d-m-Y',$request->get('fechaF'));


        $nombre=$request->get('nombre');
        $desc=$request->get('descripcion');


        $proyecto= new ProyectoRealizado;
        $pais=$request->get('pais');

        $proyecto->rt_titulo_proyecto=$nombre;
        $proyecto->rf_fecha_inicio_proyecto=$fi->format('Y-m-d');
        $proyecto->rf_fecha_fin_proyecto=$ff->format('Y-m-d');
        $proyecto->fk_id_pais=$pais;

        $proyecto->rd_descripcion_proyecto=$desc;
        $proyecto->fk_id_usuario=$user->pk_id_usuario;

        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $proyecto->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $proyecto->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $proyecto->fk_id_area=$request->get('area');
        }

        $proyecto->save();

        $proyectos=ProyectoRealizado::where('fk_id_usuario',$user->pk_id_usuario)->get();
        $areas=AreasConocimiento::all();
        $msj="El registro ha sido almacenado correctamente";


        return redirect()->route('gestionProyectosRealizados')->withsuccess('Se ha registrado correctamente el proyecto realizado');


    }

    public function editarProyectoForm($id){

        $proyecto=ProyectoRealizado::find($id);
        $fi=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_inicio_proyecto);
        $fi=$fi->format('d-m-Y');
        $proyecto->rf_fecha_inicio_proyecto=$fi;

        $ff=Carbon::createFromFormat('Y-m-d',$proyecto->rf_fecha_fin_proyecto);
        $ff=$ff->format('d-m-Y');
        $proyecto->rf_fecha_fin_proyecto=$ff;

        $ar=AreasConocimiento::find($proyecto->fk_id_area);
        $proyecto['area']=$ar->rt_nombre_area;
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $otrasA=AreasConocimiento::where('pk_id_area','>',100)->get();


        return view('Usuarios.ProyectosRealizados.EditarProyectoRealizado')
            ->with('user',Auth::user())
            ->with('proyecto',$proyecto)
            ->with('paises',Pais::where('rl_estado','=',true)->get())
            ->with('otrasA',$otrasA)
            ->with('areas',$areas)
            ->with('id',$id);


    }

    public function editarProyecto($id,editarProyectoRealizadoRequest $request)
    {
        $user=Auth::user();
        if (!$this->valFechas($request->get('fechaI'),$request->get('fechaF'))){
            return back()
                ->withInput()
                ->with('user',$user)
                ->with('areas',AreasConocimiento::all())
                ->with('paises',Pais::all())
                ->withErrors(['fechaI'=>'La fecha de inicio no puede ser mayor a la fecha de finalizacion']);
        }
        $fi=Carbon::createFromFormat('d-m-Y',$request->get('fechaI'));
        $ff=Carbon::createFromFormat('d-m-Y',$request->get('fechaF'));


        $nombre=$request->get('nombre');
        $desc=$request->get('descripcion');
        $pais=$request->get('pais');

        $proyecto=ProyectoRealizado::find($request->get('id'));


        $proyecto->rt_titulo_proyecto=$nombre;
        $proyecto->rf_fecha_inicio_proyecto=$fi->format('Y-m-d');
        $proyecto->rf_fecha_fin_proyecto=$ff->format('Y-m-d');
        $proyecto->fk_id_pais=$pais;
        $proyecto->rd_descripcion_proyecto=$desc;


        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $proyecto->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $proyecto->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $proyecto->fk_id_area=$request->get('area');
        }

        $proyecto->save();

        return redirect()->route('gestionProyectosRealizados')->withsuccess('El registro ha sido actualizado correctamente');

    }

    public function eliminarProyecto(Request $request)
    {
        $id=$request->get('idd');

        $count=ProyectoRealizado::where('pk_id_proyecto',$id)->count();
        if($count >0){

            $proyecto=ProyectoRealizado::find($id);
            $proyecto->delete();



            return redirect()->route('gestionProyectosRealizados')->withsuccess('El registro ha sido elimado correctamente');
        }else{



            return redirect()->route('gestionProyectosRealizados')->withinfo('El recurso que intentas elminar ya no existe');

        }

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


    private function valFechas($fechaI,$fechaF){
        $fechaI=Carbon::createFromFormat('d-m-Y',$fechaI);
        $fechaF=Carbon::createFromFormat('d-m-Y',$fechaF);

        if ($fechaI <$fechaF){
            return true;
        }else{
            return false;
        }

    }
}
