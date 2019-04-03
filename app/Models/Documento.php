<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 11-28-18
 * Time: 09:01 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='tbl_documentos';
    protected $primaryKey='pk_id';
    public $timestamps=false;

    public function getId(){
        return $this->pk_id;
    }

    public function getNombre(){
        return $this->rt_nombre;
    }
    public function setNombre($valor){
        $this->rt_nombre=$valor;
    }

    public function setProyecto($id){
        $this->fk_id_proyecto=$id;
    }
    public function getExtension(){
        return $this->rt_extension;
    }

    public function setExtension($txt){
        $this->rt_extension=$txt;
    }

    public function getUrl(){
        return $this->getId().'.'.$this->getExtension();
    }

    public function getTipoArchivo(){
        $tipo="none";
        if($this->getExtension()=="png" || $this->getExtension()=="jpg" ){
        $tipo='img';
        }

        if($this->getExtension()=="xls" || $this->getExtension()=="xlsx"|| $this->getExtension()=="ods" ){
            $tipo='excel';
        }

        if($this->getExtension()=="doc" || $this->getExtension()=="docx"|| $this->getExtension()=="ott"){
            $tipo='word';
        }
        if($this->getExtension()=="pdf"){
            $tipo='pdf';
        }

        return $tipo;
    }
}