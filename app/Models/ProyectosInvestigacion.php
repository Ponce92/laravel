<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectosInvestigacion extends Model
{
    protected $table='tbl_proyectos_investigacion';

    public $primaryKey="pk_id_proyecto_investigacion";
    public $incrementing=false;
    public $timestamps=false;

    public function icono(){
        return $this->hasOne('App\Models\Icono','pk_codigo_icono','fk_codigo_icono');
    }
}
