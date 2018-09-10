<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-16-18
 * Time: 09:09 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='tbl_usuarios';
    protected $primaryKey='pk_id_usuario';
    public $timestamps=false;


}