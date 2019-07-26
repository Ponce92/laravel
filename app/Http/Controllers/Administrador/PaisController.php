<?php

namespace App\Http\Controllers\Administrador;

use App\Models\Pais;
use Illuminate\Http\Request;
use App\Http\Requests\Pais\CrearPaisRequest;
use App\Http\Requests\Pais\EditarPaisRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaisController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $user=Auth::user();
        $list=Pais::where('pk_id_pais','>',0)->paginate(8);

        return view('Administrador.Pais.pais',compact($list))
                ->with('user',$user)
                ->with('list',$list);
    }

    public function getCrear(){
        $user=Auth::user();

        return view('Administrador.Pais.crear')
            ->with('user',$user);
    }

    public function crear(CrearPaisRequest $request){
        $pais =new Pais();

        $pais->setId($request->get('codigo'));
        $pais->setNombre($request->get('nombre'));
        $pais->setEstado($request->get('estado'));
        $pais->save();

        return redirect()
                ->route('ajustes.paises')
                ->withsuccess('El registro se ha almacenado correctamente');
    }

    public function getEditar($id){
        $user=Auth::user();
        $pais=Pais::findOrFail($id);

        return view('Administrador.Pais.editar')
            ->with('user',$user)
            ->with('Pais',$pais);

    }

    public function Editar(EditarPaisRequest $request){
        $pais=Pais::findOrFail($request->get('codigo'));
        $var=Pais::where('rt_nombre_pais','=',$request->get('nombre'))
                    ->where('pk_id_pais','<>',$pais->getId())
                    ->exists();

        if($var){
            return back()->withErrors(['nombre'=>'El nombre del pais ya se encuentra registrado en el sistema']);
        }

        $pais->setNombre($request->get('nombre'));

        if($request->get('estado')){
            $pais->setEstado(true);
        }else{
            $pais->setEstado(false);
        }


        $pais->update();

        return redirect()
            ->route('ajustes.paises')
            ->withsuccess('El registro se ha actualizado correctamente');
    }
}
