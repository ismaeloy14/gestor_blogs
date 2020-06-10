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

    public function blogNombreFirst($tituloBlog){
        return DB::table('blogs')->where('tituloBlog', $tituloBlog)->first();
    }

    public function blogIDUsuario($id) {
        $consulta = DB::table('blogs')->where('idUsuario', $id)->first();

        if ($consulta == null){
            return null;
        } else {
            return $consulta;
        }

    }

    public function blogID($idBlog) {
        return DB::table('blogs')->where('id', $idBlog)->first();
    }

    public function blogUpdateToNoCategoria($categoriaOriginal) // Actualiza las categorias a son categoria
    {
        DB::table('blogs')->where('categoria', $categoriaOriginal)->update(['categoria' => 'Sin categoria']);
    }
}
