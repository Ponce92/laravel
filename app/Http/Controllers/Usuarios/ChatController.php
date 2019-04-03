<?php

namespace App\Http\Controllers\Usuarios;


use Illuminate\Http\Request;
use App\Models\Contacto;
use App\User;
use App\Models\Mensaje;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function Index()
    {
        $user=Auth::user();
        $contactos=Contacto::where('fk_id_user1',$user->getId())
                            ->orWhere('fk_id_user2',$user->getId())
                            ->get();

        return view('Usuarios.Chat.Index')
            ->with('user', $user)
            ->with('contactos',$contactos)
            ->with('var51', 'value');
    }

    public function loadJson(Request $request){
        $user=Auth::user();
        $Usr=User::findOrFail($request->get('id'));
        $Mensajes = Mensaje::where('rt_codigo','=',$user->getId().'_'.$request->get('id'))
                            ->orWhere('rt_codigo','=',$request->get('id').'_'.$user->getId())
                            ->get();
        
        $vista= view('Usuarios.Chat.frgChat')
        ->with('Mensajes',$Mensajes)
        ->with('user',$user)
        ->with('usr',$Usr)
        ->render();

        return response()->json(array('html'=>$vista));
    }
}
