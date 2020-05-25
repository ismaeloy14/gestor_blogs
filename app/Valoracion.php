<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Valoracion extends Model
{
    protected $table = 'valoraciones';

    public static function eliminarValoracionesIDNoticia($idNoticia) {
        return DB::table('valoraciones')->where('idNoticia', $idNoticia)->delete();
    }
}
