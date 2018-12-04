<?php

namespace App\Http\Controllers;

use App\Models\Tematica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use App\Http\Requests\Redes\ActualizarRequest;
use App\Models\Icono;
use App\Models\Color;
use App\Models\ProyectosInvestigacion;
use App\Models\RedInvestigadores;
use App\Models\Foro;
use App\Models\TiposProyectosInvestigacion;

use App\Http\Controllers\Controller;

use DB;
use function PhpParser\filesInDir;

class ForosController extends Controller
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
        $user=Auth::user();
        $redes=[];
        $foros=[];
        $prjs=[];
        $i=0;

        $prj=DB::table('tbl_usuarios_proyectos')
            ->where('fk_id_participante','=',$user->pk_id_usuario)
            ->get();


        $forums=Foro::all();
        $datos= DB::table('tbl_foros')->get();

        /*
         *  Por cada proyecto en el que participa el investigador se recupera la red asociada a dicho proyecto
         *  De investigacion.
         */
        if(count($prj)!=0)
        {
            foreach ($prj as $p){
                $pro=ProyectosInvestigacion::find($p->fk_id_proyecto_investigacion);
                $redes[$i]=RedInvestigadores::where('fk_id_proyecto_investigacion','=',$p->fk_id_proyecto_investigacion)->first();
                $foros[$i]=Foro::where('fk_id_proyecto','=',$p->fk_id_proyecto_investigacion)->first();
                $redes[$i]['icono']=Icono::getValorIcono($redes[$i]->fk_codigo_icono);
                $redes[$i]['color']=Color::getValorColor($redes[$i]->fk_id_color);
                $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
                $redes[$i]['codigoProyecto']=$pro->pk_id_proyecto_investigacion;
                $redes[$i]['nombreProyecto']=$pro->rt_titulo_proyecto;
                $redes[$i]['acronimoProyecto']=$pro->rt_acronimo_proyecto;
                $redes[$i]['descripcionProyecto']=$pro->rd_descripcion_proyecto;
                $redes[$i]['idForo']= DB::table('tbl_foros')->where('fk_id_proyecto', '=', $pro->pk_id_proyecto_investigacion)->select('pk_id_foro')->get();
                //$forumss=DB::table('tbl_foros')->where('fk_id_proyecto', '=', $pro->pk_id_proyecto_investigacion)->select('pk_id_foro')->first();
                //$redes[$i]['idForo']=$forumss->pk_id_foro;
                $i=$i+1;
            }
        }

        //return view('Usuarios.Redes.GestionRedes')
            //->with('foros',$foros)
          //  ->with('user',$user);

    if(count($redes)!=0){
            return view('Foros/gestionForos')
                ->with('user',$user)
                ->with('forums',$datos)
                ->with('foros',$redes);

        }
        else
            return view('Foros/gestionForos')
                ->with('user',$user);
       //return $datos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request, [
            'titulo' => 'required|string|max:50|min:6',
            'descripcion' => 'required',
        ]);


        $id=Auth::id();
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



        //return $user;
        //return view( 'Foros/crearTematicas')->with('user',$user)->with('status','La tematica se almacenado correctamente')->with('idf',$idf);
        //return view('Foros/crearTematicas')->with('frs', $frs)->with('user',$user)->with('idf',$idf)->with('status','La tematica se almacenado correctamente');
        return redirect()->route('foros.shows', ['id' => $idf])->withsuccess('La tematica se almacenado correctamente');
        //return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showForo( string $id)
    {
        $user=Auth::user();
        $count=Tematica::where('fk_id_foro',$id)->count();



        if($count!=0)
        {

            //$foros=Tematica::where('fk_id_foro',$id)->get();
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
            return view('Foros/crearTematicas')->with('user',$user)->with('frs', $frs)->with('idf',$id) ->with('perfiles', $perfiles);
            //return $frs;
        }else{

            return view('Foros/crearTematicas')->with('user',$user)->with('idf',$id);
        }




        //return $id;

    }

    public function show($id)
    {
        $user=Auth::user();

        //return $id;
        return 'Este Projecto no Tiene Foro Asociado';
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarTema ( string $id)
    {
        //

        $idu=Auth::id();
        $count=Tematica::where('id_creador',$idu)->count();

            $tema=Tematica::find($id);
        $idf=$tema->fk_id_foro;
            if($tema->id_creador == $idu){


            $tema->delete();



            return redirect()->route('foros.shows', ['id' => $idf])->withsuccess('La tematica se ha eliminado correctamente');
        }else{



            return redirect()->route('foros.shows', ['id' => $idf])->withinfo('No eres el creador de la temática');

        }
        //return $id;
    }
}
