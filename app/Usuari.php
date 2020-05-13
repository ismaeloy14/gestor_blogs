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

    public function todasPasswUsuarios() {
        return DB::table('users')->select('password')->get();
    }

    public function todosEmailUsuarios() {
        return DB::table('users')->select('email')->get();
    }
}
