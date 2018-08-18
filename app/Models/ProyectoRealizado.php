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
    protected $table='proyectos_realizados';
    protected $primaryKey='id_proyecto_realizado';
    public $timestamps=false;


}