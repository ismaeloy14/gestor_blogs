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

    public function noticiaIDblogNormal($idBlog){ // Con ordenacion ascendiente
        return DB::table('noticias')->where('idBlog', $idBlog)->get();
    }

    public function getNoticiaPorIDFirst($idNoticia)
    {
        return DB::table('noticias')->where('id', $idNoticia)->first();
    }

    public function soloUnaNoticia($idBlog, $tituloNoticia){ // Para el showNoticia (me devuelve 1 noticia)
        return DB::table('noticias')->where('idBlog', $idBlog)->where('tituloNoticia', $tituloNoticia)->first();
    }

    public function ultimaNoticiaIDFirst(){
        return DB::table('noticias')->orderBy('id', 'desc')->first();
    }

}
