<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DetalleProyectoInvestigacion extends Model
{
    protected $table='tbl_detalle_proyectos_investigacion';
    public $primaryKey='pk_codigo_detalle';
    public $timestamps=false;
    public $incrementing=false;

    public function setIcono($id)
    {
        $icono=Icono::where("rt_icono",'=',$id)->first();
        $this->fk_codigo_icono=$icono->getId();
    }
    public function getIcono(){
        $icono=Icono::find($this->fk_codigo_icono);
        return $icono;
    }

    public function setColor($id)
    {
        $this->fk_codigo_color=$id;
    }
    public function getColor(){
        $color=Color::find($this->fk_codigo_color);
        return $color;
    }

    public function setFechaInicio( $fecha){
        $fecha=Carbon::createFromFormat('d-m-Y',$fecha);
        $fecha=$fecha->format('Y-m-d');
        $this->rf_fecha_inicio=$fecha;
    }
    public function getFechaInicio(){
        $fecha=$this->rf_fecha_inicio;
        $fecha=Carbon::createFromFormat('Y-m-d',$fecha);
        $fecha=$fecha->format('d-m-Y');
        return $fecha;
    }

    public function setFechaFin($fecha){
        $fecha=Carbon::createFromFormat('d-m-Y',$fecha);
        $fecha=$fecha->format('Y-m-d');
        $this->rf_fecha_fin=$fecha;
    }

    public function getFechaFin(){
        $fecha=$this->rf_fecha_fin;
        $fecha=Carbon::createFromFormat('Y-m-d',$fecha);
        $fecha=$fecha->format('d-m-Y');
        return $fecha;
    }

    public function setMonto($monto){
        $this->rn_monto=$monto;
    }
    public function getMonto(){
        return $this->rn_monto;
    }
    public function getFF(){
        return $this->fk_id_fuente;
    }
}
