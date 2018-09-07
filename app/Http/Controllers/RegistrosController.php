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

        return view('registro')->with('paises',$paises)
                                     ->with('areas',$areas)
                                     ->with('grados',$grados);
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


        $persona->id_persona= $this->getToken(8);
        $persona->id_grado=$request->input('grado');
        $persona->id_pais=$request->input('nacionalidad');
        $persona->id_area=$request->input('areas');
        $persona->correo_usuario=$request->input('correo');
        $persona->nombre_persona=$request->input('nombre');
        $persona->apellido_persona=$request->input('apellido');
        $persona->sexo_persona=$request->input('sexo');
        $persona->fecha_nacimiento=$request->input('fecha');
        $persona->institucion=$request->input('institucion');
        $persona->direccion=$request->input('direccion');
        $persona->horas_dedicadas_investigacion=$request->input('horas_investigacion');
        $persona->telefono_persona=$request->input('telefono');
        $persona->foto_persona=$url;
        $persona->save();
        $file->move(public_path().'/avatar/', $url);



        $usuario->id_usuario= $this->getToken(6);
        $usuario->id_persona= $persona->id_persona;
        $usuario->id_rol= 2;
        $usuario->correo_usuario= $persona->correo_usuario;
        $usuario->password=bcrypt($request->input('contrasenia1'));
        $usuario->ultimo_acceso_usuario=$hoy;
        $usuario->remember_token= $request->input('_token');
        $usuario->estado_usuario='activo';
        $usuario->save();









        return 'Exito';
        //return $persona->id_persona;
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

