<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Requests\Grado\CrearGradoRequest;
use App\Http\Requests\Grado\EditarGradoRequest;
use App\Models\GradosAcademicos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class GradoController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index(Request $request){
        $user=Auth::user();
        $list=GradosAcademicos::where('pk_id_grado','>',0)->paginate(4);

        return view('Administrador.Grado.index',compact($list))
            ->with('user',$user)
            ->with('list',$list);
    }

    public function getCrear(Request $request){
        $user=Auth::user();
        return view('Administrador.Grado.crear')
            ->with('user',$user);
    }

    public function crear(CrearGradoRequest $request){
        $grado=new GradosAcademicos();

        $grado->setNombre($request->get('nombre'));
        $request->get('estado') ? $grado->setEstado(true):$grado->setEstado(false);

        $grado->save();
        return redirect()
                ->route('grados')
                ->withsuccess('El grado académico se ha almacenado exitosamente');
    }

    public function getEditar($id){
        $user=Auth::user();
        $grado=GradosAcademicos::findOrFail($id);

        return view('Administrador.Grado.editar')
                ->with('Grado',$grado)
                ->with('user',$user);
    }

    public function editar(EditarGradoRequest $request){
        $grado=GradosAcademicos::findOrFail($request->get('id'));
        $gr=GradosAcademicos::where('rt_nombre_grado','=',$request->get('nombre'))
                            ->where('pk_id_grado','<>',$request->get('id'))
                            ->exists();

        if($gr){
            return back()->withErrors(['nombre'=>'El grado académico ya se encuentra registrado en el sistema']);
        }

        $grado->setNombre($request->get('nombre'));

        $request->get('estado') ? $grado->setEstado(true) : $grado->setEstado(false);
        $grado->update();

        return redirect()->route('grados')->withsuccess('El registro ha sido actualizado');
    }
}
