<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Respuesta extends Model
{
    //
    protected $table='tbl_respuestas';
    public $primaryKey='pk_id_respuesta';
    public $incrementing=false;

    public  function getUser(){
        $user=User::findOrFail($this->id_usuario);
        return $user;
    }
    public function setUser($value){
        $this->id_usuario=$value;
    }
    public function getId(){
        return $this->pk_id_respuesta;
    }
    public function setId($value){
        $this->pk_id_respuesta=$value;
    }
    public function getDesc(){
        return $this->body;
    }
    public function setDesc($valor){
        $this->body=$valor;
    }

    public function getTema(){
        $tematica=Tematica::findOrFail($this->fk_id_tema);

        return $tematica;
    }

    public function setTema($value){
        $this->fk_id_tema=$value;
    }

    public function setFecha(){
        $carbon=new Carbon();
        $this->fecha=$carbon->now();
    }
    public function getFecha(){

       return $this->created_at;
    }

    public function getComentarios(){
        $comm=Comentario::where('fk_id_respuesta','=',$this->getId())->get();
        return $comm;
    }

}
