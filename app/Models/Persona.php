<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-16-18
 * Time: 09:08 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='tbl_personas';
    protected $primaryKey='pk_id_persona';
    public $timestamps=false;

    public $incrementing=false;


    public function pais(){
        return $this->belongsTo(Pais::class,'fk_id_pais','pk_id_pais');

    }

}