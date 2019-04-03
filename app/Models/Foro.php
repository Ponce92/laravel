<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    //
    protected $table='tbl_foros';
    public $primaryKey='pk_id_foro';
    public $timestamps=false;
    public $incrementing=false;


    public function getRed(){
        $red = RedInvestigadores::findOrFail($this->fk_id_red);
     return $red;
    }

    public function getProyecto(){
        $proyecto=ProyectosInvestigacion::findOrFail($this->fk_id_proyecto);
        return $proyecto;
    }

    public function getCodigo(){
        return $this->pk_id_foro;
    }

    public function getTematicas(){
        $tematicas=Tematica::where('fk_id_foro','=',$this->getCodigo())->get();
        return $tematicas;
    }
}
