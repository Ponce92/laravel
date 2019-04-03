<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-16-18
 * Time: 09:09 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table='tbl_publicaciones';
    protected $primaryKey='pk_id_publicacion';
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
