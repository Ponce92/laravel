<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table='tbl_estados';
    public $primaryKey='pk_id_estado';


    public function getNombre(){
        return $this->rt_nombre_estado;
    }
    public function getId(){
        return $this->pk_id_estado;
    }
}