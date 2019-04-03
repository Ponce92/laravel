<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 29/11/18
 * Time: 10.48
 */

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Auth;
use DB;
use Redirect;
use App\Models\Persona;


class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $persona=Persona::find($user->fk_id_persona);

        return view('chat')
           ->with('user',$user)
            ->with('persona',$persona);
    }


}
