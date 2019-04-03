<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Mensaje extends Model
{
    protected $table='tbl_mensajes';
    public $primaryKey="pk_id";

    public function getTexto(){
        return $this->rt_mensaje;
    }

    public function getRemitente(){
        $user=User::findOrFail($this->fk_remitente);
        return $user;
    }
    public function getDestinatario(){
        $user=User::findOrFail($this->fk_destinatario);
        return $user;
    }
}
