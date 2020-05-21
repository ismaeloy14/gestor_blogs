<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuari;
use App\User;
use App\Blog;
use App\Rol;
use App\Comentario;
use App\Noticia;
use App\Valoracion;
use App\Notificacion;

use Auth;

class UsuarioController extends Controller
{
    /**
     * Devuelve la vista del usuario seleccionado
     *
     * @return \Illuminate\Http\Response
     */
    public function index_UsuarioShow($usuario_retornado)
    {
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuario($usuario_retornado);

        //return print_r($user);
        return view('usuarios.showUsuario', array('user' => $user));

    }


    // Devuelve la vista del modficar perfil del usuario seleccionado
    /*public function index_UsuarioEdit($usuario_retornado){
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuario($usuario_retornado);

        $mismoUsuario = false;

        foreach($user as $u){
            if(session()->get('usuario') == $u->usuario){
                $mismoUsuario = true;
            }
        }

        // Comprobamos si es el mismo usuario o si es el usuario admin
        if(($mismoUsuario == true) || (session()->get('rol') == 'admin')){

            //return print_r($user);
            return view('usuarios.editUsuario', array('user' => $user));

        } else {

            return redirect('/');
        }

    }*/


    public function show_Usuario($nombreUsuario) {

        $usuario = new Usuari;
        

        $user = $usuario->soloUnUsuario($nombreUsuario);

        return view('usuarios.showUsuario', compact('user'));
    }

    public function modal_create_Usuario() {
        $rol = Rol::all();

        $paisesArray = ["España", "Francia", "Alemania", "Portugal"];

        return [$rol,$paisesArray];
    }



    public function modal_show_Usuario() { // carga modal para ver el usuario (tambien para el modal delete)
        $user = new Usuari;
        //$rol = Rol::all();

        $idUsuario = filter_input(INPUT_GET, 'id');

        $usuario = $user->soloUnUsuarioID($idUsuario);

        return [$usuario];

    }

    public function modal_edit_usuario() { // carga el modal de editar usuario
        $user = new Usuari;
        $rol = Rol::all();

        $idUsuario = filter_input(INPUT_GET, 'id');

        $usuario = $user->soloUnUsuarioID($idUsuario);

        return [$usuario,$rol];

    }

    /*public function modal_delete_Usuario() { // carga el modal para eliminar el usuario
        $user = new Usuari;

        $idUsuario = filter_input(INPUT_GET, 'id');

        $usuario = $user->soloUnUsuarioID($idUsuario);

        return [$usuario];

    }*/ 


    public function modal_UsuarioEdit(Request $request, $id_retornado) {
        $conexionUsuario = new Usuari;

        $todosUsuarios = $conexionUsuario->todosUsuarios();
        $busquedaUsuario = $conexionUsuario->soloUnUsuarioID($id_retornado);

        $usuarioRepetido = true;
        $emailRepetido = true;

        $users = Usuari::findOrFail($id_retornado);

        $variable = $request->input('usuario');

        // Comprueba si el email y usuario se repiten en la base de datos.
        foreach($todosUsuarios as $todosU){
            if ($todosU->usuario === $request->input('usuario')) {

                if ($users->usuario == $request->input('usuario')) {
                    $usuarioRepetido = true;

                } else {
                    $usuarioRepetido = false; // Esto marca que el nombre de usuario pasado es de otro usuario y esta repetido
                }
            }
            if ($todosU->email === $request->input('email')) {

                if ($users->email == $request->input('email')) {
                    $emailRepetido = true;

                } else {
                    $emailRepetido = false; // Esto marca que el email pasado es de otro usuario y esta repetido
                }
            }
        }

        if (session()->get('rol') == 'admin') {
            if ($usuarioRepetido == true) {
                if ($emailRepetido == true) {

                    $this->validate(request(), [
                        'usuario' => 'string|required',
                        'email' => 'required|email',
                        'nombre' => 'string|required',
                        'apellidos' => 'string|required',
                        'fechaNacimiento' => 'nullable|date',
                        'pais' => 'nullable|string',
                        'twitter'  =>  'nullable|string',
                        'facebook'  =>  'nullable|string',
                        'instagram' =>  'nullable|string',
                        'paginaWeb' =>  'nullable|string'
                    ]);

                    $users->usuario = $request->input('usuario');
                    $users->email = $request->input('email');
                    $users->nombre = $request->input('nombre');
                    $users->apellidos = $request->input('apellidos');
                    $users->fechaNacimiento = $request->input('fechaNacimiento');
                    $users->pais = $request->input('pais');
                    $users->twitter = $request->input('twitter');
                    $users->facebook = $request->input('facebook');
                    $users->instagram = $request->input('instagram');
                    $users->paginaWeb = $request->input('paginaWeb');
                    $users->save();

                    return redirect('/crudUsuarios');
                    

                } else {
                    return back()->withErrors(['El email ya existe']);
                }

            } else {
                return back()->withErrors(['El usuario ya existe']);
            }

        } else {
            return back();
        }

    }

