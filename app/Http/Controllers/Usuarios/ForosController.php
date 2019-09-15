<?php

namespace App\Http\Controllers\Usuarios;

use DB;
use App\Models\Foro;
use App\Models\Icono;
use App\Models\Color;
use App\Models\Tematica;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\RedInvestigadores;
use App\Models\ProyectosInvestigacion;

class ForosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index()
    {
        $user=Auth::user();

        $foros=DB::Table('tbl_foros')
                    ->select('tbl_foros.pk_id_foro','tbl_redes_investigadores.rt_nombre_red')
                    ->join('tbl_usuarios_proyectos','tbl_usuarios_proyectos.fk_id_proyecto_investigacion','=','tbl_foros.fk_id_proyecto')
                    ->join('tbl_redes_investigadores','tbl_redes_investigadores.fk_id_proyecto_investigacion','=','tbl_usuarios_proyectos.fk_id_proyecto_investigacion')
                    ->where('tbl_usuarios_proyectos.fk_id_participante','=',$user->getId())
                    ->paginate(5);
        for ($i=0;$i<count($foros);$i++){
            $co = Tematica::where('fk_id_foro','=',$foros[$i]->pk_id_foro)->get();
            $foros[$i]->co=count($co);

        }

        return view('Foros/gestionForos')
            ->with('user',$user)
            ->with('foros',$foros);

    }


    public function create()
    {

    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'titulo' => 'required|string|max:50|min:6',
            'descripcion' => 'required|string|min:6',
        ]);

        $tema=new Tematica();
        $cod=str_random(7);
        $tema->pk_id_tema=$cod;
        $tema->titulo=$request->input('titulo');
        $tema->body=$request->input('descripcion');
        $tema->id_creador=$id;
        $tema->fk_id_foro=$request->input('idf');
        $hoy = date("d-m-Y");
        $tema->fecha=$hoy;
        $tema->save();
        $user=Auth::user();
        $idf=$request->input('idf');

        return redirect()->route('tematicas.index', ['id' => $idf])
            ->withsuccess('La temática se ha almacenado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForo( $id)
    {
        $user=Auth::user();
        $count=Tematica::where('fk_id_foro',$id)->count();

        if($count!=0)
        {

            $frs=DB::table('tbl_tematicas')
                ->where('fk_id_foro','=',$id)
                ->orderBy('created_at')
                ->get();

            $perfiles = DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.*',
                    'tbl_usuarios.*')
                ->get();
            return view('Foros/crearTematicas')
                        ->with('user',$user)->with('frs', $frs)
                        ->with('idf',$id)
                        ->with('perfiles', $perfiles);
        }else{

            return view('Foros/crearTematicas')
                        ->with('user',$user)
                        ->with('idf',$id);
        }




        //return $id;

    }

    public function show($id)
    {
        $user=Auth::user();

        //return $id;
        return 'Este Proyecto no tiene foro asociado';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function eliminarTema ( string $id)
    {
        //

        $idu=Auth::id();
        $count=Tematica::where('id_creador',$idu)->count();

            $tema=Tematica::find($id);
        $idf=$tema->fk_id_foro;
            if($tema->id_creador == $idu){


            $tema->delete();



            return back()->withsuccess('La temática se ha eliminado correctamente');
        }else{



            return back()->withinfo('No eres el creador de la temática');

        }
        //return $id;
    }
}
