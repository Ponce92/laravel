<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-16-18
 * Time: 09:08 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProyectoRealizado extends Model
{
    protected $table='tbl_proyectos_realizados';
    protected $primaryKey='pk_id_proyecto';
    public $timestamps=false;

    public  function area(){
        return $this->hasOne('App\Models\AreasConocimiento','pk_id_area')->first();
    }

    public function getArea()
    {
        $area=AreasConocimiento::find($this->fk_id_area);
        return $area;
    }
}
