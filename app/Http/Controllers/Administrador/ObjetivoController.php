<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Requests\Objetivo\CrearObjetivoRequest;
use App\Http\Requests\Objetivo\EditarObjetivoRequest;
use App\Models\ObjetivoSocioeconomico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class ObjetivoController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index(Request $request){
        $user=Auth::user();
        $list=ObjetivoSocioeconomico::where('pk_codigo_objetivo','>',0)->paginate(10);

        return view('Administrador.Objetivo.index',compact($list))
            ->with('user',$user)
            ->with('list',$list);
    }

    public function getCrear(Request $request){
        $user=Auth::user();
        return view('Administrador.Objetivo.crear')
            ->with('user',$user);
    }

    public function crear(CrearObjetivoRequest $request){
        $grado=new ObjetivoSocioeconomico();

        $grado->setDescripcion($request->get('descripcion'));
        $request->get('estado') ? $grado->setEstado(true):$grado->setEstado(false);

        $grado->save();
        return redirect()
                ->route('objetivos')
                ->withsuccess('El objetivo socioeconómico se ha almacenado exitosamente');
    }

    public function getEditar($id){
        $user=Auth::user();
        $obj=ObjetivoSocioeconomico::findOrFail($id);

        return view('Administrador.Objetivo.editar')
                ->with('Objetivo',$obj)
                ->with('user',$user);
    }

    public function editar(EditarObjetivoRequest $request){
        $objetivo=ObjetivoSocioeconomico::findOrFail($request->get('id'));
        $obj=ObjetivoSocioeconomico::where('rd_descripcion_objetivo','=',$request->get('nombre'))
                            ->where('pk_codigo_objetivo','<>',$request->get('id'))
                            ->exists();

        if($obj){
            return back()->withErrors(['nombre'=>'El objetivo socioeconómico ya se encuentra registrado en el sistema']);
        }

        $objetivo->setDescripcion($request->get('nombre'));

        $request->get('estado') ? $objetivo->setEstado(true) : $objetivo->setEstado(false);
        $objetivo->update();

        return redirect()->route('objetivos')->withsuccess('El registro ha sido actualizado');
    }
}