    public function modal_UsuarioDelete($id_retornado) {

        $conexionUsuario = new Usuari;
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;

        $idBlog;

        if (session()->get('rol') == 'admin') {
            $blogUsuario = $conexionBlog->blogIDUsuario($id_retornado);

        
            if ($blogUsuario != null) {
                foreach ($blogUsuario as $blog) {
                    $idBlog = $blog->id;
                }

            
                $noticiasUsuario = $conexionNoticia->noticiaIDblogNormal($idBlog);
            
                if ($noticiasUsuario != null) {
                    

                    foreach ($noticiasUsuario as $noticia) { // No elimina las noticias
                        Valoracion::eliminarValoracionesIDNoticia($noticia->id);
                        Comentario::eliminarComentariosIDNoticia($noticia->id);
                    }
        
                    foreach ($noticiasUsuario as $eliminaNoticia) { // Elimina la noticia
                        Noticia::findOrFail($eliminaNoticia->id)->delete();
                    }

                    $noticiasUsuario = null;

                }

                if ($noticiasUsuario == null) {
                    Blog::findOrFail($idBlog)->delete();
    
                }

            }

            Notificacion::eliminarNotificacionesIDUsuario($id_retornado); // Como no se obtiene la id de la notificación, llamo a una función creada por mi.

            Usuari::findOrFail($id_retornado)->delete();            
            

            return redirect('/crudUsuarios');

        } else {
            return back();
        }

        

    }



    public function put_UsuarioEdit(Request $request, $usuario_retornado) { // Actualizar usuario
        $usuario = new Usuari;

        $todosUsuarios = $usuario->todosUsuarios();
        $user = $usuario->soloUnUsuario($usuario_retornado);

        $usuarioRepetido = false;
        $emailRepetido = false;
        $mismoUsuario = false;

        $id = null; // Sera la id de nuestro usuario


        foreach($user as $u){ // Comprueba si el nombre del usuario de esta sesion sea igual al usuario de la base de datos.
            if(session()->get('usuario') == $u->usuario){
                $mismoUsuario = true;
            }

            $id = $u->id;
        }

        $users = Usuari::findOrFail($id); // Busco el usuario por su id


        // Comprueba si el email y usuario se repiten en la base de datos.
        foreach($todosUsuarios as $todosU){
            if ($todosU->usuario === $request->input('usuario')) {
                if ($todosU->id == session()->get('idUsuario')) {

                    $usuarioRepetido = false;
             
                } else if (session()->get('rol') == 'admin') {

                    $usuarioRepetido = false;

                } else {

                    $usuarioRepetido = true;
                }
            }
            if ($todosU->email === $request->input('email')) {
                if ($todosU->id == session()->get('idUsuario')) {

                    $emailRepetido = false;

                } else if (session()->get('rol') == 'admin') {

                    $emailRepetido = false;

                } else {

                    $emailRepetido = true;
                }
                
            }
        }

        // Comprobamos si es el mismo usuario o si es el usuario admin
        if(($mismoUsuario == true) || (session()->get('rol') == 'admin')){
            if ($usuarioRepetido == false) {
                if ($emailRepetido == false) {

                    $this->validate(request(), [
                        'usuario' => 'required',
                        'email' => 'required|email',
                        'nombre' => 'required',
                        'apellidos' => 'required',
                        'fechaNacimiento' => 'nullable|date',
                        'pais' => 'nullable|string',
                        'imagenPerfil' => 'nullable|image'
                    ]);

                      
                    $users->usuario = $request->input('usuario');
                    $users->email = $request->input('email');
                    $users->nombre = $request->input('nombre');
                    $users->apellidos = $request->input('apellidos');
                    $users->fechaNacimiento = $request->input('fechaNacimiento');
                    $users->pais = $request->input('pais');
                    $users->imagenPerfil = $request->input('imagenPerfil');
                    $users->save();

                    return redirect('/');


                } else {
                    return back()->withErrors(['El email ya existe']);
                }

            } else {
                return back()->withErrors(['El usuario ya existe']);
            }

        } else {

            return back();
        }

    }

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





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
