<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleProyectoInvestigacion extends Model
{
    protected $table='tbl_detalle_proyectos_investigacion';
    public $primaryKey='pk_codigo_detalle';
    public $timestamps=false;
    public $incrementing=false;
}
