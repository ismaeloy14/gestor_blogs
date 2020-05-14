<?php

use Illuminate\Database\Seeder;
use App\Rol;
use App\User;
use App\Categoria;
use App\Blog;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        self::seedRoles();
        self::seedUsers();
        self::seedCategorias();
        self::seedBlogs();
    }

    private function seedRoles(){
        DB::table('roles')->delete();
        foreach($this->arrayRoles as $roles){
            $r = new Rol;
            $r->rol = $roles['rol'];
            $r->save();
        }
    }

    private function seedUsers(){
        DB::table('users')->delete();
        foreach($this->arrayUsers as $users){
            $u = new User;
            $u->usuario = $users['usuario'];
            $u->email = $users['email'];
            $u->password = bcrypt($users['password']);
            $u->nombre = $users['nombre'];
            $u->apellidos = $users['apellidos'];
            $u->rol = $users['rol'];
            $u->save();
        }

    }

    private function seedCategorias(){
        DB::table('categorias')->delete();
        foreach($this->arrayCategorias as $categorias) {
            $c = new Categoria;
            $c->categoria = $categorias['categoria'];
            $c->save();
        }
    }

    private function seedBlogs(){
        DB::table('blogs')->delete();
        foreach($this->arrayBlogs as $blogs){
            $b = new Blog;
            $b->tituloBlog = $blogs['tituloBlog'];
            $b->idUsuario = $blogs['idUsuario'];
            $b->blogPublico = $blogs['blogPublico'];
            $b->categoria = $blogs['categoria'];
            $b->save();
        }
    }


    //// Variables para rellenar la BBDD ////


    private $arrayRoles = array(
        array(
            'rol'   =>  'admin'
        ),
        array(
            'rol'   =>  'basico'
        )
    );

    private $arrayUsers = array (
        array(
            'usuario'    =>  'admin',
            'email'     =>  'admin@gmail.com',
            'password'          =>  'admin',
            'nombre'            =>  'user_admin',
            'apellidos'         =>  'superadmin',
            'rol'               =>  'admin'
        ),
        array(
            'usuario'    =>  'user1',
            'email'     =>  'user1@gmail.com',
            'password'          =>  'user1',
            'nombre'            =>  'user_user1',
            'apellidos'         =>  'user1 user1',
            'rol'               =>  'basico'
        )
    );

    private $arrayCategorias = array(
        array(
            'categoria' =>  'Tecnologia'
        ),
        array(
            'categoria' =>  'Moda'
        ),
        array(
            'categoria' =>  'Arqueologia'
        )
    );

    private $arrayBlogs = array(
        array(
            'tituloBlog'   =>  'Blog1',
            'idUsuario'    =>  1,
            'blogPublico'  =>  1,
            'categoria'     =>  'Tecnologia'
        )
    );

}
