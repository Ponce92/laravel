<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\User;
class Contacto extends Model
{

    protected  $table="tbl_contactos";

    public $primaryKey="pk_id";
    public $timestamps=false;

    public function getId(){
        return $this->pk_id;
    }

    public function getUsuario1(){
        return $this->fk_id_user1;
    }
    public function setUsuario1($val){
        $this->fk_id_user1=$val;
    }
    public function getUsuario2(){
        return $this->fk_id_user2;
    }
    public function setUsuario2($val){
        $this->fk_id_user2=$val;
    }

    public function getUser($id)
    {
        //Recibe como parametro el id del usuario logueado . . .
        if($id != $this->fk_id_user1){
            $user=User::findOrFail($this->fk_id_user1);
            return $user;
        }else{
            $user=User::findOrFail($this->fk_id_user2);
            return $user;
        }
    }

    public function getMensajes(){
        $mensajes=Mensaje::where('rt_codigo',$this->fk_id_user1.'_'.$this->fk_id_user2)
                            ->orWhere('rt_codigo',$this->fk_id_user2.'_'.$this->fk_id_user1)
                            ->get();
    }

}
