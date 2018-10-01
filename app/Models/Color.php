<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected  $table="tbl_colores";

    public $primaryKey="pk_id_color";
    public $timestamps=false;
    public $incrementing=false;
}
