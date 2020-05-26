<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Valoracion extends Model
{
    protected $table = 'valoraciones';
    public $timestamps = false;

    public static function eliminarValoracionesIDNoticia($idNoticia) {
        $consulta = DB::table('valoraciones')->where('idNoticia', $idNoticia)->delete();

        if ($consulta == null) {
            return null;
        } else {
            return $consulta;
        }
    }

    public static function totalValoracionNoticiaFirst($idNoticia) {
        return DB::table('valoraciones')->where('idNoticia', $idNoticia)->first();
    }
}
