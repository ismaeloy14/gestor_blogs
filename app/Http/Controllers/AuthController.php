<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Usuari;
use App\Rol;
use App\Blog;
use Auth;


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
        session()->forget('usuario');
        return redirect('/');
    }

    public function index_crudUsuarios(){
        $users = new Usuari;
        $blogs = new Blog;
        $usuarios_sql = $users->todosUsuarios();
        $blog_sql = $blogs->todosBlogs();


        return view('admin.crudUsuarios', array('usuarios' => $usuarios_sql), array('blogs' => $blog_sql));
    }




    // Esta funcion es del registro de usuarios
    public function post_create_usuario(Request $request)
    {
        //$usuario = new User;

        if ($request->input('password') === $request->input('password2')){

            

            $usuario = new Usuari;
            $usuarios = $usuario->todosNombresUsuarios();
            
            $email = $usuario->todosEmailUsuarios();


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
                            'imagenPerfil' => 'image'
                        ]);

                        $usuario->usuario = $request->input('usuario');
                        $usuario->password = bcrypt($request->input('password'));
                        $usuario->nombre = $request->input('nombre');
                        $usuario->apellidos = $request->input('apellidos');
                        $usuario->email = $request->input('email');
                        $usuario->fechaNacimiento = $request->input('fecha_nacimiento');
                        $usuario->pais = $request->input('pais');
                        $usuario->imagenPerfil = $request->input('imagen_usuario');
                        $usuario->rol = $rol->rol;
                        $usuario->save();

                        return redirect('/login');

                    } else {
                        return back()->withErrors(['El email ya existe']);
                    }
            
            } else {
                return back()->withErrors(['El usuario ya esxiste']);
            }

        } else {
            return back()->withErrors(['La contraseña esta mal escrita']);
        }

    }

    public function post_login_usuario(Request $request)
    {
        $usuario = new Usuari;

        $existeUsuario = $usuario->comprobarNombreUsuario($request->input('usuario'));

        $this->validate($request, [
            'usuario' => 'required',
            'password' => 'required'
        ]);
        
        

        if ($existeUsuario != null) {

            $array_datos_usuarios = array(
                'usuario' => $request->input('usuario'),
                'password' => $request->input('password')
            );

            if (Auth::attempt($array_datos_usuarios)) {
                $rolUsuario = $usuario->comprobarRol($request->input('usuario'));

                session(['usuario' => $rolUsuario]);
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
