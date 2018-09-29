<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionesController extends Controller
{

     public function index(){
        $user=Auth::user();

        $notf=[];
         return view('gestionNotificaciones')
             ->with('user',$user)
             ->with('notif',$notf);
     }
}
