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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_login()
    {
        return view('auth.login');
    }

    public function index_registro()
    {
        return view('auth.registro');
    }

    public function index_logout()
    {
        Auth::logout();
        session()->forget('rol');
        session()->forget('usuario');
        session()->forget('idUsuario');
        session()->forget('imagenPerfil');
        
        return redirect('/');
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
            return redirect('/');
        }*/

        
        $users = Usuari::all();
        $blogs = Blog::all();

        if(session()->get('rol') == 'admin') {
            return view('admin.crudUsuarios', compact('users', 'blogs'));
        } else {
            return redirect('/');
        }


        //return view('admin.crudUsuarios');

    }

    /*public function ajax_index_crudUsuarios() {
        //echo 'hola';
        return datatables()
            ->eloquent(App\User::query())
            ->toJson();

    }*/




    // Esta funcion es del registro de usuarios
    public function post_create_usuario(Request $request)
    {
        //$usuario = new User;

        if ($request->input('password') === $request->input('password2')){

            $usuario = new Usuari;
            $usuarios = $usuario->todosNombresUsuarios();
            
            $email = $usuario->todosEmailUsuarios();

            $nombreImagen = null;


            $nombre_usuario_repetido = false;
            $email_usuario_repetido = false;


            $rol = Rol::where('rol', '=', 'basico')->first();

            foreach($usuarios as $u){ // Para los nombres de usuarios
                if($u->usuario === $request->input('usuario')){
                    $nombre_usuario_repetido = true;
                }
            }

            foreach($email as $e){ // Para los emails de usuarios
                if($e->email === $request->input('email')){
                    $email_usuario_repetido = true;
                }
            }

            if ($nombre_usuario_repetido == false){
                
                    if ($email_usuario_repetido == false){

                        $this->validate(request(), [
                            'usuario' => 'required',
                            'email' => 'required|email',
                            'password' => 'required',
                            'nombre' => 'required',
                            'apellidos' => 'required',
                            'fechaNacimiento' => 'nullable|date',
                            'pais' => 'nullable|string',
                            'twitter' => 'nullable|string',
                            'facebook' => 'nullable|string',
                            'instagram' => 'nullable|string',
                            'paginaWeb' => 'nullable|string',
                            'imagenPerfil' => 'nullable|string'
                        ]);


                        // En este IF se crea el fichero en la carpeta publica de imagenes/perfil y se guarda el nombre del fichero para luego integrarlo a la base de datos.
                        if ($request->file('imagen_usuario') != null){ 
                            $iPerfil = $request->file('imagen_usuario');
                            $iExtension = $request->file('imagen_usuario')->getClientOriginalExtension();
                            $nombreFichero = time() . '.' . $iExtension; // getClientOriginalExtension pilla la extension del fichero subido
                            Image::make($iPerfil)->resize(100,100)->save(public_path('/imagenes/perfil/'.$nombreFichero));
                
                            $nombreImagen = $nombreFichero;
                        }



                        $usuario->usuario = $request->input('usuario');
                        $usuario->password = bcrypt($request->input('password'));
                        $usuario->nombre = $request->input('nombre');
                        $usuario->apellidos = $request->input('apellidos');
                        $usuario->email = $request->input('email');
                        $usuario->fechaNacimiento = $request->input('fecha_nacimiento');
                        $usuario->pais = $request->input('pais');
                        $usuario->twitter = $request->input('twitter');
                        $usuario->facebook = $request->input('facebook');
                        $usuario->instagram = $request->input('instagram');
                        $usuario->paginaWeb = $request->input('paginaWeb');
                        //$usuario->imagenPerfil = $request->input('imagen_usuario');
                        $usuario->imagenPerfil = $nombreImagen;
                        $usuario->rol = $rol->rol;
                        $usuario->save();

                        return redirect('/login');

                    } else {
                        return back()->withErrors(['El email ya existe']);
                    }
            
            } else {
                return back()->withErrors(['El usuario ya existe']);
            }

        } else {
            return back()->withErrors(['La contraseña esta mal escrita']);
        }

    }




    public function post_login_usuario(Request $request)
    {
        $usuario = new Usuari;

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
                $id_usuer = $id->id;
                $imagenPerfil = $id->imagenPerfil;
            }


            if (Auth::attempt($array_datos_usuarios)) {
                $rolUsuario = $usuario->comprobarRol($request->input('usuario'));

                session()->put('rol', $rolUsuario);
                session()->put('usuario', $request->input('usuario'));
                session()->put('idUsuario', $id_usuer);
                session()->put('imagenPerfil', $imagenPerfil);


                //session(['rol' => $rolUsuario]);
                //session(['usuario' => $request->input('usuario')]);
                return redirect('/');

            } else {
                return back()->withErrors(['Contraseña incorrectos']);
            }

        } else {
            return back()->withErrors(['Este usuario no existe']);
        }


    }










    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
