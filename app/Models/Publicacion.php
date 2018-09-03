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


}