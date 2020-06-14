<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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
use Image;

class UsuarioController extends Controller
{

    public function show_Usuario($nombreUsuario) { // Carga el perfil del usuario

        $usuario = new Usuari;
        
        $user = $usuario->soloUnUsuarioFirst($nombreUsuario);

        if ($user == null) {
            return redirect('/');
        } else {
            return view('usuarios.showUsuario', compact('user'));
        }

        
    }

    // Devuelve la vista del modficar perfil del usuario seleccionado
    public function index_UsuarioEdit($usuario_retornado){
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuarioFirst($usuario_retornado);
        $arrayPaises = ['España', 'Argentina', 'México', 'Colombia'];

        $mismoUsuario = false;

        if(session()->get('usuario') == $user->usuario){
            $mismoUsuario = true;
        }

        // Comprobamos si es el mismo usuario o si es el usuario admin
        if($mismoUsuario == true){

            //return print_r($user);
            return view('usuarios.editUsuario', compact('user', 'arrayPaises'));

        } else {

            return redirect('/');
        }

    }


    public function index_UsuarioEditContrasena($usuario_retornado)
    {
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuarioFirst($usuario_retornado);

        if (session()->get('usuario') == $user->usuario) {
            return view('usuarios.editContrasena', array('user' => $user));
        } else {
            return redirect('/');
        }
    }

    public function index_UsuarioEditAvatar($usuario_retornado)
    {
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuarioFirst($usuario_retornado);

        if (session()->get('usuario') == $user->usuario) {
            return view('usuarios.editAvatar', array('user' => $user));
        } else {
            return redirect('/');
        }
    }

