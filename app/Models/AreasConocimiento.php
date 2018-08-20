<?php
/**
 * Created by PhpStorm.
 * User: ponce
 * Date: 08-19-18
 * Time: 09:32 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AreasConocimiento extends Model
{
    protected $table='areas_conocimiento';
    protected $primaryKey='id_area';
    public $timestamps=false;

}