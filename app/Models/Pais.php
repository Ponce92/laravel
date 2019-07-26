<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='tbl_paises';
    protected $primaryKey='pk_id_pais';
    public $timestamps=false;



    public function getNombre(){
        return $this->rt_nombre_pais;
    }
    public function setNombre($nombre){
        $this->rt_nombre_pais=$nombre;
    }

    public function getId(){
        return $this->pk_id_pais;
    }
    public function setId($id){
            $this->pk_id_pais=$id;
    }

    public function setEstado($est){
        $this->rl_estado=$est;
    }

    public function getEstado(){
        if($this->rl_estado){
            return "Activo";
        }
        return "Inactivo";
    }
}
