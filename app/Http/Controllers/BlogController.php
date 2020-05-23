<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Categoria;
use App\Noticia;
use App\Usuari;
use App\Valoracion;
use App\Comentario;
use Auth;
use Image;

class BlogController extends Controller
{

    public function index_creacion()
    {
        $categorias = new Categoria;
        $categoria = $categorias->todasCategorias();
        return view('blogs.crearBlog', array('categorias' => $categoria));
    }

    public function index_blog($tituloblog) {
        $conexionblog = new Blog;
        $conexionUsuario = new Usuari;
        $conexionNoticia = new Noticia;

        $blog = $conexionblog->blogNombreFirst($tituloblog);
        $user = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if ($blog == null) {
            return redirect('/');

        }  elseif (($blog->blogPublico == 1) || (session()->get('rol') == 'admin')) {
            $usuario = $conexionUsuario->soloUnUsuarioID($blog->idUsuario);
            $noticias = $conexionNoticia->noticiaIDblog($blog->id); // Viene en formato descendiente, asi las noticias nuevas estaran siempre arriba.

            return view('indexBlogs', compact('blog', 'usuario', 'noticias'));

        } elseif (($blog->blogPublico == 0) && (session()->get('usuario') != $user->usuario)) {
            return redirect('/');
        }

    }

