<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedInvestigadores extends Model
{
    protected $table='tbl_redes_investigadores';
    public $primaryKey='pk_id_red';
    public $timestamps=false;
    public $incrementing=false;
}
