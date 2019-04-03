<?php

namespace App\Models;
use App\User;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    //
    protected $table='tbl_tematicas';
    public $primaryKey='pk_id_tema';
    public $incrementing=false;

    public function setId(){
        $this->pk_id_tema=str_random(15);
    }


    public function setForo($value){
        $this->fk_id_foro=$value;
    }

    public function getForo(){
        $foro=Foro::find($this->fk_id_foro);
        return $foro;
    }
    public function getId(){
        return $this->pk_id_tema;
    }

    public function setTitulo($value){
        $this->titulo=$value;
    }
    public function getTitulo(){
        return $this->titulo;
    }

    public function setCreador($value){
        $this->id_creador=$value;
    }

    public function getCreador(){
        $user=User::find($this->id_creador);
        return $user;
    }

    public function getRespuestas(){
        $resp=Respuesta::where('fk_id_tema','=',$this->pk_id_tema)->get();

        return $resp;
    }

    public function setDesc($value){
        $this->body=$value;
    }
    public function getDesc(){
        return $this->body;
    }
    public function setFecha(){
        $carbon=new Carbon();
        $this->fecha=$carbon->now();
    }
    public function getFecha(){

       return  $this->fecha;
    }

    public function getEstado(){

        if($this->cerrado==false){
            return "Abierto";
        }
        else{
            return 'Cerrado';
        }
    }
    public function setEstado($value){
        $this->cerrado=$value;
    }

}

