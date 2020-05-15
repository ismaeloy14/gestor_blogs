<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuari extends Model
{
    protected $table = 'users';

    public function todosNombresUsuarios() { // Me devuelve todos los usuarios pero solo la columna de usuarios
        return DB::table('users')->select('usuario')->get();
    }

    public function todosUsuarios(){ // Me devuelve todos los usuarios de la tabla
        return DB::table('users')->get();
    }

    public function soloUnUsuario($usuario){ // Me devuelve 1 usuario
        return DB::table('users')->where('usuario', $usuario)->get();
    }


    public function comprobarNombreUsuario($nombre) { // Comprueba si el nombre de usuario existe y si no existe me devuelve null
        $consulta = DB::table('users')->select('usuario')->where('usuario', $nombre)->first();

        if ($consulta == null){
            return null;
        } else {
            return $consulta->usuario;        
        }

    }

    public function comprobarRol($nombre) { // Me devuelve el rol del usuario que le haya pasado
        $consulta = DB::table('users')->select('rol')->where('usuario', $nombre)->first();

        return $consulta->rol;
    }

    /*public function todasPasswUsuarios() {
        return DB::table('users')->select('password')->get();
    }*/

    public function todosEmailUsuarios() { // Me devuelve todos los emails pero solo la columna de email
        return DB::table('users')->select('email')->get();
    }
}
