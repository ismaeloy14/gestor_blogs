<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categoria extends Model
{
    protected $table = 'categorias';
    public $timestamps = false;


    public function todasCategorias(){
        return DB::table('categorias')->get();
    }
}
