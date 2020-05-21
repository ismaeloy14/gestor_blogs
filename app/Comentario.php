<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public static function eliminarComentariosIDNoticia($idNoticia) {
        DB::table('comentarios')->where('idNoticia', $idNoticia)->delete();
    }
}
