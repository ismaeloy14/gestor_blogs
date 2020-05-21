<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    protected $table = 'blogs';


    public function todosBlogs(){
        return DB::table('blogs')->get();
    }

    public function blogNombre($tituloBlog){
        return DB::table('blogs')->where('tituloBlog', $tituloBlog)->get();
    }

    public function blogIDUsuario($id) {
        $consulta = DB::table('blogs')->where('idUsuario', $id)->first();

        if ($consulta == null){
            return null;
        } else {
            return $consulta;
        }

    }
}
