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

    public function unaCategoria($nombreCategoria)
    {
        return DB::table('categorias')->where('categoria', $nombreCategoria)->first();
    }

    public function updateCategoria($nombreCategoria, $nuevoNombreCategoria) {
        DB::table('categorias')->where('categoria', $nombreCategoria)->update(['categoria' => $nuevoNombreCategoria]);
    }

    public function deleteCategoria($nombreCategoria)
    {
        DB::table('categorias')->where('categoria', $nombreCategoria)->delete();
    }
}
