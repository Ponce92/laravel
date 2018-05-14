<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class adminController extends Controller
{
    public function getAdmin(){
        $menus=Menu::getMenus();
        $t=0;
        return view('indexAdmin')
            ->with('menus',$menus)
            ->with('t',$t);
    }

}
