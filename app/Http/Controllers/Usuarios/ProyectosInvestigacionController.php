<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\ProyectoInvestigacion\CrearRequest;
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

        if(count($proyectos)!=0)
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
            ->with('paises',Pais::all())
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
                    'fk_id_proyecto_investigacion'=>$prj->pk_id_proyecto_investigacion
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



        $colaboradores=DB::table('tbl_usuarios_proyectos')
            ->where('fk_id_proyecto_investigacion','=',$id)
            ->get();

        foreach ($colaboradores as $col){
            $colaboradores[$i]=User::find($col->fk_id_participante);
            $i=$i+1;
        }

        return view('Usuarios.ProyectosInvestigacion.AdministrarProyectoInvestigacion')
            ->with('user',$user)
            ->with('participantes',$colaboradores)
            ->with('detalle',$detalle)
            ->with('proyecto',$proyecto);
    }
}
