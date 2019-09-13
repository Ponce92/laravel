<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\Redes\ActualizarRequest;
use App\Models\Icono;
use App\Models\Color;
use App\Models\ProyectosInvestigacion;
use App\Models\RedInvestigadores;
use App\Models\TiposProyectosInvestigacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use function PhpParser\filesInDir;

class RedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){
        $user=Auth::user();
        $redes=[];
        $i=0;

        $prj=DB::table('tbl_usuarios_proyectos')
            ->where('fk_id_participante','=',$user->pk_id_usuario)
            ->get();
        /*
         *  Por cada proyecto en el que participa el investigador se recupera la red asociada a dicho proyecto
         *  De investigacion.
         */
        if(count($prj)!=0)
        {
            foreach ($prj as $p){
                $pro=ProyectosInvestigacion::find($p->fk_id_proyecto_investigacion);
                $redes[$i]=RedInvestigadores::where('fk_id_proyecto_investigacion','=',$p->fk_id_proyecto_investigacion)
                    ->first();
                $redes[$i]['icono']=Icono::getValorIcono($redes[$i]->fk_codigo_icono);
                $redes[$i]['color']=Color::getValorColor($redes[$i]->fk_id_color);
                $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
                $redes[$i]['codigoProyecto']=$pro->pk_id_proyecto_investigacion;
                $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
                $i=$i+1;
            }
        }


        return view('Usuarios.Redes.GestionRedes')
            ->with('user',$user)
            ->with('redes',$redes);
    }

    public function obtenerDetalleRed($id){
        $user=Auth::user();
        $red=RedInvestigadores::find($id);
        $prj=ProyectosInvestigacion::find($red->fk_id_proyecto_investigacion);


        return view('Usuarios.Redes.DetalleRed')
            ->with('user',$user)
            ->with('iconos',Icono::all())
            ->with('colores',Color::all())
            ->with('red',$red)
            ->with('valorColor',Color::getValorColor($red->fk_id_color))
            ->with('codigoColor',$red->fk_id_color)
            ->with('valorIcono',Icono::getValorIcono($red->fk_codigo_icono))
            ->with('proyecto',$prj);
    }

    public function actualizarRed(ActualizarRequest $request)
    {
        $red=RedInvestigadores::findOrFail($request->get('id'));

        $red->rt_nombre_red=$request->get('titulo');
        $red->rl_is_diciplinaria=$request->get('diciplina');

        $ico=Icono::where('rt_icono','=',$request->get('idInconoTxt'))->first();

        $red->fk_codigo_icono=$ico->pk_codigo_icono;
        $red->fk_id_color=$request->get('colorIcon');
        $red->save();
        return redirect()
            ->route('redes.todas')
            ->withSuccess('El registro de la red de investigador se ha actualizado correctamente');
    }

    public function detalleRed($id){
        $user=Auth::user();
        $red=RedInvestigadores::find($id);
        $prj=ProyectosInvestigacion::find($red->fk_id_proyecto_investigacion);


        return view('Usuarios.Redes.DetalleRedBusqueda')
            ->with('user',$user)
            ->with('iconos',Icono::all())
            ->with('colores',Color::all())
            ->with('red',$red)
            ->with('valorColor',Color::getValorColor($red->fk_id_color))
            ->with('codigoColor',$red->fk_id_color)
            ->with('valorIcono',Icono::getValorIcono($red->fk_codigo_icono))
            ->with('proyecto',$prj);
    }

    public function busquedaRedes(Request $request){
        $user=Auth::user();
        $redes=[];
        $i=0;

        $idTipoProyecto=0;


        if($request->has('tipo_proyecto')){
            $idTipoProyecto=$request->get('tipo_proyecto');
        }


//        $prj=DB::table('tbl_usuarios_proyectos')
//            ->where('fk_id_participante','<>',$user->pk_id_usuario)
//            ->get();

//        if(count($prj)!=0)
//        {
//            foreach ($prj as $p){
//
//                $pro=ProyectosInvestigacion::find($p->fk_id_proyecto_investigacion);
//
//                if($idTipoProyecto !=0){
//
//                    if($pro->fk_id_tipo_proyecto ==$idTipoProyecto ){
//                        $redes[$i]=RedInvestigadores::where('fk_id_proyecto_investigacion','=',$p->fk_id_proyecto_investigacion)
//                            ->first();
//                        $redes[$i]['icono']=Icono::getValorIcono($redes[$i]->fk_codigo_icono);
//                        $redes[$i]['color']=Color::getValorColor($redes[$i]->fk_id_color);
//                        $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
//                        $redes[$i]['codigoProyecto']=$pro->pk_id_proyecto_investigacion;
//                        $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
//
//                    }
//
//                }else{
//                    $redes[$i]=RedInvestigadores::where('fk_id_proyecto_investigacion','=',$p->fk_id_proyecto_investigacion)
//                        ->first();
//                    $redes[$i]['icono']=Icono::getValorIcono($redes[$i]->fk_codigo_icono);
//                    $redes[$i]['color']=Color::getValorColor($redes[$i]->fk_id_color);
//                    $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
//                    $redes[$i]['codigoProyecto']=$pro->pk_id_proyecto_investigacion;
//                    $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
//                }
//
//                $i=$i+1;
//            }
//        }
        if($idTipoProyecto!=0){
            $redes=DB::table('tbl_redes_investigadores')
                ->join('tbl_usuarios_proyectos','tbl_usuarios_proyectos.fk_id_proyecto_investigacion','=','tbl_redes_investigadores.fk_id_proyecto_investigacion')
                ->join('tbl_proyectos_investigacion','tbl_proyectos_investigacion.pk_id_proyecto_investigacion','=','tbl_redes_investigadores.fk_id_proyecto_investigacion')
                ->join('tbl_iconos','tbl_iconos.pk_codigo_icono','=','tbl_redes_investigadores.fk_codigo_icono')
                ->join('tbl_colores','tbl_colores.pk_id_color','=','tbl_redes_investigadores.fk_id_color')
                ->where('tbl_proyectos_investigacion.fk_id_tipo_proyecto','=',$idTipoProyecto)
                ->where('tbl_usuarios_proyectos.fk_id_participante','<>',$user->getId())
                ->paginate(8);
             
        }else{
            $redes=DB::table('tbl_redes_investigadores')
                ->join('tbl_usuarios_proyectos','tbl_usuarios_proyectos.fk_id_proyecto_investigacion','=','tbl_redes_investigadores.fk_id_proyecto_investigacion')
                ->join('tbl_proyectos_investigacion','tbl_proyectos_investigacion.pk_id_proyecto_investigacion','=','tbl_redes_investigadores.fk_id_proyecto_investigacion')
                ->join('tbl_iconos','tbl_iconos.pk_codigo_icono','=','tbl_redes_investigadores.fk_codigo_icono')
                ->join('tbl_colores','tbl_colores.pk_id_color','=','tbl_redes_investigadores.fk_id_color')
                ->where('tbl_usuarios_proyectos.fk_id_participante','<>',$user->getId())
                ->paginate(8);
        }


        return view('Usuarios.Redes.BusquedaRedes')
            ->with('user',$user)
            ->with('bsq',$idTipoProyecto)
            ->with('tiposProyectos',TiposProyectosInvestigacion::all())
            ->with('redes',$redes);
    }
}
