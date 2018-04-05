<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class adminController extends Controller
{
    public function getAdmin(){
        $menus=Menu::getMenus();
        return $menus;
        return view('indexAdmin',$menus);
    }

}
