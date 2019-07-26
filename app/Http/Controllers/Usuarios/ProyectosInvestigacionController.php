<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\ProyectoInvestigacion\CrearRequest;
use App\Http\Requests\ProyectoInvestigacion\ActualizarDatosGeneralesRequest;
use Illuminate\Http\Request;
use App\Models\AreasConocimiento;
use App\Models\DetalleProyectoInvestigacion;
use App\Models\EstadoProyectoInvestigacion;
use App\Models\Icono;
use App\Models\Color;
use App\Models\Notificacion;
use App\Models\ObjetivoSocioeconomico;
use App\Models\Pais;
use App\Models\ProyectosInvestigacion;
use App\Models\RedInvestigadores;
use App\Models\TiposProyectosInvestigacion;
use App\Models\Foro;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class ProyectosInvestigacionController extends Controller
{
    public function obtenerProyectos(){
        $user=Auth::user();
        $datos=[];
        $i=0;

        $proyectos=DB::table('tbl_usuarios_proyectos')
                        ->where('fk_id_participante','=',$user->pk_id_usuario)
                        ->get();



        if(count($proyectos) > 0)
        {

            foreach ($proyectos as $prj)
            {

                $datos[$i]=ProyectosInvestigacion::find($prj->fk_id_proyecto_investigacion);
                $detalle=DetalleProyectoInvestigacion::where('fk_codigo_proyecto','=',$prj->fk_id_proyecto_investigacion)->first();


                $obj1=Icono::find($detalle->fk_codigo_icono);
                $obj2=Color::find($detalle->fk_codigo_color);

                $datos[$i]['icono']=$obj1->rt_icono;

                $datos[$i]['color']=$obj2->rt_valor;
                $i=$i+1;
            }

        }
        return view('Usuarios.ProyectosInvestigacion.gestionProyectosInvestigacion')

            ->with('prjs',$datos)
            ->with('user',$user);

    }

    public function registrarForm()
    {
        $user=Auth::user();
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();


        return view('Usuarios.ProyectosInvestigacion.RegistrarProyectoInvestigacion')
            ->with('user',$user)
            ->with('paises',Pais::where('rl_estado','=',true)->get())
            ->with('colores',Color::all())
            ->with('objetivosS',ObjetivoSocioeconomico::all())
            ->with('tiposProyectos',TiposProyectosInvestigacion::all())
            ->with('areas',$areas)
            ->with('iconos',Icono::all())
            ->with('estados',EstadoProyectoInvestigacion::all());
    }

    public function registrar(CrearRequest $request)
    {
        $user=Auth::user();

        //Comprobamos que no se ingrese un proyecto con el mismo nombre para un mismo usuario...........................
        $count=DB::table('tbl_proyectos_investigacion')
            ->where('rt_titulo_proyecto','=',$request->get('nombre'))
            ->where('fk_id_titular','=',$user->pk_id_usuario)
            ->count();

        if($count != 0){
            return back()->withErrors(['nombre'=>'Ya participas en un proyecto de inevstigacion con ese nombre']);
        }



        DB::beginTransaction();
        try{
            /*
            |-------------------------------------------------------------------------------------
            |          Realizamos la insersion del proyecto de investigacion. . .
            |-------------------------------------------------------------------------------------
            */

            $prj=new ProyectosInvestigacion;

            if($request->has('codigo')){                        //Se verifica el codigo del proyecto...

                $prj->pk_id_proyecto_investigacion=$request->get('codigo');
            }else{
                $prj->pk_id_proyecto_investigacion=str_random(10);
            }

            $prj->rt_titulo_proyecto=$request->get('nombre');
            $prj->rt_acronimo_proyecto=$request->get('acronimo');
            $prj->rd_descripcion_proyecto=$request->get('desc');
            $prj->rl_is_aprovado=false;

            $prj->fk_id_titular=$user->pk_id_usuario;
            $prj->fk_id_estado=$request->get('estadoP');
            $prj->fk_id_tipo_proyecto=$request->get('tipoP');
            $prj->fk_codigo_objetivo_socioeconomico=$request->get('Obj');

            if ( $request->has('area-c')){

                $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

                if ($bandera != 0){
                    $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                    $prj->fk_id_area=$ac->pk_id_area;
                }else{
                    $oa=new AreasConocimiento;
                    $oa->fk_codigo_icono=1;
                    $oa->rt_nombre_area=$request->get('area-c');
                    $oa->save();

                    $prj->fk_id_area=$oa->pk_id_area;
                }

            }else{
                $prj->fk_id_area=$request->get('area');
            }
            $prj->save();
            /*----------------------------------------------------------------------------------------------------------
             * Insertamos el detalle del proyecto de investigacion recien registrado;
             * ---------------------------------------------------------------------------------------------------------
             */

            $dt=new DetalleProyectoInvestigacion;
            $dt->pk_codigo_detalle=str_random(12);
            $dt->fk_codigo_proyecto=$prj->pk_id_proyecto_investigacion;

            $dt->rf_fecha_inicio=$request->get('ff');
            $dt->rf_fecha_fin=$request->get('ff');
            $dt->rn_monto=$request->get('monto');


            if(!$request->has('idInconoTxt')){
                $dt->fk_codigo_icono=2;
            }else{
                $dt->fk_codigo_icono=$request->get('idInconoTxt');
            }

            if(!$request->has('colorIcon')){
                $dt->fk_codigo_color=1;
            }else{
                $dt->fk_codigo_color=$request->get('colorIcon');
            }

            $dt->save();
            /*----------------------------------------------------------------------------------------------------------
             * Insertamos el proyecto en la tabla proyectos<==>Usuarios
             *----------------------------------------------------------------------------------------------------------
             */
            DB::table('tbl_usuarios_proyectos')->insert([
                [
                    'fk_id_participante'=>$user->pk_id_usuario,
                    'fk_id_proyecto_investigacion'=>$prj->pk_id_proyecto_investigacion,
                    'rl_is_riues'=>false
                ]

            ]);


            /*----------------------------------------------------------------------------------------------------------
             * Insertamos la red de investigadores para el proyecto.
             * ---------------------------------------------------------------------------------------------------------
             */


            $ri=new RedInvestigadores;

            $ri->pk_id_red=str_random(10);

            $ri->rt_nombre_red=$request->get('red');
            $ri->fk_id_proyecto_investigacion=$prj->pk_id_proyecto_investigacion;


            if ($request->get('tipoRed') == 1){
                $ri->rl_is_diciplinaria=false;
            }else{
                $ri->rl_is_diciplinaria=true;
            }

            if(!$request->has('idInconoTxt')){
                $ri->fk_codigo_icono=2;
            }else{
                $ri->fk_codigo_icono=$request->get('idInconoTxt');
            }

            if(!$request->has('colorIcon')){
                $ri->fk_id_color=1;
            }else{
                $ri->fk_id_color=$request->get('colorIcon');
            }

            $ri->save();






            /*----------------------------------------------------------------------------------------------------------
             *  Creamos una notificacion para el usuario administrador.
             *----------------------------------------------------------------------------------------------------------
             */

            $ntf=new Notificacion;

            $ntf->pk_id_notificacion=str_random(12);
            $ntf->fk_id_usuario='@riues';
            $ntf->rl_vista=false;
            $ntf->rt_tipo_notificacion="RNP";//Registro Nuevo Proyecto
            $ntf->rf_fecha_creacion=Carbon::now();
            $ntf->fk_id_usuario_remitente=$user->pk_id_usuario;

            $ntf->save();

            /*----------------------------------------------------------------------------------------------------------
             *  Creamos el foro que pertenece a cada red de investigadores.
             *----------------------------------------------------------------------------------------------------------
             */
            $foro=new Foro();
            $cod=str_random(12);
            $foro->pk_id_foro=$cod;
            $foro->fk_id_red=$ri->pk_id_red;
            $foro->fk_id_participante=$user->pk_id_usuario;
            $foro->fk_id_proyecto=$prj->pk_id_proyecto_investigacion;
            $foro->id_foro=$cod;
            $foro->save();




            DB::commit();
            $exito=true;

        }catch(\Exception $e){
            $error = $e->getMessage();
            DB::rollback();
            $exito=false;

        }
        if($exito){
            return redirect()->route('misproyectos.investigacion')
                ->withsuccess('Se registrado co exito el nuevo proyecto de investigacion');
        }

        return redirect()->route('misproyectos.investigacion')
            ->withdanger($error);



    }

    public function detalleProyecto($id)
    {
        $colaboradores=[];
        $i=0;
        $user=Auth::user();

        $proyecto=ProyectosInvestigacion::find($id);
        $detalle=DetalleProyectoInvestigacion::where('fk_codigo_proyecto','=',$id)->first();
        $valorIcono=Icono::getValorIcono($detalle->fk_codigo_icono);
        $valorColor=Color::getValorColor($detalle->fk_codigo_color);
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $area=$proyecto->getArea();
        $estadoProyecto=$proyecto->getEstado();
        $titular=$proyecto->getTitular();


        $colaboradores=DB::table('tbl_usuarios_proyectos')->where('fk_id_proyecto_investigacion','=',$id)
            ->get();



        /*Recuperamos la lista de colaboradores del proyecto de ivestigacion sin importar si es duenio o no*/
        foreach ($colaboradores as $col){
            $colaboradores[$i]=User::find($col->fk_id_participante);
            $i=$i+1;
        }

        return view('Usuarios.ProyectosInvestigacion.AdministrarProyectoInvestigacion')
            ->with('iconos',Icono::all())
            ->with('icono',$detalle->getIcono())
            ->with('colores',Color::all())
            ->with('color',$detalle->getColor())
            ->with('user',$user)
            ->with('titular',$titular)
            ->with('valorIcono',$valorIcono)
            ->with('valorColor',$valorColor)
            ->with('areas',$areas)
            ->with('area',$area)
            ->with('estadoProyecto',$estadoProyecto)
            ->with('tiposProyectos',TiposProyectosInvestigacion::all())
            ->with('estadosProyectos',EstadoProyectoInvestigacion::all())
            ->with('idTipoProyecto',$proyecto->fk_id_tipo_proyecto)
            ->with('participantes',$colaboradores)
            ->with('detalle',$detalle)
            ->with('objetivo',$proyecto->getObjetivo())
            ->with('objetivosProyectos',ObjetivoSocioeconomico::all())
            ->with('proyecto',$proyecto);
    }

    public function ActualizarDatosGenerales(ActualizarDatosGeneralesRequest $request){
        $user=Auth::user();
        if(!$request->has('_id')){
            return redirect()->route('dashboard')->withInfo('Error al accesar recurso.');
        }
        $proyecto=ProyectosInvestigacion::findOrFail($request->get('_id'));

        if($user->getId() != $proyecto->getTitular()->getId()){
            return redirect()->route('dashboard')->withInfo('No eres el duenio del proyecto que intentas modificar');
        }
        $proyecto->setTitulo($request->get('titulo'));
        $proyecto->setAcronimo($request->get('acronimo'));
        $proyecto->setId($request->get('codigo'));
        $proyecto->setDecripcion($request->get('descripcion'));
        $proyecto->setEstado($request->get('estado_proyecto'));
        $proyecto->setTipo($request->get('tipo_proyecto'));
        $proyecto->setArea($request->get('area'));
        $proyecto->setObjetivo($request->get('objetivo_proyecto'));

        $proyecto->save();

        return redirect()
            ->action('Usuarios\ProyectosInvestigacionController@detalleProyecto',['id'=>$proyecto->getId()])
            ->withsuccess('El registro se ha actualizado exitosamente');
    }

    public function ActualizarDetalle(Request $request){


        $detalle=DetalleProyectoInvestigacion::where('fk_codigo_proyecto','=',$request->get('_id'))->first();

        $detalle->setFechaFin($request->get('fechaFin'));
        $detalle->setFechaInicio($request->get('fechaInicio'));
        $detalle->setMonto($request->get('monto'));

        if($request->has('idInconoTxt')){
            $detalle->setIcono($request->get('idInconoTxt'));
        }
        if($request->has('colorIcon')){
            $detalle->setColor($request->get('colorIcon'));
        }

        $idP=$detalle->fk_id_proyecto;

        $detalle->save();

        return redirect()->action('Usuarios\ProyectosInvestigacionController@detalleProyecto',['id'=>$idP])->withsuccess("El detalle del proyecto se ha actualizado con exito");

    }

    public function BusquedaProyectos(Request $request){

        $proyectos=[];
        $i=0;
        $user=Auth::user();
        $bsq=-1;

        if($request->has('tipo_proyecto')){
            $bsq=$request->get('tipo_proyecto');
        }



        if($bsq != -1){
            $proyectos=DB::table('tbl_proyectos_investigacion')
                ->join('tbl_usuarios_proyectos','tbl_usuarios_proyectos.fk_id_proyecto_investigacion','=','tbl_proyectos_investigacion.pk_id_proyecto_investigacion')
                ->join('tbl_detalle_proyectos_investigacion','tbl_detalle_proyectos_investigacion.fk_codigo_proyecto','=','tbl_proyectos_investigacion.pk_id_proyecto_investigacion')
                ->join('tbl_iconos','tbl_iconos.pk_codigo_icono','=','tbl_detalle_proyectos_investigacion.fk_codigo_icono')
                ->join('tbl_colores','tbl_colores.pk_id_color','=','tbl_detalle_proyectos_investigacion.fk_codigo_color')
                ->where('tbl_proyectos_investigacion.fk_id_tipo_proyecto','=',$bsq)
                ->where('tbl_usuarios_proyectos.fk_id_participante','<>',$user->getId())
                ->paginate(8);
        }else{
            $proyectos=DB::table('tbl_proyectos_investigacion')
                ->join('tbl_usuarios_proyectos','tbl_usuarios_proyectos.fk_id_proyecto_investigacion','=','tbl_proyectos_investigacion.pk_id_proyecto_investigacion')
                ->join('tbl_detalle_proyectos_investigacion','tbl_detalle_proyectos_investigacion.fk_codigo_proyecto','=','tbl_proyectos_investigacion.pk_id_proyecto_investigacion')
                ->join('tbl_iconos','tbl_iconos.pk_codigo_icono','=','tbl_detalle_proyectos_investigacion.fk_codigo_icono')
                ->join('tbl_colores','tbl_colores.pk_id_color','=','tbl_detalle_proyectos_investigacion.fk_codigo_color')
                ->where('tbl_usuarios_proyectos.fk_id_participante','<>',$user->getId())
                ->paginate(8);
        }


        return view('Usuarios.ProyectosInvestigacion.Busqueda')
            ->with('user',$user)
            ->with('bsq',$bsq)
            ->with('proyectos',$proyectos)
            ->with('tiposProyectos',TiposProyectosInvestigacion::all());
    }

    public function VerDetalleProyecto($id){
        $user=Auth::user();
        $proyecto=ProyectosInvestigacion::find($id);
        $colaboradores=[];
        $i=0;

        $cols=DB::table('tbl_usuarios_proyectos')->where('fk_id_proyecto_investigacion','=',$id)
            ->get();

        /*Recuperamos la lista de colaboradores del proyecto de ivestigacion sin importar si es duenio o no*/
        foreach ($cols as $col){
            $colaboradores[$i]=User::find($col->fk_id_participante);
            $i=$i+1;
        }

        return view('Usuarios.ProyectosInvestigacion.Detalle')
            ->with('user',$user)
            ->with('proyecto',$proyecto)
            ->with('colaboradores',$colaboradores);

    }
}
