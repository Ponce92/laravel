<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table='tbl_paises';
    protected $primaryKey='pk_id_pais';
    public $timestamps=false;

}
