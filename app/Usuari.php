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

    public function soloUnUsuario($usuario){ // Me devuelve 1 usuario si le paso un nombre de usuario
        return DB::table('users')->where('usuario', $usuario)->get();
    }

    public function soloUnUsuarioFirst($usuario){ // Me devuelve 1 usuario si le paso un nombre de usuario
        return DB::table('users')->where('usuario', $usuario)->first();
    }

    public function soloUnUsuarioID($id) { // Me devuelve los usuarios si le paso una ID
        return DB::table('users')->where('id', $id)->get();
    }

    public function soloUnUsuarioIDFirst($id) { // Me devuelve 1 usuario si le paso una ID
        return DB::table('users')->where('id', $id)->first();
    }


    public function comprobarNombreUsuario($usuario) { // Comprueba si el nombre de usuario existe y si no existe me devuelve null
        $consulta = DB::table('users')->select('usuario')->where('usuario', $usuario)->first();

        if ($consulta == null){
            return null;
        } else {
            return $consulta->usuario;        
        }

    }

    public function comprobarRol($usuario) { // Me devuelve el rol del usuario que le haya pasado
        $consulta = DB::table('users')->select('rol')->where('usuario', $usuario)->first();

        return $consulta->rol;
    }

    public function todosEmailUsuarios() { // Me devuelve todos los emails pero solo la columna de email
        return DB::table('users')->select('email')->get();
    }

    public function soloUnEmailFirst($email) // Me devuelve un true o false
    {
        return DB::table('users')->where('email', $email)->first();
    }
}
