<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class ProyectosInvestigacion extends Model
{
    protected $table='tbl_proyectos_investigacion';

    public $primaryKey="pk_id_proyecto_investigacion";
    public $incrementing=false;
    public $timestamps=false;

    public function getArea(){
       $area=AreasConocimiento::find($this->fk_id_area);
        return $area;
    }

    public function icono(){
        return $this->hasOne('App\Models\Icono','pk_codigo_icono','fk_codigo_icono');
    }

    public function getId(){
        return $this->pk_id_proyecto_investigacion;
    }

    public static  function getDetalle($id){

        $detalle=DetalleProyectoInvestigacion::find($id);

        return $detalle;
    }

    public function setId($codigo){
        $this->pk_id_proyecto_investigacion=$codigo;
    }

    public function getEstado(){
        $estado=EstadoProyectoInvestigacion::find($this->fk_id_estado);
        return $estado;
    }

    public function setEstado($idEstado){
        $this->fk_id_estado=$idEstado;
    }

    public function getTitular(){
        $titular=User::find($this->fk_id_titular);

        return $titular;
    }

    public function getObjetivo(){

        $objetivo=ObjetivoSocioeconomico::find($this->fk_codigo_objetivo_socioeconomico);

        return $objetivo;
    }

    public function setObjetivo($idObjetivo){
        $this->fk_codigo_objetivo_socioeconomico=$idObjetivo;
    }

    public function getDescripcion(){
        return $this->rd_descripcion_proyecto;
    }

    public function setDecripcion($desc){
        $this->rd_descripcion_proyecto=$desc;
    }

    public function setTitulo($titulo){
        $this->rt_titulo_proyecto=$titulo;
    }

    public function getTitulo(){
        return $this->rt_titulo_proyecto;
    }

    public function getAcronimo(){
        return $this->rt_acronimo_proyecto;
    }

    public function setAcronimo($acronimo){
        $this->rt_acronimo_proyecto=$acronimo;
    }


    public function getIsRiues(){
        return $this->rl_is_aprovado;
    }

    public function setIsRiues($valor){
        $this->rl_is_aprovado=$valor;
    }

    public function getTipo(){
        $tipo=TiposProyectosInvestigacion::find($this->fk_id_tipo_proyecto);
        return $tipo;
    }
    public function setTipo($idTipo){
        $this->fk_id_tipo_proyecto=$idTipo;
    }

    public function setArea($id){
        $this->fk_id_area=$id;
    }
    public function getDetalleProyecto(){
        $detalle=DetalleProyectoInvestigacion::where('fk_codigo_proyecto','=',$this->getId())->first();

        return $detalle;
    }

}
