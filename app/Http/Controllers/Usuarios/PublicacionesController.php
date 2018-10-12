<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Requests\Publicaciones\EditarPublicacionRequest;
use App\Models\LibrosPublicaciones;
use App\Models\OtrasAreasConocimiento;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use DB;
use App\Models\Publicacion;
use App\Models\AreasConocimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\Publicaciones\CrearPublicacionRequest;

use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Flash;




class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function verPublicaciones(Request $request)
    {   $user=Auth::user();
        $publicacines=$user->publicaciones()->get();
        foreach ($publicacines as $pub){
            $ff=Carbon::createFromFormat('Y-m-d',$pub->rf_fecha_publicacion);
            $ff=$ff->format('d-m-Y');

            $pub->rf_fecha_publicacion=$ff;
        }

        $otrasAreas=OtrasAreasConocimiento::all();

        $libros=$user->librosPublicados()->get();

        foreach ($libros as $lib){
            $ff=Carbon::createFromFormat('Y-m-d',$lib->rf_fecha);
            $ff=$ff->format('d-m-Y');

            $lib->rf_fecha=$ff;
        }

        return view('Usuarios.Publicaciones.gestionPublicaciones')
            ->with('areas',AreasConocimiento::all())
            ->with('otrasAreas',OtrasAreasConocimiento::all())
            ->with('user',$user)
            ->with('otrasAreas',$otrasAreas)
            ->with('publicaciones',$publicacines)
            ->with('libros',$libros);

    }

    public  function agregarPublicacionForm()
    {
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        return view('Usuarios.Publicaciones.AgregarPublicacion')
            ->with('user',Auth::user())
            ->with('areas',$areas);
    }

    public function agregarPublicacion(CrearPublicacionRequest $request)
    {
        //Experimental...
        $pubb=null;
        $libb=null;
        //fin Experimental...

        $tipo=$request->get('tipo');
        $titulo=$request->get('titulo');
        $user=Auth::user();

        if($tipo=='libro'){// La publicacion es un libro................................................................
            $count=LibrosPublicaciones::where('rt_titulo','=',$titulo)
                                ->where('fk_id_usuario','=',$user->pk_id_usuario)
                                ->count();

            if($count!=0){
                return back()
                    ->withInput()
                    ->with('areas',AreasConocimiento::all())
                    ->withErrors(['titulo'=>'Ya tienes otro proyecto con ese titulo.']);

            }//El usuario  ya tiene un libro publicado que tiene el mismo titulo........................................

            $fch=Carbon::createFromFormat('d-m-Y',$request->get('fecha'));
            $fch=$fch->format('Y-m-d');


            $lib= new LibrosPublicaciones;

            $lib->fk_id_usuario=$user->pk_id_usuario;
            $lib->rt_titulo=$request->get('titulo');
            $lib->rf_fecha=$fch;
            $lib->rt_issn=$request->get('issn');
            $lib->rn_capitulo=$request->get('nc');
            $lib->rn_pagina=$request->get('np');
            $lib->rd_descripcion=$request->get('descripcion');

            /*
             * Isersion del area del cococimiento.....................
             */

            if ( $request->has('area-c')){

                $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

                if ($bandera != 0){
                    $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                    $lib->fk_id_area=$ac->pk_id_area;
                }else{
                    $oa=new AreasConocimiento;
                    $oa->fk_codigo_icono=1;
                    $oa->rt_nombre_area=$request->get('area-c');
                    $oa->save();

                    $lib->fk_id_area=$oa->pk_id_area;
                }

            }else{
                $lib->fk_id_area=$request->get('area');
            }

            $lib->save();
            $libb=$lib;

            Session::put('libb',$libb);

            return redirect()->route('verPublicaciones')->withsuccess('El registro se ha almacenado correctamente');

        }else{//La publicaicon es un nota cientifica o un articulo cientifico...........................................

            $count=Publicacion::where('rt_titulo','=',$titulo)
                ->where('fk_id_usuario','=',$user->pk_id_usuario)
                ->count();

            if($count!=0){
                return back()
                    ->withInput()
                    ->with('areas',AreasConocimiento::all())
                    ->withErrors(['titulo'=>'Ya tienes otro proyecto con ese titulo.']);

            }//El usuario tiene registrada una publicacion que se llama igual...........................................

            $fch=Carbon::createFromFormat('d-m-Y',$request->get('fecha'));
            $fch=$fch->format('Y-m-d');

            $pub=new Publicacion;

            $pub->fk_id_usuario=$user->pk_id_usuario;
            $pub->rt_titulo=$request->get('titulo');
            $pub->rf_fecha_publicacion=$fch;
            $pub->rd_descripcion_publicacion=$request->get('descripcion');
            $pub->rt_tipo_publicacion=$request->get('tipo');
            $pub->rt_enlace_publicacion=$request->get('enlace');

            if ( $request->has('area-c')){

                $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

                if ($bandera != 0){
                    $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                    $pub->fk_id_area=$ac->pk_id_area;
                }else{
                    $oa=new AreasConocimiento;
                    $oa->fk_codigo_icono=1;
                    $oa->rt_nombre_area=$request->get('area-c');
                    $oa->save();

                    $pub->fk_id_area=$oa->pk_id_area;
                }

            }else{
                $pub->fk_id_area=$request->get('area');
            }

            $pub->save();

            $pubb=$pub;
            Session::put('libb',$pubb);
            return redirect()->route('verPublicaciones')->withsuccess('El registro se ha almacenado correctamente');
        }
    }

    public function eliminarPublicacion(Request $request)
    {
        $id=$request->get('id_obj');

        $count=Publicacion::where('pk_id_publicacion',$id)->count();
        if($count >0){

            $model=Publicacion::find($id);
            $model->delete();


            return redirect()->route('verPublicaciones')
                ->withinfo('El registro se ha eliminado correctamente');
        }else{

            return redirect()->route('verPublicaciones')->withdanger('El recurso que intentas eliminar ya  no existe');
        }
    }

    public function eliminarLibroPublicado(Request $request)
    {
        $id=$request->get('id_lp');
        $user=Auth::user();
        $count=LibrosPublicaciones::where('pk_id_libro',$id)->count();

        if($count >0){
            $model=LibrosPublicaciones::find($id);
            $model->delete();

            /* Preparamos los parametros de la vista.....................
             *
            */

            return redirect()->route('verPublicaciones')->withsuccess('El registro se ha eliminado con exito');
        }else{

            return redirect()->route('verPublicaciones')->withdanger('El recurso que solicitaste eliminar no existe');
        }
    }

    public function actualizarPublicacionForm($id){

        $user=Auth::user();
        $publicacion=Publicacion::find($id);
        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();

        $ar=AreasConocimiento::find($publicacion->fk_id_area);

        $publicacion['area']=$ar->rt_nombre_area;

        $ff=Carbon::createFromFormat('Y-m-d',$publicacion->rf_fecha_publicacion);
        $publicacion->rf_fecha_publicacion=$ff->format('d-m-Y');

        return view('Usuarios.Publicaciones.EditarPublicacion')
            ->with('user',$user)
            ->with('publicacion',$publicacion)
            ->with('areas',$areas)
            ->with('otrasAreas',OtrasAreasConocimiento::all())
            ->with('id',$id);
    }

    public function actualizarPublicacion(EditarPublicacionRequest $request)
    {
        $user=Auth::user();

        $titulo=$request->get('titulo');
        $id=$request->get('id');
        $count=Publicacion::where('rt_titulo','=',$titulo)
            ->where('pk_id_publicacion','<>',$id)
            ->where('fk_id_usuario','=',$user->pk_id_usuario)
            ->count();

        if ($count > 0){
            return back()
                ->withInput()
                ->with('areas',AreasConocimiento::all())
                ->withErrors(['titulo'=>'Ya tienes otro proyecto con ese titulo.']);
        }

        $fch=Carbon::createFromFormat('d-m-Y',$request->get('fecha'));
        $fch=$fch->format('Y-m-d');

        $pub=Publicacion::find($id);
        $pub->rt_titulo=$request->get('titulo');
        $pub->rf_fecha_publicacion=$fch;
        $pub->rd_descripcion_publicacion=$request->get('descripcion');
        $pub->rt_tipo_publicacion=$request->get('tipo');
        $pub->rt_enlace_publicacion=$request->get('enlace');

        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $pub->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $pub->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $pub->fk_id_area=$request->get('area');
        }

        $pub->save();

        $pubb=$pub;
        Session::put('pubb',$pubb);
        return redirect()->route('verPublicaciones')->withsuccess('El registro se ha almacenado correctamente');

    }

    public function actualizarPublicacionLibroForm($id){

        $user=Auth::user();
        $libroP=LibrosPublicaciones::findOrFail($id);

        if(strcmp($libroP->fk_id_usuairo,$user->pk_id_usuario) ==0 ){
            return redirect()->route('verPublicaciones')->withdanger('Parece que no eres propietario de este recurso');
        }

        $areas=AreasConocimiento::where('pk_id_area','<',100)->get();
        $otrasA=AreasConocimiento::where('pk_id_area','>',100)->get();



        $ff=Carbon::createFromFormat('Y-m-d',$libroP->rf_fecha);
        $libroP->rf_fecha=$ff->format('d-m-Y');

        $ar=AreasConocimiento::find($libroP->fk_id_area);

        $libroP['area']=$ar->rt_nombre_area;

        return view('Usuarios.Publicaciones.EditarPublicacionLibro')
            ->with('user',$user)
            ->with('libro',$libroP)
            ->with('areas',$areas)
            ->with('otrasA',$otrasA)
            ->with('id',$id);
    }

    public function actualizarPublicacionLibro(EditarPublicacionRequest $request)
    {
        $user=Auth::user();
        $titulo=$request->get('titulo');
        $id=$request->get('id');
        $count=LibrosPublicaciones::where('rt_titulo','=',$titulo)
            ->where('pk_id_libro','<>',$id)
            ->where('fk_id_usuario','=',$user->pk_id_usuario)
            ->count();
        if ($count > 0){
            return back()
                ->withInput()
                ->with('areas',AreasConocimiento::all())
                ->withErrors(['titulo'=>'Ya tienes otra publicacion en libros con ese titulo.']);
        }

        $fch=Carbon::createFromFormat('d-m-Y',$request->get('fecha'));
        $fch=$fch->format('Y-m-d');
        $libro=LibrosPublicaciones::find($id);

        $libro->rt_titulo=$request->get('titulo');
        $libro->rf_fecha=$fch;
        $libro->rt_issn=$request->get('issn');
        $libro->rn_capitulo=$request->get('nc');
        $libro->rn_pagina=$request->get('np');
        $libro->rd_descripcion=$request->get('descripcion');

        if ( $request->has('area-c')){

            $bandera=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->count();

            if ($bandera != 0){
                $ac=AreasConocimiento::where('rt_nombre_area','=',$request->get('area-c'))->first();
                $libro->fk_id_area=$ac->pk_id_area;
            }else{
                $oa=new AreasConocimiento;
                $oa->fk_codigo_icono=1;
                $oa->rt_nombre_area=$request->get('area-c');
                $oa->save();

                $libro->fk_id_area=$oa->pk_id_area;
            }

        }else{
            $libro->fk_id_area=$request->get('area');
        }


        $libro->save();
        $libb=$libro;

        Session::put('libb',$libb);

        return redirect()->route('verPublicaciones')->withsuccess('El registro se ha actualizado correctamente');

    }
}
