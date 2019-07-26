<?php

namespace App\Http\Controllers\Administrador;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pais;

class AdminRootController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /*      Inicio de los metodos de las del controlador
     *
     */
    public function index(Request $request){
        $user=Auth::user();

        return view('RootAdmin.rootIndex')->with('user',$user);
    }

}