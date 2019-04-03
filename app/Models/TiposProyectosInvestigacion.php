<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposProyectosInvestigacion extends Model
{
    protected $table='tbl_tipos_proyectos_investigacion';

    public $primaryKey='pk_id_tipo_proyecto';
    public $timestamps=false;

    public function getId(){
        return $this->pk_id_tipo_proyecto;
    }

    public function getDescripcion(){
        return $this->rd_descripcion;
    }
}
