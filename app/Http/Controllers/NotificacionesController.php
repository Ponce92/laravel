<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificacionesController extends Controller
{

     public function index(){
        $user=Auth::user();

        $join=DB::table('tbl_notificaciones')
            ->join('tbl_usuarios','tbl_usuarios.pk_id_usuario','=','tbl_notificaciones.fk_id_usuario_remitente')
            ->where('tbl_notificaciones.fk_id_usuario','=',$user->pk_id_usuario)
            ->get();
         return view('gestionNotificaciones')
             ->with('user',$user)
             ->with('notificaciones',$join);
     }

     public function aceptarRegistro(Request $request){
        if($request->has('codigo_aceptar')){
            $id=$request->get('codigo_aceptar');
            $ntf=Notificacion::findOrFail($id);

            $ntf->rl_vista=true;
            $ntf->save();

            $reg=User::findOrFail($ntf->fk_id_usuario_remitente);

            if($reg->fk_id_estado == 1){
                return  back()->withinfo('Este registro ya se encuentra activo . . . !');
            }
            $reg->fk_id_estado=1;
            $reg->save();

            return redirect()->route('notificaciones')->withsuccess('El Investigador se ha activadosatisfactoriamente');

        }
        return back();
     }

     public function rechazarRegistro(Request $request){

         if($request->has('codigo_rechazar')) {
             $id = $request->get('codigo_rechazar');
             $ntf = Notificacion::findOrFail($id);


             $ntf->rl_vista = true;
             $ntf->save();

             $reg = User::findOrFail($ntf->fk_id_usuario_remitente);
             if ($reg->fk_id_estado == 3) {
                 return redirect()->route('notificaciones')->withinfo('Este registro ya fue rechazado ...!');
             }

             $reg->fk_id_estado = 3;
             $reg->save();

             return redirect()->route('notificaciones')->withsuccess('El registro se ha rechazado, puede cambiar el estado dese la interfaza de registros . . . !');
         }
         return back()->withdanger('No puedes realizar esta acion');
     }

     public function eliminarNotifiacion(Request $request){
         if($request->has('codigo_eliminar')){
             $id = $request->get('codigo_eliminar');
             $ntf = Notificacion::findOrFail($id);

             $ntf->delete();

             return redirect()->route('notificaciones')
                 ->withsuccess('Notificacion eliminada correctamente !');
         }


        return redirect()->route('notificaciones')->withwarning("Error, Recurso no encontrado");
     }

     public function marcarLeida(Request $request){
         if($request->has('codigo_leida')){
             $id = $request->get('codigo_leida');
             $ntf = Notificacion::findOrFail($id);

             if($ntf->rl_vista ==true){
                 return back()->withdwarring("Notificacion ya maracada como vista");
             }

             $ntf->rl_vista=true;
             $ntf->save();
             return redirect()->route('notificaciones')
                 ->withsuccess('Has marcada como vista esta notificacion');
         }
         return back()->withdwarring("Error, Recurso no encontrado");

     }

}
