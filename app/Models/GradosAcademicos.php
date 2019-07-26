<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradosAcademicos extends Model
{
    protected $table='tbl_grados_academicos';
    protected $primaryKey='pk_id_grado';
    public $timestamps=false;

    public function getId(){
        return $this->pk_id_grado;
    }
    public function setId($id){
        $this->pk_id_grado=$id;
    }

    public function getNombre(){
        return $this->rt_nombre_grado;
    }
    public function setNombre($nom){
        $this->rt_nombre_grado=$nom;
    }

    public function getEstado(){
        return $this->rl_estado;
    }

    public function setEstado($est){
        $this->rl_estado=$est;
    }

}
