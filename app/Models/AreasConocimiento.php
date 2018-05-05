<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreasConocimiento extends Model
{
    protected $table='areas_interes';
    protected $primaryKey='id_area';
    public $timestamps=false;

    public function getAreasConocimiento(){

        $areasInteres=AreasConocimiento::All();

        return $areasInteres;
    }
}
