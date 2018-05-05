<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='paises';
    protected $primaryKey='id_pais';
    public $timestamps=false;

    public function getPaises(){
        $paises=Pais::all();

        return $paises;
    }

}
