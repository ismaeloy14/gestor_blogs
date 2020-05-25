<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public static function todosComentariosNoticia($idNoticia)
    {
        return DB::table('comentarios')->where('idNoticia', $idNoticia)->get();
    }

    public static function eliminarComentariosIDNoticia($idNoticia) {
        return DB::table('comentarios')->where('idNoticia', $idNoticia)->delete();
    }
}
