<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificacion extends Model
{
    protected $table = 'notificaciones';
    public $timestamps = false;

    public static function eliminarNotificacionesIDUsuario($idUsuario) {
        DB::table('notificaciones')->where('idUsuario', $idUsuario)->delete();
    }
}
