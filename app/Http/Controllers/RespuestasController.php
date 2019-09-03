<?php

namespace App\Http\Controllers;

use App\Models\Respuesta;
use App\Models\Tematica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ProyectosInvestigacion;
use App\Models\RedInvestigadores;
use App\Models\Foro;
use DB;
use Carbon\Carbon;
use function MongoDB\BSON\toJSON;

class RespuestasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Foros/crearRespuesta');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id=Auth::id();
        $respuesta=new Respuesta();
        $cod=str_random(8);
        $hoy = date("d-m-Y");
        $respuesta->pk_id_respuesta=$cod;
        $respuesta->id_usuario=$id;
        $respuesta->fecha=$hoy;
        $respuesta->fk_id_tema=$request->input('idt');
        $respuesta->body=$request->input('desc');
        $respuesta->save();
        $tema = DB::table('tbl_tematicas')->where('pk_id_tema', $respuesta->fk_id_tema)->first();
        $idf=$tema->fk_id_foro;

        DB::table('tbl_tematicas')->where('pk_id_tema', $respuesta->fk_id_tema)->increment('re_count');



        //return $respuesta
            return redirect()->route('respuestas.shows', ['id' => $respuesta->fk_id_tema, 'idf' => $idf  ])->withsuccess('La respuesta se almacenado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //crear un respuesta
        $user = Auth::user();
        $pro=Tematica::find($id);
        $prooo = DB::table('tbl_tematicas')->where('pk_id_tema', $id)->first();//recupero la temática
        $proo=DB::table('tbl_tematicas')
            ->where('pk_id_tema','=',$id)
            ->first();

        $perfil = DB::table('tbl_usuarios')
            ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
            ->select('tbl_personas.rt_nombre_persona',
                'tbl_personas.*',
                'tbl_usuarios.*')
            ->where('tbl_usuarios.pk_id_usuario','=',$prooo->id_creador)
            ->first();

        //return $perfiles;
        return view('Foros/crearRespuesta')->with('user',$user)->with('idt', $id)->with('tema', $prooo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showRespuestas( string $id, string $idf)
    {
        $user = Auth::user();
        $count = Respuesta::where('fk_id_tema', $id)->count();
        $temas = DB::table('tbl_tematicas')->where('pk_id_tema', $id)->get();



        if ($count != 0) {

            //$foros=Tematica::where('fk_id_foro',$id)->get();
            $resps = DB::table('tbl_respuestas')
                ->where('fk_id_tema', '=', $id)
                ->orderBy('created_at')
                ->get();
            $perfiles = DB::table('tbl_usuarios')
                ->join('tbl_personas','tbl_usuarios.fk_id_persona','=','tbl_personas.pk_id_persona')
                ->select('tbl_personas.rt_nombre_persona',
                    'tbl_personas.*',
                    'tbl_usuarios.*')
                ->get();
            //return view('Foros/crearTematicas')->with('user', $user)->with('temas', $temas)->with('idt', $id);
            return view('Foros/mostrarRespuestas')
                    ->with('user', $user)
                    ->with('resps', $resps)
                    ->with('idt', $id)
                    ->with('idf', $idf)
                    ->with('perfiles', $perfiles)
                    ->with('temas', $temas);
            //return $frs;
        } else {

            return view('Foros/mostrarRespuestas')->with('user', $user)->with('idt', $id)->with('idf', $idf)->with('temas', $temas);
        }
    }

    public function eliminarRespuesta ( string $id, string $idf)
    {
        //

        $idu=Auth::id();

        $respuesta=Respuesta::find($id);
        if($respuesta->id_usuario == $idu){

            DB::table('tbl_tematicas')->where('pk_id_tema', $respuesta->fk_id_tema)->decrement('re_count');
            $respuesta->delete();



            //return redirect()->route('respuestas.shows', ['id' => $id, 'idf' => $idf  ])->withsuccess('La respuesta se ha eliminado');
            return redirect()->route('foros.shows', ['id' => $idf])->withsuccess('La respuesta se ha eliminado');

        }else{



            //return redirect()->route('respuestas.shows', ['id' => $id, 'idf' => $idf])->withinfo('No eres el creador de la respuesta');
            return redirect()->route('foros.shows', ['id' => $idf])->withinfo('No eres el creador de la respuesta');

        }
        //return $id;
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
