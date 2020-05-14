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
}
