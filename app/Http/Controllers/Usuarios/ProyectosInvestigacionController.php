<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\ProyectoInvestigacion\CrearRequest;
use App\Models\AreasConocimiento;
use App\Models\DetalleProyectoInvestigacion;
use App\Models\EstadoProyectoInvestigacion;
use App\Models\Icono;
use App\Models\Notificacion;
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

                $bb=$datos[$i]->icono()->first();
                $datos[$i]['icono']=$bb->rt_icono;
                $i=$i+1;
            }

        }

        return view('Usuarios.ProyectosInvestigacion.gestionProyectosInvestigacion')
            ->with('prjs',$datos)
            ->with('user',$user);

    }

    public function detalleProyecto($id)
    {
        $colaboradores=[];
        $i=0;
        $user=Auth::user();
        $detalle=DetalleProyectoInvestigacion::where('fk_codigo_proyecto','=',$id)->first();

        $proyecto=ProyectosInvestigacion::find($id);

        $cols=DB::table('tbl_usuarios_proyectos')
            ->where('fk_id_proyecto_investigacion','=',$id)
            ->get();

        foreach ($cols as $col){
            $colaboradores[$i]=User::find($col->fk_id_participante);
                $i=$i+1;
        }

        return view('Usuarios.ProyectosInvestigacion.AdministrarProyectoInvestigacion')
            ->with('user',$user)
            ->with('participantes',$colaboradores)
            ->with('detalle',$detalle)
            ->with('proyecto',$proyecto);
    }

    public function registrarForm()
    {
        $user=Auth::user();



        return view('Usuarios.ProyectosInvestigacion.RegistrarProyectoInvestigacion')
            ->with('user',$user)
            ->with('paises',Pais::all())
            ->with('tiposProyectos',TiposProyectosInvestigacion::all())
            ->with('areas',AreasConocimiento::all())
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

        /*
         *  Se inicia la trasaccion para evitar que un registro quede insertado a medias................................
         */
        DB::beginTransaction();
        try{
            /*
             *  Datos generales del proyecto de investigacion ..........................................................
             */

            $prj=new ProyectosInvestigacion;

            //Verificamos si viene un codigo, en caso de no existir se genera string random de 12 letras;
            if($request->has('codigo')){

                $prj->pk_id_proyecto_investigacion=$request->get('codigo');
            }else{
                $prj->pk_id_proyecto_investigacion=str_random(12);
            }
            $prj->rt_titulo_proyecto=$request->get('nombre');
            $prj->rt_acronimo_proyecto=$request->get('acronimo');
            $prj->rd_descripcion_proyecto=$request->get('desc');
            $prj->rl_is_aprovado=false;

            $prj->fk_id_titular=$user->pk_id_usuario;
            $prj->fk_id_estado=$request->get('estadoP');
            $prj->fk_id_tipo_proyecto=$request->get('tipoP');
            $prj->fk_codigo_objetivo_socioeconomico=0;

            if(!$request->has('idInconoTxt')){
                $prj->fk_codigo_icono=0;
            }else{
                $prj->fk_codigo_icono=$request->get('idInconoTxt');
            }


            //Insersion del area del conocimiento
            if ( $request->has('area-c')){//Verificamos si biene el campo de especificacion del area del conocimiento....................
                $prj->rl_tipo_area=true;
                //Si existe el campo los buscamos antes de insertarlo.
                $bandera=OtrasAreasConocimiento::where('rt_nombre_ac','=',$request->get('area-c'))->count();

                if ($bandera != 0){
                    $ac=OtrasAreasConocimiento::where('rt_nombre_ac','=',$request->get('area-c'))->first();
                    $prj->rn_codigo_area=$ac->pk_id_ac;

                }else{
                    $oa=new OtrasAreasConocimiento;
                    $oa->rt_nombre_ac=$request->get('area-c');
                    $oa->save();

                    $prj->rn_codigo_area=$oa->pk_id_ac;
                }

            }else{//Si no esta presente entonces insertamos el id del area de conocimiento..............................
                $prj->rl_tipo_area=false;
                $prj->rn_codigo_area=$request->get('area');
            }

            $prj->save();
            /*
             *          Insertamos la red de investigacodres
             */

            $ri=new RedInvestigadores;

            $ri->pk_id_red=str_random(8);
            $ri->rt_color=$request->get('colorIcon');
            $ri->rt_nombre_red=$request->get('red');
            $ri->fk_id_proyecto_investigacion=$prj->pk_id_proyecto_investigacion;
            $ri->fk_codigo_pais=$request->get('paisRed');

            if($request->has('idInconoTxt')){
                $ri->fk_codigo_icono=0;
            }else{
                $ri->fk_codigo_icono=$request->get('idInconoTxt');
            }

            if ($request->get('tipoRed') == 0){
                $ri->rl_is_diciplinaria=false;
            }else{
                $ri->rl_is_diciplinaria=true;
            }

            $ri->save();

            /*
             *      Insertamos el detalle del proyecto de investigacion....................
             */

            $dt=new DetalleProyectoInvestigacion;
            $dt->pk_codigo_detalle=str_random(12);
            $dt->fk_codigo_proyecto=$prj->pk_id_proyecto_investigacion;

            $dt->rf_fecha_inicio=$request->get('ff');
            $dt->rf_fecha_fin=$request->get('ff');
            $dt->rn_monto=$request->get('monto');
            $dt->rt_objetivo=$request->get('obj');
            $dt->rd_descripcion_objetivo=$request->get('descObj');

            $dt->save();

            /*
             *  Insersion en la tabla usuarios-proyectos
             */

            DB::table('tbl_usuarios_proyectos')->insert([
                [
                    'fk_id_participante'=>$user->pk_id_usuario,
                    'fk_id_proyecto_investigacion'=>$prj->pk_id_proyecto_investigacion
                ]

            ]);

            /*
             *  Insersion de la notificacion...........
             */

            $ntf=new Notificacion;
            $ntf->pk_id_notificacion=str_random(12);
            $ntf->fk_id_usuario=$user->pk_id_usuario;
            $ntf->fk_id_tipo_notificacion=6;
            $ntf->rl_vista=false;
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


}
