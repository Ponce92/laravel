<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-19-18
 * Time: 09:32 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FuentesFinanciamiento extends Model
{
    protected $table='tbl_financiamientos';
    protected $primaryKey='pk_id_fuente';
    public $timestamps=false;

    public function getId(){
        return $this->pk_id_fuente;
    }

    public function getNombre(){
        return $this->rt_nombre_fuente;
    }
}