    // Esta funcion es del registro de usuarios
    public function post_create_usuario(Request $request) // También es para añadir usuarios via admin
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
                            'usuario' => 'string|required',
                            'email' => 'required|email',
                            'password' => 'required',
                            'nombre' => 'string|required',
                            'apellidos' => 'string|required',
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
                        } else {
                            $nombreImagen = 'perfil_defecto.png';
                        }



                        $usuario->usuario = $request->input('usuario');
                        $usuario->password = bcrypt($request->input('password'));
                        $usuario->nombre = $request->input('nombre');
                        $usuario->apellidos = $request->input('apellidos');
                        $usuario->email = $request->input('email');
                        $usuario->fechaNacimiento = $request->input('fecha_nacimiento');
                        //$usuario->pais = $request->input('pais');

                        if ($request->input('pais') != 'España') {
                            if ($request->input('pais') != 'Argentina') { 
                                if ($request->input('pais') != 'México') {
                                    if ($request->input('pais') != 'Colombia') {
                                        $usuario->pais = null;
                                    } else {
                                        $usuario->pais = $request->input('pais');
                                    }
                                } else {
                                    $usuario->pais = $request->input('pais');
                                }
                            } else {
                                $usuario->pais = $request->input('pais');
                            }
                        } else {
                            $usuario->pais = $request->input('pais');
                        }

                        if ($request->input('twitter') != null) {
                            $usuario->twitter = 'https://'.$request->input('twitter');
                        }
    
                        if ($request->input('facebook') != null) {
                            $usuario->facebook = 'https://'.$request->input('facebook');
                        }
    
                        if ($request->input('instagram') != null) {
                            $usuario->instagram = 'https://'.$request->input('instagram');
                        }

                        /*$usuario->twitter = 'https://'.$request->input('twitter');
                        $usuario->facebook = 'https://'.$request->input('facebook');
                        $usuario->instagram = 'https://'.$request->input('instagram');
                        $usuario->paginaWeb = $request->input('paginaWeb');*/
                        if ($request->input('paginaWeb') != null) {
                            $usuario->paginaWeb = 'https://'.$request->input('paginaWeb');
                        }

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

    public function put_UsuarioEdit(Request $request, $usuario_retornado) { // El usuario cambia sus datos usuario
        $usuario = new Usuari;

        //$todosUsuarios = $usuario->todosUsuarios();
        $user = $usuario->soloUnUsuarioFirst($usuario_retornado);

        $usuarioRepetido = false;
        $emailRepetido = false;
        $mismoUsuario = false;

        $id = null; // Sera la id de nuestro usuario


         // Comprueba si el nombre del usuario de esta sesion sea igual al usuario de la base de datos.
        if(session()->get('usuario') == $user->usuario){
            $mismoUsuario = true;
            $id = $user->id; 
        } else {
            return redirect('/');
        }

        $usuarioRepetido = $usuario->soloUnUsuarioFirst($request->input('usuario')); // Null o lleno
        $emailRepetido = $usuario->soloUnEmailFirst($request->input('email')); // Null o lleno



        $users = Usuari::findOrFail($id); // Busco el usuario por su id


        // Comprobamos si es el mismo usuario o si es el usuario admin
        if($mismoUsuario == true){
            if (($usuarioRepetido == null) || ($usuarioRepetido->usuario == $user->usuario)) { // Null == no esta repetido
                if (($emailRepetido == null) || ($emailRepetido->email == $user->email)) { // Null == no esta repetido

                    $this->validate(request(), [
                        'usuario' => 'required',
                        'email' => 'required|email',
                        'nombre' => 'required',
                        'apellidos' => 'required',
                        'fechaNacimiento' => 'nullable|date',
                        'pais' => 'nullable|string',
                        //'imagenPerfil' => 'nullable|image',
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
                    //$users->pais = $request->input('pais');

                    if ($request->input('pais') != 'España') {
                        if ($request->input('pais') != 'Argentina') { 
                            if ($request->input('pais') != 'México') {
                                if ($request->input('pais') != 'Colombia') {
                                    $users->pais = null;
                                } else {
                                    $users->pais = $request->input('pais');
                                }
                            } else {
                                $users->pais = $request->input('pais');
                            }
                        } else {
                            $users->pais = $request->input('pais');
                        }
                    } else {
                        $users->pais = $request->input('pais');
                    }

                    if ($request->input('twitter') != null) {
                        $users->twitter = 'https://'.$request->input('twitter');
                    } else {
                        $users->twitter = null;
                    }

                    if ($request->input('facebook') != null) {
                        $users->facebook = 'https://'.$request->input('facebook');
                    } else {
                        $users->facebook = null;
                    }

                    if ($request->input('instagram') != null) {
                        $users->instagram = 'https://'.$request->input('instagram');
                    } else {
                        $users->instagram = null;
                    }

                    /*$users->twitter = 'https://'.$request->input('twitter');
                    $users->facebook = 'https://'.$request->input('facebook');
                    $users->instagram = 'https://'.$request->input('instagram');
                    $users->paginaWeb = $request->input('paginaWeb');*/
                    if ($request->input('paginaWeb') != null) {
                        $users->paginaWeb = 'https://'.$request->input('paginaWeb');
                    } else {
                        $users->paginaWeb = null;
                    }
                    //$user->imagenPerfil = $request->input('imagenPerfil');
                    $users->save();

                    session()->put('usuario', $request->input('usuario'));

                    return redirect('/usuario/'.$request->input('usuario'));

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

    public function put_UsuarioEditContrasena(Request $request, $usuario_retornado) // El usuario cambia su contraseña
    {
        $conexionUsuario = new Usuari;

        $passwordNewRequest = $request->input('passwordNew');
        $passwordNew2Request = $request->input('passwordNew2');

        
        if ($passwordNewRequest == $passwordNew2Request) {

            $usuario = $conexionUsuario->soloUnUsuarioFirst($usuario_retornado);
            $user = Usuari::findOrFail($usuario->id);

            if ($user->usuario == $passwordNewRequest) {
                return back()->withErrors(['Contraseña no válida']);
            } else {

                $this->validate(request(), [
                    'passwordNew'  =>  'required',
                    'passwordNew2'  =>  'required'
                ]);
    
                $user->password = bcrypt($passwordNewRequest);
                $user->save();
    
                return redirect('/usuario/'.$user->usuario);
            }

        } else {
            return back()->withErrors(['Las contraseñas introducidas no coinciden']);
        }

        
    }

    public function put_UsuarioEditAvatar(Request $request, $usuario_retornado)
    {

        $conexionUsuario = new Usuari;

        $usuario = $conexionUsuario->soloUnUsuarioFirst($usuario_retornado);

        if (session()->get('usuario') == $usuario->usuario) {

            //return print_r($request->file('imagenUsuario'));
            $user = Usuari::findOrFail($usuario->id);
            
            $this->validate(request(), [
                'imagenPerfil' => 'nullable|string'
            ]);

            if ($request->file('imagenUsuario') != null){

                $iPerfil = $request->file('imagenUsuario');
                $iExtension = $request->file('imagenUsuario')->getClientOriginalExtension();
                $nombreFichero = time() . '.' . $iExtension; // getClientOriginalExtension pilla la extension del fichero subido
                Image::make($iPerfil)->resize(100,100)->save(public_path('/imagenes/perfil/'.$nombreFichero));
    
                $nombreImagen = $nombreFichero;
            } else {
                $nombreImagen = 'perfil_defecto.png';
            }

            
            $user->imagenPerfil = $nombreImagen;
            $user->save();

            session()->put('imagenPerfil', $user->imagenPerfil);

            return redirect('/usuario/'.$user->usuario);

        } else {
            return redirect('/');
        }

        
    }


    // VENTANAS MODALES

    public function modal_create_Usuario() { // Modal creación usuario
        $rol = Rol::all();

        $paisesArray = ["España", "Argentina", "México", "Colombia"];

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


    public function modal_UsuarioEdit(Request $request, $id_retornado) { // Actualizar usuario desde ventana modal
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
                        'rol'   =>  'required|string',
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
                    $users->rol = $request->input('rol');
                    $users->nombre = $request->input('nombre');
                    $users->apellidos = $request->input('apellidos');
                    $users->fechaNacimiento = $request->input('fechaNacimiento');
                    //$users->pais = $request->input('pais');

                    if ($request->input('pais') != 'España') {
                        if ($request->input('pais') != 'Argentina') { 
                            if ($request->input('pais') != 'México') {
                                if ($request->input('pais') != 'Colombia') {
                                    $users->pais = null;
                                } else {
                                    $users->pais = $request->input('pais');
                                }
                            } else {
                                $users->pais = $request->input('pais');
                            }
                        } else {
                            $users->pais = $request->input('pais');
                        }
                    } else {
                        $users->pais = $request->input('pais');
                    }

                    if ($request->input('twitter') != null) {
                        $users->twitter = 'https://'.$request->input('twitter');
                    } else {
                        $users->twitter = null;
                    }

                    if ($request->input('facebook') != null) {
                        $users->facebook = 'https://'.$request->input('facebook');
                    } else {
                        $users->facebook = null;
                    }

                    if ($request->input('instagram') != null) {
                        $users->instagram = 'https://'.$request->input('instagram');
                    } else {
                        $users->instagram = null;
                    }

                    if ($request->input('paginaWeb') != null) {
                        $users->paginaWeb = 'https://'.$request->input('paginaWeb');
                    } else {
                        $users->paginaWeb = null;
                    }

                    //$users->paginaWeb = $request->input('paginaWeb');
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

    public function modal_UsuarioDelete($id_retornado) { // Eliminación del usuario por ventana modal

        $conexionUsuario = new Usuari;
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;

            if (session()->get('rol') == 'admin') {
                if ($id_retornado == 1) {
                    return back()->withErrors(['No se puede eliminar el administrador']);
                    
                } else {

                    $blogUsuario = $conexionBlog->blogIDUsuario($id_retornado);

            
                if ($blogUsuario != null) {
                    
                    $noticiasUsuario = $conexionNoticia->noticiaIDblogNormal($blogUsuario->id);



                    //return print_r($noticiasUsuario.' ');
                
                    if ($noticiasUsuario != null) {
                        

                        foreach ($noticiasUsuario as $noticia) { // No elimina las noticias
                            $eliminarValoraciones = Valoracion::eliminarValoracionesIDNoticia($noticia->id);
                            $eliminarComentarios = Comentario::eliminarComentariosIDNoticia($noticia->id);
                            $eliminarUsuarioComentario = Comentario::eliminarComentariosIDUsuario($id_retornado); // Elimina los comentarios del usuario

                            if (($eliminarValoraciones == null) && ($eliminarComentarios == null) && ($eliminarUsuarioComentario == null)) {
                                break;
                            }
                        }
            
                        foreach ($noticiasUsuario as $eliminaNoticia) { // Elimina la noticia
                            Noticia::findOrFail($eliminaNoticia->id)->delete();
                        }

                        $noticiasUsuario = null;
                        
                    }

                    if ($noticiasUsuario == null) {
                        Blog::findOrFail($blogUsuario->id)->delete();
        
                    }

                }

                //Notificacion::eliminarNotificacionesIDUsuario($id_retornado); // Como no se obtiene la id de la notificación, llamo a una función creada por mi.

                Usuari::findOrFail($id_retornado)->delete();            
                
                return redirect('/crudUsuarios');

            }
                
        } else {
            return back();
        }

        

    }



    

    




}
