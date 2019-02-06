<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RedInvestigadores extends Model
{
    protected $table='tbl_redes_investigadores';
    public $primaryKey='pk_id_red';
    public $timestamps=false;
    public $incrementing=false;

    public function getNombre()
    {
        return $this->rt_nombre_red;
    }

    public function getIcono(){
        $icono=Icono::findOrFail($this->fk_codigo_icono);
        return $icono;
    }
}
