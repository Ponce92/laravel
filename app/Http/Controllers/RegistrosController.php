<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RegistrosRequest;
use App\Models\Persona;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Notificacion;
use DB;

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
        $paises=Pais::where('rl_estado','=',true)->get();
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $grados=GradosAcademicos::where('rl_estado','=',true)->get();

        return view('Registro/registro')->with('paisesc',$paises)
                                     ->with('areasc',$areas)
                                     ->with('gradosc',$grados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * RegistrosRequest
     */
    public function store(Request $request)
    {

        $persona=new Persona();
        $usuario=new User();


        /*   Acreacion de persona    */
        $persona->pk_id_persona= str_random(10);
        $persona->fk_id_pais=$request->input('nacionalidad');
        $persona->fk_id_area=$request->input('areas');
        $persona->rt_nombre_persona=$request->input('nombre');
        $persona->rt_apellido_persona=$request->input('apellido');
        $persona->rl_sexo_persona=$request->input('sexo');
        $persona->fk_id_pais=$request->get('pais');
        $persona->fk_id_grado=$request->get('grado');
        $persona->rt_institucion=$request->input('institucion');
        $persona->rt_direccion=$request->input('direccion');
        $persona->rn_horas_dedicadas_investigacion=$request->input('horas');

        /*  Insertamos la fecha adecuadamente */
        $f=Carbon::createFromFormat("d-m-Y",$request->get('fecha'));
        $f=$f->format('Y-m-d');
        $persona->rf_fecha_nacimiento=$f;

        /*      Insertamos el area del conocimineto */

        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $persona->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $persona->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $persona->fk_id_area=$request->get('area');
        }



        $persona->save();

//        Intentamos realizar la insersion del la foto a la carpeta storage
        $file =$request->file('foto');
        $url = time().$file->getClientOriginalName();

//        $file->move(public_path().'/avatar/', $url);
//        Storage::disk('local')->put('/avatar/'.$url,$file);

        Storage::disk('local')->putFileAs(
            'public/avatar/',
            $file,
            $url
        );



        $usuario->pk_id_usuario=str_random(10);

        $usuario->fk_id_persona= $persona->pk_id_persona;
        $usuario->fk_id_rol= 1;
        $usuario->fk_id_estado=2;
        $usuario->email= $request->input('correo');
        $usuario->remember_token='';
        $usuario->rt_foto_usuario=$url;
        $usuario->password=bcrypt($request->input('password'));
        $ff=Carbon::now();
        $usuario->rf_ultimo_acceso_usuario=$ff->format('Y-m-d');


                                    /*      Se crea la notificacion para el administrador       */

        $ntf=new Notificacion;

        $ntf->pk_id_notificacion=str_random(12);
        $ntf->fk_id_usuario='@riues';
        $ntf->rl_vista=false;
        $ntf->rt_tipo_notificacion='SRI';
        $fech=Carbon::now();
        $ntf->rf_fecha_creacion=$fech->format('Y-m-d');
        $ntf->fk_id_usuario_remitente=$usuario->pk_id_usuario;


        /* Se realiza la insersion a la base de datos*/
        DB::beginTransaction();

        try {
            $persona->save();
            $usuario->save();

            $ntf->save();

            DB::commit();
            $exito=true;

        }catch(\Exception $e){
            $error = $e->getMessage();
            DB::rollback();
            $exito=false;

        }
        if($exito){
            return redirect()->route('log')
                ->withsuccess('Se registrado con exito, ahora puede ingresar al sistema con tus credenciales');
        }

        return redirect()->route('log')
            ->withdanger($error);

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

