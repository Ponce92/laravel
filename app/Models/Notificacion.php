<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table='tbl_notificaciones';
    public $incrementing=false;
    public $timestamps=false;
    public $primaryKey='pk_id_notificacion';
}
