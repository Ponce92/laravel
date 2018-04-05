<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menus';
    protected $primaryKey='id_menu';
    public $timestamps=false;

    public Static function getMenus(){
    $menus=Menu::where("id_menu_padre",'=',0)->get();
    $subMenus=Menu::where('id_menu_padre','!=',0)->get();

    $data['menus']=$menus;
    $data['subMenus']=$subMenus;

    return $data;
    }
}
