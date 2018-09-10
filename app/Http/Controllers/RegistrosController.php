<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrosRequest;
use App\Models\Persona;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;

class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises=Pais::all();
        $areas=AreasConocimiento::all();
        $grados=GradosAcademicos::all();

        return view('registro')->with('paisesc',$paises)
                                     ->with('areasc',$areas)
                                     ->with('gradosc',$grados);
        //return $grados->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrosRequest $request)
    {

        if ($request->hasFile('foto')){
            $file =$request->file('foto');
            $url = time().$file->getClientOriginalName();

        }
        $persona=new Persona();
        $usuario=new Usuario();
        $hoy = date("Y-m-d");


        $persona->pk_id_persona= $this->getToken(8);
        $persona->fk_id_grado=$request->input('grado');
        $persona->fk_id_pais=$request->input('nacionalidad');
        $persona->fk_id_area=$request->input('areas');
        //$persona->correo_usuario=$request->input('correo');
        $persona->rt_nombre_persona=$request->input('nombre');
        $persona->rt_apellido_persona=$request->input('apellido');
        $persona->rl_sexo_persona=$request->input('sexo');
        $persona->rf_fecha_nacimiento=$request->input('fecha');
        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');
        $persona->rn_horas_dedicadas_investigacion=$request->input('horas_investigacion');
        $persona->rn_telefono_persona=$request->input('telefono');
        //$persona->foto_persona=$url;
        $persona->save();




        $usuario->pk_id_usuario= $this->getToken(6);
        $usuario->fk_id_persona= $persona->pk_id_persona;
        $usuario->fk_id_rol= 1;
        $usuario->rt_correo_usuario= $request->input('correo');
        $usuario->rt_foto_usuario=$url;
        $usuario->password=bcrypt($request->input('password'));
        $usuario->rf_ultimo_acceso_usuario=$hoy;
        $usuario->remember_token= $request->input('_token');
        $usuario->rl_estado_usuario='activo';
        $usuario->save();
        $file->move(public_path().'/avatar/', $url);









        return view('login');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
    public function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }

}

