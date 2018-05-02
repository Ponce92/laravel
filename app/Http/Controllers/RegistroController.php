<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreasConocimiento;
use App\Models\GradosAcademicos;
use App\Models\Pais;
use App\Http\Requests\RegistroRequest;

class RegistroController extends Controller
{
    public function getRegistro(){
        $Paises=new Pais();
        $areasConocimiento=new AreasConocimiento();
        $gradosAcademicos=New GradosAcademicos();

        $data['AreasConocimiento']=$areasConocimiento->getAreasConocimiento();
        $grados=$gradosAcademicos->getGrados();
        $paises=$Paises->getPaises();


        return view('registro')->with('paises',$paises)
                                    ->with('GradosAcademicos',$grados);
    }

    public function postRegistro(RegistroRequest $request){

        return view('indexAdmin' );
    }
}
