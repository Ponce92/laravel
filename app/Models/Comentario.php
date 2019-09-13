<?php

namespace App\Models;
use Carbon\Carbon;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected  $table="tbl_comentarios";

    public $primaryKey="pk_id_comentario";
    public $timestamps=false;
    public $incrementing=false;

    public function getId(){
        return $this->pk_id_comentaio;
    }
    public function setValor($valor){
        $this->rt_body=$valor;
    }
    public function getValor(){
        return $this->rt_body;
    }

    public function setRespuesta($res){
        $this->fk_id_respuesta=$res;
    }
    public function setUser($valor){
        $this->id_usuario=$valor;
    }

    public function getUser(){
        $user=User::findOrFail($this->id_usuario);
        return $user;
    }

    public function setFecha(){
        //$carbon=new Carbon();
        $this->fecha=Carbon::now();
    }
    public function getFecha(){
       return $this->fecha;
    }
}
