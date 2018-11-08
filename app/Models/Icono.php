<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icono extends Model
{
    protected $table='tbl_iconos';
    public $primaryKey="pk_codigo_icono";
    public $incrementing=false;
    public $timestamps=false;

    public static function getValorIcono($id){
        $ico=Icono::findOrFail($id);

        return $ico->rt_icono;
    }
}
