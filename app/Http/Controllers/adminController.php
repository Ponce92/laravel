<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class adminController extends Controller
{
    public function getAdmin(){
        return view('indexAdmin');
    }

}
