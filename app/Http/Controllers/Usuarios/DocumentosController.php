<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function Index($id){
        $user=Auth::user();

        return view('Documentacion.Index')->with('user',$user);
    }
}
