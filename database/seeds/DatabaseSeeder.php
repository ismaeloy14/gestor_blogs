<?php

use Illuminate\Database\Seeder;
use App\Rol;
use App\User;
use App\Categoria;
use App\Blog;
use App\Noticia;


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
        self::seedNoticias();
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
            $u->fechaNacimiento = $users['fechaNacimiento'];
            $u->imagenPerfil = $users['imagenPerfil'];
            $u->twitter = $users['twitter'];
            $u->facebook = $users['facebook'];
            $u->instagram = $users['instagram'];
            $u->paginaWeb = $users['paginaWeb'];
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
            $b->imagenBlog = $blogs['imagenBlog'];
            $b->save();
        }
    }

    private function seedNoticias(){
        DB::table('noticias')->delete();
        foreach($this->arrayNoticias as $noticias){
            $n = new Noticia;
            $n->tituloNoticia = $noticias['tituloNoticia'];
            $n->cuerpoNoticia = $noticias['cuerpoNoticia'];
            $n->fechaNoticia = $noticias['fechaNoticia'];
            $n->idBlog = $noticias['idBlog'];
            $n->noticiaPublica = $noticias['noticiaPublica'];
            $n->save();
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
            'fechaNacimiento'   =>  '1998-01-01',
            'imagenPerfil'      =>  'yo-ornn-grande.png',
            'twitter'           =>  'https://twitter.com/Ismaeloy14',
            'facebook'          =>  'https://www.facebook.com/prototype.angulo',
            'instagram'         =>  'https://www.instagram.com/ismaeloy14/?hl=es',
            'paginaWeb'         =>  'https://www.youtube.com/user/Ismaeloy',
            'rol'               =>  'admin'
        ),
        array(
            'usuario'    =>  'user1',
            'email'     =>  'user1@gmail.com',
            'password'          =>  'user1',
            'nombre'            =>  'user_user1',
            'apellidos'         =>  'user1 user1',
            'fechaNacimiento'   =>  '1998-05-14',
            'imagenPerfil'      =>  'perfil_defecto.png',
            'twitter'           =>  null,
            'facebook'          =>  null,
            'instagram'         =>  null,
            'paginaWeb'         =>  null,
            'rol'               =>  'basico'
        ),
        array(
            'usuario'    =>  'user2',
            'email'     =>  'user2@gmail.com',
            'password'          =>  'user2',
            'nombre'            =>  'user_user2',
            'apellidos'         =>  'user2 user2',
            'fechaNacimiento'   =>  '1998-05-14',
            'imagenPerfil'      =>  'perfil_defecto.png',
            'twitter'           =>  null,
            'facebook'          =>  null,
            'instagram'         =>  null,
            'paginaWeb'         =>  null,
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
            'categoria'    =>  'Tecnologia',
            'imagenBlog'   =>  'imagen_blog_defecto.jpg'
        ),
        array(
            'tituloBlog'   =>  'Blog3',
            'idUsuario'    =>  3,
            'blogPublico'  =>  1,
            'categoria'    =>  'Tecnologia',
            'imagenBlog'   =>  'imagen_blog_defecto.jpg'
        )
    );

    private $arrayNoticias = array(
        array(
            'tituloNoticia'     =>  'Noticia1',
            'cuerpoNoticia'     =>  'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi fringilla aliquam turpis. Nullam odio erat, sollicitudin eget orci quis, dapibus suscipit libero. Donec volutpat magna quis ipsum porta porta. Sed nulla velit, iaculis at imperdiet sit amet, sagittis a magna. Integer malesuada lectus sed nisl fringilla, ut porta erat eleifend. In blandit malesuada aliquet. Nunc eget mi urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam elementum eget sapien mattis sollicitudin. Aliquam commodo nunc sapien, sed feugiat mi elementum et. Praesent laoreet quam urna, at auctor sapien eleifend et. Aenean elit nulla, lacinia nec diam eget, dignissim lacinia urna. Vivamus dolor magna, porta a eleifend sed, iaculis sed neque.',
            'fechaNoticia'      =>  '2020-02-25',
            'idBlog'            =>  1,
            'noticiaPublica'    =>  1
        ),
        array(
            'tituloNoticia'     =>  'Noticia2',
            'cuerpoNoticia'     =>  'Noticia de marzo.',
            'fechaNoticia'      =>  '2020-03-08',
            'idBlog'            =>  1,
            'noticiaPublica'    =>  0
        ),
        array(
            'tituloNoticia'     =>  'Noticia3',
            'cuerpoNoticia'     =>  'Noticia de abril.',
            'fechaNoticia'      =>  '2020-04-18',
            'idBlog'            =>  1,
            'noticiaPublica'    =>  1
        ),
        array(
            'tituloNoticia'     =>  'Noticia4',
            'cuerpoNoticia'     =>  'Noticia de mayo.',
            'fechaNoticia'      =>  '2020-05-01',
            'idBlog'            =>  1,
            'noticiaPublica'    =>  1
        ),
        array(// Noticias del usuario user2
            'tituloNoticia'     =>  'Noticia1',
            'cuerpoNoticia'     =>  'Noticia de mayo 1.',
            'fechaNoticia'      =>  '2020-05-01',
            'idBlog'            =>  2,
            'noticiaPublica'    =>  1
        ),
        array(
            'tituloNoticia'     =>  'Noticia2',
            'cuerpoNoticia'     =>  'Noticia de mayo 2.',
            'fechaNoticia'      =>  '2020-05-02',
            'idBlog'            =>  2,
            'noticiaPublica'    =>  1
        ),
        array(
            'tituloNoticia'     =>  'Noticia3',
            'cuerpoNoticia'     =>  'Noticia de mayo 3.',
            'fechaNoticia'      =>  '2020-05-08',
            'idBlog'            =>  2,
            'noticiaPublica'    =>  1
        )
    );

}
