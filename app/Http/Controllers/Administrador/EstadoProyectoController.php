<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Requests\Estado\CrearEstadoRequest;
use App\Http\Requests\Estado\EditarEstadoRequest;
use App\Models\EstadoProyectoInvestigacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class EstadoProyectoController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index(Request $request){
        $user=Auth::user();
        $list=EstadoProyectoInvestigacion::where('pk_id_estado','>',0)->paginate(10);

        return view('Administrador.Estado.index',compact($list))
            ->with('user',$user)
            ->with('list',$list);
    }

    public function getCrear(Request $request){
        $user=Auth::user();
        return view('Administrador.Estado.crear')
            ->with('user',$user);
    }

    public function crear(CrearEstadoRequest $request){
        $grado=new EstadoProyectoInvestigacion();

        $grado->setNombre($request->get('descripcion'));
        $request->get('estado') ? $grado->setEstadoo(true):$grado->setEstadoo(false);

        $grado->save();
        return redirect()
                ->route('estados')
                ->withsuccess('El Estado de Proyecto se ha almacenado exitosamente');
    }

    public function getEditar($id){
        $user=Auth::user();
        $obj=EstadoProyectoInvestigacion::findOrFail($id);

        return view('Administrador.Estado.editar')
                ->with('Objetivo',$obj)
                ->with('user',$user);
    }

    public function editar(EditarEstadoRequest $request){
        $objetivo=EstadoProyectoInvestigacion::findOrFail($request->get('id'));
        $obj=EstadoProyectoInvestigacion::where('rt_nombre_estado','=',$request->get('nombre'))
                            ->where('pk_id_estado','<>',$request->get('id'))
                            ->exists();

        if($obj){
            return back()->withErrors(['nombre'=>'El estado de proyecto ya se encuentra registrado en el sistema']);
        }

        $objetivo->setNombre($request->get('nombre'));

        $request->get('estado') ? $objetivo->setEstadoo(true) : $objetivo->setEstadoo(false);
        $objetivo->update();

        return redirect()->route('estados')->withsuccess('El registro ha sido actualizado');
    }
}
