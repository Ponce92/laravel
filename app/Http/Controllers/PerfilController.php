<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function getFormPersonal(Request $request){
        if($request->ajax()){
            return view('AdminFragment.FrgPersonalForm');
        }
        return redirect()->route('dashboard');
    }

    public function getContatosAjax(Request $request){
        if($request->ajax()){
            return view('AdminFragment.FrgPersonalContact');
        }
    }
}
