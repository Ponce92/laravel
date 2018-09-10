<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use DB;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAdmin(){
        $user=Auth::user();
        return view('indexAdmin')->with('user',$user);
    }

}
