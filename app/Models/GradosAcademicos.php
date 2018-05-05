<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradosAcademicos extends Model
{
    protected $table='grados_academicos';
    protected $primaryKey='id_grado';
    public $timestamps=false;

    public function getGrados(){
        $grados=GradosAcademicos::all();

        return $grados;
    }
}
