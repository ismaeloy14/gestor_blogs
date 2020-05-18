<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Noticia extends Model
{
    protected $table = 'noticias';
    public $timestamps = false;


    public function noticiaIDblog($idBlog){
        return DB::table('noticias')->where('idBlog', $idBlog)->get();
    }








}
