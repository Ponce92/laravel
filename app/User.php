<?php

namespace App;

use App\Models\Estado;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Tests\Writer\BackupDumper;

class User extends Authenticatable
{
    use Notifiable;
    protected $table='tbl_usuarios';
    protected $primaryKey='pk_id_usuario';

    public $timestamps=false;
    public $incrementing=false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //'nombre_usuario','clave_usuario',
        //'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /*
     * Experimental...
     */
    public function publicaciones()
    {
        return $this->hasMany('App\Models\Publicacion','fk_id_usuario');
    }

    public function librosPublicados()
    {
        return $this->hasMany('App\Models\LibrosPublicaciones','fk_id_usuario');
    }

    public function getCorreo(){
        return $this->email;
    }
    public function getEstado(){
        return Estado::find($this->fk_id_estado);
    }
    public function getId(){
     return $this->pk_id_usuario;
    }
    public function getFoto(){
        return $this->rt_foto_usuario;
    }
}
