<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

    protected  $table="tbl_contactos";

    public $primaryKey="pk_codigo";
    public $timestamps=false;
    public $incrementing=false;

    public function getId(){
        return $this->pk_codigo;
    }
    public function setId($val){
        $this->pk_codigo=$val;
    }

    public function getUsuario1(){
        return $this->fk_codigo_usuario1;
    }
    public function setUsuario1($val){
        $this->fk_codigo_usuario1=$val;
    }
    public function getUsuario2(){
        return $this->fk_codigo_usuario2;
    }
    public function setUsuario2($val){
        $this->fk_codigo_usuario2=$val;
    }
}