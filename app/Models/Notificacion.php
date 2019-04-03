<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\user;
use App\Models\ProyectosInvestigacion;

class Notificacion extends Model
{
    protected $table='tbl_notificaciones';
    public $incrementing=false;
    public $timestamps=false;
    public $primaryKey='pk_id_notificacion';

    public function setId($val){
        $this->pk_id_notificacion=$val;
    }
    public  function getId(){
        return $this->pk_id_notificacion;
    }
    public function setVista($val){
        $this->rl_vista=$val;

    }
    public function getVista(){
        return $this->rl_vista;
    }

    public function getUsuario(){
        $usr=User::find($this->fk_id_usuario);
        return $usr;
    }
    public function setUsuario($val){
        $this->fk_id_usuario=$val;
    }

    public function getRemitente(){
        $remitente=User::find($this->fk_id_usuario_remitente);

        return $remitente;
    }
    public function setRemitente($val){
        $this->fk_id_usuario_remitente=$val;
    }

    public function getTipo(){
        return $this->rt_tipo_notificacion;
    }

    public function setTipo($val){
        $this->rt_tipo_notificacion=$val;
    }

    public function getFecha(){

    }

    public function setFecha($fecha){
        $this->rf_fecha_creacion=$fecha->format('Y-m-d');
    }

    public function getProyecto(){
        $pro=ProyectosInvestigacion::find($this->rt_codigo_proyecto);
        return $pro;
    }

    public function setProyecto($id){
        $this->rt_codigo_proyecto=$id;
    }


}
