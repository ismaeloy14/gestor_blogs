<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Symfony\Component\Console\Input\Input;
use App\User;
use App\Usuari;
use App\Rol;
use App\Blog;
use Auth;
use Image;



class AuthController extends Controller
{
    public function index_login()
    {
        if (session()->get('idUsuario') == null) {
            return view('auth.login');
        } else {
            return back();
        }
        
    }

    public function index_registro()
    {
        if (session()->get('idUsuario') == null) {
            return view('auth.registro');
        } else {
            return back();
        }
    }

    public function index_logout()
    {
        Auth::logout();
        session()->forget('rol');
        session()->forget('usuario');
        session()->forget('idUsuario');
        session()->forget('imagenPerfil');
        session()->forget('blog');
        
        return redirect('/');
    }

    public function index_politicaPrivacidad()
    {
        return view('leyes.politicaDePrivacidad');
    }

    public function index_crudUsuarios(){
        /*$users = new Usuari;
        $blogs = new Blog;
        $usuarios_sql = $users->todosUsuarios();
        $blog_sql = $blogs->todosBlogs();

        if(session()->get('rol') == 'admin') {
            return view('admin.crudUsuarios', compact('usuarios_sql', 'blog_sql'));
            //return view('admin.crudUsuarios', array('usuarios' => $usuarios_sql), array('blogs' => $blog_sql));
        } else {
            //return redirect('/');
            return back();
        }*/

        
        $users = Usuari::all();
        $blogs = Blog::all();

        if(session()->get('rol') == 'admin') {
            return view('admin.crudUsuarios', compact('users', 'blogs'));
        } else {
            //return redirect('/');
            return back();
        }

    }

    /////// ESTO ES AJAX DE YAJRA \\\\\\\

    /*public function ajax_index_crudUsuarios() {
        //echo 'hola';
        return datatables()
            ->eloquent(App\User::query())
            ->toJson();

    }*/


    public function post_login_usuario(Request $request)
    {
        $usuario = new Usuari;
        $conexionBlog = new Blog;

        $existeUsuario = $usuario->comprobarNombreUsuario($request->input('usuario'));
        $id_usuario = $usuario->soloUnUsuario($request->input('usuario'));

        $id_usuer; // Aqui guardara la id del usuario
        $imagenPerfil; // Aqui se guardara el nombre del fichero para la imagen del perfil

        $this->validate($request, [
            'usuario' => 'required',
            'password' => 'required'
        ]);
        
        

        if ($existeUsuario != null) {

            $array_datos_usuarios = array(
                'usuario' => $request->input('usuario'),
                'password' => $request->input('password')
            );

            foreach($id_usuario as $id) {
                $id_user = $id->id;
                $imagenPerfil = $id->imagenPerfil;
            }


            if (Auth::attempt($array_datos_usuarios)) {
                $rolUsuario = $usuario->comprobarRol($request->input('usuario'));
                $blog = $conexionBlog->blogIDUsuario($id_user);

                session()->put('rol', $rolUsuario);
                session()->put('usuario', $request->input('usuario'));
                session()->put('idUsuario', $id_user);
                session()->put('imagenPerfil', $imagenPerfil);

                if ($blog == null) {
                    session()->put('blog', null);
                } else {
                    session()->put('blog', $blog->tituloBlog);
                }


                return redirect('/');

            } else {
                return back()->withErrors(['Nombre de usuario incorrecto o contraseña incorrecta']);
            }

        } else {
            return back()->withErrors(['Nombre de usuario incorrecto o contraseña incorrecta']);
        }


    }



}
