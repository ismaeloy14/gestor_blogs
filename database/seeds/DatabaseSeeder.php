<?php

use Illuminate\Database\Seeder;
use App\Rol;
use App\User;


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
            $u->nombre_usuario = $users['nombre_usuario'];
            $u->email_usuario = $users['email_usuario'];
            $u->password = bcrypt($users['password']);
            $u->nombre = $users['nombre'];
            $u->apellidos = $users['apellidos'];
            $u->rol = $users['rol'];
            $u->save();
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
            'nombre_usuario'    =>  'admin',
            'email_usuario'     =>  'admin@gmail.com',
            'password'          =>  'admin',
            'nombre'            =>  'user_admin',
            'apellidos'         =>  'superadmin',
            'rol'               =>  'admin'
        ),
        array(
            'nombre_usuario'    =>  'user1',
            'email_usuario'     =>  'user1@gmail.com',
            'password'          =>  'user1',
            'nombre'            =>  'user_user1',
            'apellidos'         =>  'user1 user1',
            'rol'               =>  'basico'
        )
    );

}
