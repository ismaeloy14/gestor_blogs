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
        $consulta = DB::table('comentarios')->where('idNoticia', $idNoticia)->delete();

        if ($consulta == null) {
            return null;
        } else {
            return $consulta;
        }
    }

    public static function eliminarComentariosIDUsuario($idUsuario) {
        $consulta = DB::table('comentarios')->where('idUsuario', $idUsuario)->delete();

        if ($consulta == null) {
            return null;
        } else {
            return $consulta;
        }
    }
}
