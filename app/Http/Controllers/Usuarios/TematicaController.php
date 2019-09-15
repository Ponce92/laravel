<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Foro;
use App\Models\Comentario;
use App\Models\Respuesta;
use App\Models\Tematica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notificacion;
use Carbon\Carbon;
use Auth;
use DB;
use App\User;


class TematicaController extends Controller
{
    public function index($id){
        $user=Auth::user();
        $foro=Foro::findOrFail($id);
        $tematicas=Tematica::where('fk_id_foro','=',$id)->paginate(8);

        return view('Usuarios.Foros.Index')
            ->with('user',$user)
            ->with('idf',$id)
            ->with('foro',$foro)
            ->with('tematicas',$tematicas);
    }

    public function getCrear($id){

        $user=Auth::user();

        $foro=Foro::findOrFail($id);

        return view('Usuarios.Foros.AgregarTematica')
            ->with('user',$user)
            ->with('foro',$foro);
    }

    public function Crear(Request $request){
        $this->validate($request, [
            'titulo' => 'required|string|max:50|min:6|unique:tbl_tematicas,titulo',
            'desc' => 'required|string|min:6',
        ]);
        $user=Auth::user();


        $tema=new Tematica();
        $foro=Foro::findOrFail($request->get('idf'));


        $tema->setId();
        $tema->setFecha();
        $tema->setEstado(false);
        $tema->setForo($request->get('idf'));
        $tema->setCreador($user->getid());
        $tema->setTitulo($request->get('titulo'));
        $tema->setDesc($request->get('desc'));


        $tema->save();
        $creador=$tema->id_creador;
        $idtema=$tema->pk_id_tema;
        //obtenemos los participantes del foro para enviarles la notificacion
        
        $colaboradores=DB::table('tbl_usuarios_proyectos')->where('fk_id_proyecto_investigacion','=',$foro->fk_id_proyecto)->get();
        foreach ($colaboradores as $col){
            
            $ntf=new Notificacion;
        
            $ntf->pk_id_notificacion=str_random(12);
            $ntf->fk_id_usuario=$col->fk_id_participante;
            $ntf->rl_vista=false;
            $ntf->rt_tipo_notificacion='NT';
            $fech=Carbon::now();
            $ntf->rf_fecha_creacion=$fech->format('Y-m-d');
            $ntf->fk_id_usuario_remitente=$creador;
            $ntf->rt_codigo_proyecto=$idtema;

            if( $ntf->fk_id_usuario != $ntf->fk_id_usuario_remitente ){
             $ntf->save();   
            }
            
        }
        

        return redirect()->route('tematicas.index',['id'=>$request->get('idf')])
            ->withsuccess('Se ha registrado el nuevo tema de discucion');
    }

    public function Show($id){
        $user=Auth::user();
        $tematica=Tematica::findOrFail($id);

        return view('Usuarios.Foros.verTematica')
            ->with('user',$user)
            ->with('tematica',$tematica);
    }

    public function agregarRespuesta($id){
        $user=Auth::user();
        $tematica=Tematica::findOrFail($id);


    return view('Usuarios.Foros.ResponderTematica')
        ->with('user',$user)
        ->with('tematica',$tematica);
    }

    public function Responder(Request $request){
        $this->validate($request, [
            'desc' => 'required|string|min:6',
            ]);
        $user=Auth::user();

        $resp=new Respuesta();

        $resp->setId(str_random(25));
        $resp->setFecha();
        $resp->setTema($request->get('idt'));
        $resp->setUser($user->getId());
        $resp ->setDesc($request->get('desc'));

        $resp->save();

        $ntf=new Notificacion;
        $tema=Tematica::findOrFail($request->get('idt'));
        $ntf->pk_id_notificacion=str_random(12);
        $ntf->fk_id_usuario=$tema->id_creador;
        $ntf->rl_vista=false;
        $ntf->rt_tipo_notificacion='NR';
        $fech=Carbon::now();
        $ntf->rf_fecha_creacion=$fech->format('Y-m-d');
        $ntf->fk_id_usuario_remitente=$user->pk_id_usuario;
        $ntf->rt_codigo_proyecto=$request->get('idt');
        if( $ntf->fk_id_usuario != $ntf->fk_id_usuario_remitente ){
         $ntf->save();   
        }

        return redirect()->route('tematica.Index',['id'=>$request->get('idt')])
            ->withsuccess('Su respuesta se ha almacenado correctamente');
    }

    public function Comentar(Request $request)
    {
        
        
        $user=Auth::user();

        $com=new Comentario();

        $com->setFecha();
        $com->setRespuesta($request->get('res'));
        $com->setUser($user->getId());
        $com ->setValor($request->get('comm'));

        $com->save();

        $ntf=new Notificacion;
        $respuesta=Respuesta::findOrFail($request->get('res'));
        $ntf->pk_id_notificacion=str_random(12);
        $ntf->fk_id_usuario=$respuesta->id_usuario;
        $ntf->rl_vista=false;
        $ntf->rt_tipo_notificacion='NC';
        $fech=Carbon::now();
        $ntf->rf_fecha_creacion=$fech->format('Y-m-d');
        $ntf->fk_id_usuario_remitente=$user->pk_id_usuario;
        $ntf->rt_codigo_proyecto=$request->get('idt');
        if( $ntf->fk_id_usuario != $ntf->fk_id_usuario_remitente ){
         $ntf->save();   
        }
        

        return redirect()->route('tematica.Index',['id'=>$request->get('tem')])
            ->withsuccess('Su respuesta se ha almacenado correctamente');
    }
}
