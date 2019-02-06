<?php

namespace App\Http\Controllers\Usuarios;

use App\Models\Foro;
use App\Models\Respuesta;
use App\Models\Tematica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;


class TematicaController extends Controller
{
    public function index($id){
        $user=Auth::user();
        $foro=Foro::findOrFail($id);
        $tematicas=Tematica::where('fk_id_foro','=',$id)->paginate(5);

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
        $user=Auth::user();


        $tema=new Tematica();

        $tema->setId();
        $tema->setFecha();
        $tema->setEstado(false);
        $tema->setForo($request->get('idf'));
        $tema->setCreador($user->getid());
        $tema->setTitulo($request->get('titulo'));
        $tema->setDesc($request->get('desc'));


        $tema->save();

        return redirect()->route('foros.shows',['id'=>$request->get('idf')])
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
        $user=Auth::user();

        $resp=new Respuesta();

        $resp->setId(str_random(25));
        $resp->setFecha();
        $resp->setTema($request->get('idt'));
        $resp->setUser($user->getId());
        $resp ->setDesc($request->get('desc'));

        $resp->save();

        return redirect()->route('tematica.Index',['id'=>$request->get('idt')])
            ->withsuccess('Su respuesta se ha almacenado correctamente');
    }
}
