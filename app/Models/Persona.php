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
    protected $table='personas';
    protected $primaryKey='id_persona';
    public $timestamps=false;

    public $incrementing=false;
}