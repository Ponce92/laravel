<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Documento;
use App\Models\ProyectosInvestigacion;
use Illuminate\Support\Facades\Storage;


class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Index($id){
        $user=Auth::user();
        $proyecto=ProyectosInvestigacion::find($id);

        $paginate=7;
        $documentos = Documento::where('fk_id_proyecto','=',$id)->paginate($paginate);
        return view('Documentacion.Index', compact($documentos))
            ->with('id',$id)
            ->with('user',$user)
            ->with('documentos' , $documentos)
            ->with('proyecto',$proyecto);
    }

    public function AgregarDocumento(Request $request){
        $file=$request->file('file');
        $doc =new Documento();

        $doc->setNombre($file->getClientOriginalName());
        $doc->setExtension($file->getClientOriginalExtension());
        $doc->setProyecto($request->get('id_proyecto'));

        try{
            $doc->save();
            Storage::disk('local')->putFileAs(
                'public/documentos/',
                $file,
                $doc->getId().'.'.$doc->getExtension()
            );
        }catch (\Exception $e){
            $doc->delete();
            return back()->withdanger('Error al cargar el archivo al servidor, documento excede el tamaño soportado por el servidor');
        }


        //$file->storeAs('public/DocumentosProyecto',$doc->getId().'.'.$doc->getExtension());

        return back()->withsuccess('El archivo se ha subido con éxito');
    }

    public function DocumentoDescargar($id){

        $doc=Documento::where('rt_nombre','=',$id)->firstOrFail();
        $tipoDoc=$doc->getTipoArchivo();

        $nombre=$doc->getId().'.'.$doc->getExtension();
        $url='public/documentos/'.$nombre;


        if (Storage::exists($url))
        {
             return Response()->download('storage/documentos/'.$nombre);
        }else{
            try {
                 $doc->delete();
            }catch(Exception $e){
                return back();
            }
        }

        return back()->withinfo("El recurso no existe");

    }

    public  function  DocumentoDelete($id){
        $doc=Documento::where('rt_nombre','=',$id)->firstOrFail();

        $nombre=$doc->getId().'.'.$doc->getExtension();


        if (Storage::exists('public/documentos/'.$nombre))
        {
            $doc->delete();
            Storage::delete('public/documentos/'.$nombre);
            return back()->withsuccess('El archivo se ha eliminado correctamente');

        }else{
            try {
                $doc->delete();
            }catch(Exception $e){
                //..
            }

            return back()->withinfo("El recurso no existe");
        }


        return response()->download( );

    }

}
