<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected  $table="tbl_colores";

    public $primaryKey="pk_id_color";
    public $timestamps=false;
    public $incrementing=false;

    public static function getValorColor($id){
        $col=Color::findOrFail($id);

        return $col->rt_valor;
    }

    public function getId(){
        return $this->pk_id_color;
    }
    public function getNombre(){
        return $this->rt_nombre;
    }

    public function getValor(){
        return $this->rt_valor;
    }
}
