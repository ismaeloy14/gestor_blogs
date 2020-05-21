<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Noticia extends Model
{
    protected $table = 'noticias';
    public $timestamps = false;


    public function noticiaIDblog($idBlog){ // Con ordenacion descendiente
        return DB::table('noticias')->where('idBlog', $idBlog)->orderBy('fechaNoticia', 'desc')->get();
    }

    public function noticiaIDblogNormal($idBlog){ // Con ordenacion descendiente
        DB::table('noticias')->where('idBlog', $idBlog)->get();
    }

    public function soloUnaNoticia($idBlog, $tituloNoticia){
        return DB::table('noticias')->where('idBlog', $idBlog)->where('tituloNoticia', $tituloNoticia)->get();
    }






}
