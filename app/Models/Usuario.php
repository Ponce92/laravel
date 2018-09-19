<?php


namespace App\Models;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use Notifiable;
    protected $table='tbl_usuarios';
    protected $primaryKey='pk_id_usuario';
    public $timestamps=fasle;
    public $incrementing=false;


}