    public function gestionar_blog($tituloblog)
    {
        $conexionBlog = new blog;
        $conexionUsuario = new Usuari;

        $blog = $conexionBlog->blogNombreFirst($tituloblog);
        $user = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $user->usuario) {
            return view('blogs.gestion.gestionBlogs', compact('blog', 'user'));
        } else {
            return redirect('/');
        }
    }

    public function edita_Blog($tituloblog)
    {
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;
        $blog = $conexionBlog->blogNombreFirst($tituloblog);

        $categorias = Categoria::all();
        $user = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $user->usuario) {
            return view('blogs.gestion.editarBlog', compact('blog', 'categorias'));
        } else {
            return redirect('/');
        }
    }

    public function put_edita_Blog(Request $request, $tituloblog, $idBlog)
    {
        $blog = Blog::findOrFail($idBlog);
        $allBlogs = Blog::all();
        $user = Usuari::findOrFail($blog->idUsuario);

        $titleBlog = $request->input('tituloBlog');
        $longitud_titulo = strlen($titleBlog);

        if (session()->get('usuario') == $user->usuario) {

            foreach ($allBlogs as $b) {
                if ($b->tituloBlog == $titleBlog) {
                    if ($b->tituloBlog == $blog->tituloBlog) {
                        $tituloValido = true;
                    } else {
                        $tituloValido = false;
                    }
                } else {
                    $tituloValido = true;
                }
            }

            if ($tituloValido == true){

                if ($longitud_titulo < 3) {
                    return back()->withErrors(['El título es demasiado corto']);
                } elseif ($longitud_titulo > 20) {
                    return back()->withErrors(['El título es demasiado largo']);
                } else {

                    if (($request->input('publico') != 1) && ($request->input('publico') != 0)){

                        return back()->withErrors(['El valor del menú desplegable público es incorrecto']);

                    } else {

                        $this->validate(request(), [
                            'tituloBlog' => 'required|string',
                            'categoria' => 'required|string',
                            'publico'   =>  'required|string'
                        ]);

                        $blog->tituloBlog = $titleBlog;
                        $blog->blogPublico = $request->input('publico');
                        $blog->categoria = $request->input('categoria');
                        $blog->save();

                        return redirect(url('/'.$blog->tituloBlog.'/gestionarBlog'));

                    }
                }
            } else {
                return back()->withErrors(['El título nuevo ya existe en otro blog. Introduzca otro.']);
            }

        } else {
            return redirect('/');
        }

    }


    public function post_createBlog(Request $request)
    {
        $blog = new Blog;
        $conexionUsuario = new Usuari;
        $todosBlogs = $blog->todosBlogs();

        $usuario_logueado = session()->get('usuario');

        $user = $conexionUsuario->soloUnUsuarioFirst($usuario_logueado);

        $titulo = $request->input('tituloBlog');
        $longitud_titulo = strlen($titulo);

        $existeUsuario = false;
        $titulo_repetido = false;
        $nombreImagen = null;

        foreach($todosBlogs as $b){ // Para los nombres de usuarios
            if($b->idUsuario === $user->id){
                $existeUsuario = true;
                break;
            }
            
            if ($b->tituloBlog == $titulo) {
                $titulo_repetido == true;
                break;
            }
        }

        if ($existeUsuario == false) {
            if ($titulo_repetido == false) {
            
                // Comprobaciones titulo
                if ($longitud_titulo > 20 ){

                    return back()->withErrors(['El título es demasiado largo']);

                } else if ($longitud_titulo < 3) {

                    return back()->withErrors(['El título es demasiado corto']);

                } else { // Cuando el titulo del blog esta dentro del rango permitido
                    
                    
                    if (($request->input('publico') != 1) && ($request->input('publico') != 0)){

                        return back()->withErrors(['El valor del menú desplegable publico es incorrecto']);

                    } else {
                        
                        $this->validate(request(), [
                            'tituloBlog' => 'required|string',
                            'categoria' => 'required|string',
                            'imagenBlog' => 'string|image'
                        ]);

                        // En este IF se crea el fichero en la carpeta publica de imagenes/blog y se guarda el nombre del fichero para luego integrarlo a la base de datos.
                        if ($request->file('imagen_blog') != null){ 
                            $iBlog = $request->file('imagen_blog');
                            $iExtension = $request->file('imagen_blog')->getClientOriginalExtension();
                            $nombreFichero = time() . '.' . $iExtension; // getClientOriginalExtension pilla la extension del fichero subido
                            Image::make($iBlog)->resize(250,100)->save(public_path('/imagenes/blog/'.$nombreFichero));
                
                            $nombreImagen = $nombreFichero;
                        } else {
                            $nombreImagen = 'imagen_blog_defecto.jpg';
                        }
            
                        $blog->tituloBlog = $titulo;
                        $blog->imagenBlog = $nombreImagen;
                        $blog->idUsuario = $user->id;
                        $blog->blogPublico = $request->input('publico');
                        $blog->categoria = $request->input('categoria');
                        $blog->save();

                        return redirect('/');

                    }
        
                }
            } else { // Titulo repetido
                return back()->withErrors(['Ya existe otro blog con el mismo título']);
            }

        } else { // Existe usuario

            return back()->withErrors(['Ya tienes un blog creado. No puedes hacer otro']);

        }

    }

    // MODALES \\

    public function modal_create_Blog() // ejecuta el ajax para el modal de crear blog
    {
        //$conexionUsuario = new Usuari;
        $conexionBlog = new Blog;

        $usuarios = Usuari::all();
        //$blogs = Blog::all();
        $categorias = Categoria::all();

        $arrayAsocUsuarios = []; // Este array contendra los usuarios con un true o false depeniendo si tienen un blog
        $contador = 0;


        foreach ($usuarios as $user) {

            $blog = $conexionBlog->blogIDUsuario($user->id);

            if ($blog == null) {
                $arrayAsocUsuarios[$contador] = $user->usuario;
                $contador ++;
            }
            
        }

        return [$arrayAsocUsuarios, $categorias];

    }

    public function modal_show_delete_Blog() // Ejecuta los modales tanto para el show como para el delete
    {
        $user = new Usuari;

        $idBlog = filter_input(INPUT_GET, 'id');

        $blog = Blog::findOrFail($idBlog);


        $usuario = $user->soloUnUsuarioIDFirst($blog->idUsuario);

        return [$usuario, $blog];
    }

    public function modal_edit_Blog() // ejecuta el modal para editar blog
    {
        $idBlog = filter_input(INPUT_GET, 'id');

        $blog = Blog::findOrFail($idBlog);
        $categorias = Categoria::all();

        return [$blog, $categorias];
    }



    public function modal_post_create_blog(Request $request) // se ejecuta cuando el admin crea un blog en el modal
    {
        $conexionUsuario = new Usuari;
        $blog = new Blog;
        $todosBlogs = $blog->todosBlogs();

        $usuario = $conexionUsuario->soloUnUsuarioFirst($request->input('usuario'));

        $titulo = $request->input('tituloBlog');
        $longitud_titulo = strlen($titulo);
        $titulo_repetido = false;

        foreach($todosBlogs as $b){ // Para los nombres titulos
            
            if ($b->tituloBlog == $titulo) {
                $titulo_repetido == true;
                break;
            }
        }

        if ($titulo_repetido == false) {
            // Comprobaciones titulo
            if ($longitud_titulo > 20 ){

                return back()->withErrors(['El título es demasiado largo']);

            } else if ($longitud_titulo < 3) {

                return back()->withErrors(['El título es demasiado corto']);

            } else { // Cuando el titulo del blog esta dentro del rango permitido
                
                
                if (($request->input('publico') != 1) && ($request->input('publico') != 0)){

                    return back()->withErrors(['El valor del menú desplegable publico es incorrecto']);

                } else {
                    
                    $this->validate(request(), [
                        'tituloBlog' => 'required|string',
                        'categoria' => 'required|string'
                    ]);

        
                    $blog->tituloBlog = $titulo;
                    $blog->imagenBlog = 'imagen_blog_defecto.jpg';
                    $blog->idUsuario = $usuario->id;
                    $blog->blogPublico = $request->input('publico');
                    $blog->categoria = $request->input('categoria');
                    $blog->save();

                    return redirect('/crudUsuarios');

                }
    
            }
        } else {
            return back()->withErrors(['Ya existe otro blog con el mismo título']);
        }
    }

    public function modal_put_edit_Blog(Request $request, $idBlog_retornado) // se ejecuta cuando el admin actualiza un blog en el modal
    {   //$conexionBlog = new Blog;
        $todosBlogs = Blog::all();

        $blog = Blog::findOrFail($idBlog_retornado);

        $titulo = $request->input('tituloBlog');
        $longitud_titulo = strlen($titulo);
        $titulo_repetido = false;

        foreach($todosBlogs as $b){ // Para los titulos
            
            if ($b->tituloBlog == $titulo) {
                $titulo_repetido == true;
                break;
            }
        }

        if (session()->get('rol') == 'admin') {

            if ($titulo_repetido == false) {
                if ($longitud_titulo > 20 ){

                    return back()->withErrors(['El título es demasiado largo']);
    
                } else if ($longitud_titulo < 3) {
    
                    return back()->withErrors(['El título es demasiado corto']);
    
                } else { // La lonitud del titulo esta dentro del rango

                    if (($request->input('publico') != 1) && ($request->input('publico') != 0)){

                        return back()->withErrors(['El valor del menú desplegable publico es incorrecto']);
    
                    } else {

                        $this->validate(request(), [
                            'tituloBlog' => 'required|string',
                            'categoria' => 'required|string',
                            'publico'   =>  'required|string'
                        ]);

                        $blog->tituloBlog = $titulo;
                        $blog->blogPublico = $request->input('publico');
                        $blog->categoria = $request->input('categoria');
                        $blog->save();

                        return redirect('/crudUsuarios');

                    }

                }

            }   else {
                return back()->withErrors(['Ya existe otro blog con el mismo título']);
            }

        } else {
            return redirect('/');
        }

    }

    public function modal_post_delete_Blog($idBlog_retornado) // se ejecuta cuando el admin elimina un blog en el modal
    {
        if (session()->get('rol') == 'admin') {

            $conexionNoticia = new Noticia;
            //$conexionValoracion = new Valoracion;
            //$conexionComentario = new Comentario;
            $blog = Blog::findOrFail($idBlog_retornado);
            
            //return print($blog->tituloBlog);

            $noticiasBlog = $conexionNoticia->noticiaIDblogNormal($idBlog_retornado);
            
            if ($noticiasBlog != null) {
                

                foreach ($noticiasBlog as $noticia) { // No elimina las noticias

                    $eliminarValoraciones = Valoracion::eliminarValoracionesIDNoticia($noticia->id);
                    $eliminarComentarios = Comentario::eliminarComentariosIDNoticia($noticia->id);

                    if ($eliminarValoraciones == null) {
                        break;
                    }
                    if ($eliminarComentarios == null) {
                        break;
                    }
                }
    
                foreach ($noticiasBlog as $eliminaNoticia) { // Elimina la noticia
                    Noticia::findOrFail($eliminaNoticia->id)->delete();
                }

                $noticiasBlog = null;

            }

            if ($noticiasBlog == null) {
                Blog::findOrFail($idBlog_retornado)->delete();

            }

            return redirect('/crudUsuarios');

        } else {
            return redirect('/');
        }
    }


}
