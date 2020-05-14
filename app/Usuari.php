<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuari extends Model
{
    protected $table = 'users';

    public function todosNombresUsuarios() {
        return DB::table('users')->select('usuario')->get();
    }

    public function todosUsuarios(){
        return DB::table('users')->get();
    } 

    public function comprobarNombreUsuario($nombre) {
        $consulta = DB::table('users')->select('usuario')->where('usuario', $nombre)->first();

        if ($consulta == null){
            return null;
        } else {
            return $consulta->usuario;        
        }

    }

    public function comprobarRol($nombre) {
        $consulta = DB::table('users')->select('rol')->where('usuario', $nombre)->first();

        return $consulta->rol;
    }

    /*public function todasPasswUsuarios() {
        return DB::table('users')->select('password')->get();
    }*/

    public function todosEmailUsuarios() {
        return DB::table('users')->select('email')->get();
    }
}
