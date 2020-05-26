<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Blog;
use App\Noticia;
use App\Usuari;
use App\Valoracion;
use App\Comentario;

class NoticiaController extends Controller
{


    public function show_Noticia_Completa($tituloBlog, $tituloNoticia) {

        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;
        $conexionUsuario = new Usuari;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);


        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario); // usuario registrado
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia);

        $comentarios = Comentario::todosComentariosNoticia($noticia->id);
        $allUsuarios = Usuari::all();
        

        if ($noticia->noticiaPublica == 1) {
            return view('blogs.noticias.showNoticia', compact('blog', 'noticia', 'usuario', 'comentarios', 'allUsuarios'));
        } else {

            if ((session()->get('usuario') == $usuario->usuario) || (session()->get('rol') == 'admin')) {
                return view('blogs.noticias.showNoticia', compact('blog', 'noticia', 'usuario', 'comentarios', 'allUsuarios'));
            } else {
                return back();
            }

        }        

    }


    public function index_gestionarNoticias($tituloBlog)
    {
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;
        $conexionUsuario = new Usuari;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $noticias = $conexionNoticia->noticiaIDblog($blog->id); // Formato descendiente ( más viejo -> más nuevo)
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {
            return view('blogs.gestion.noticias.gestionNoticias', compact('blog', 'usuario', 'noticias'));
        } else {
            return redirect('/'.$tituloBlog);
        }



    }

    // Inserta un comentario en la noticia

    public function post_Comentario(Request $request, $tituloblog_retornado, $tituloNoticia_retornada)
    {
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;
        $conexionUsuario = new Usuari;

        $comentario = new Comentario; // Se usara para insertar los datos

        $blog = $conexionBlog->blogNombreFirst($tituloblog_retornado);
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia_retornada);

        if ($request->input('usuario') == null) { // Significa que es un usuario no registrado

            $this->validate(request(), [
                'email' => 'required|string',
                'cuerpoComentario' => 'required|string'
            ]);

            
            $comentario->email = $request->input('email');
            $comentario->idUsuario = null;
            $comentario->idNoticia = $noticia->id;
            $comentario->comentario = $request->input('cuerpoComentario');
            $comentario->save();

            return redirect(url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia));
            
        } elseif ($request->input('usuario') != null) { // Significa que hay un usuario logueado

            $usuario = $conexionUsuario->soloUnUsuarioFirst($request->input('usuario'));

            $this->validate(request(), [
                'usuario' => 'required|string',
                'cuerpoComentario' => 'required|string'
            ]);

            $comentario->email = null;
            $comentario->idUsuario = $usuario->id;
            $comentario->idNoticia = $noticia->id;
            $comentario->comentario = $request->input('cuerpoComentario');
            $comentario->save();
            
            return redirect(url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia));

        }

    }

    // Función que coge los datos de la base de datos de la puntuación de la noticia

    public function cogerPuntuacionNoticia($tituloblog_retornado, $tituloNoticia_retornada)
    {
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;

        $blog = $conexionBlog->blogNombreFirst($tituloblog_retornado);
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia_retornada);

        $valoracion = Valoracion::totalValoracionNoticiaFirst($noticia->id);

        return $valoracion->valoracionesTotales;

    }

    // Función que aumenta la puntuación de la noticia

    public function sumaPuntuacionNoticia($tituloblog_retornado, $tituloNoticia_retornada)
    {
        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;

        

        $puntuacionNoticia = filter_input(INPUT_GET, 'puntuacionNoticia');

        $blog = $conexionBlog->blogNombreFirst($tituloblog_retornado);
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia_retornada);
        $valoracion = Valoracion::totalValoracionNoticiaFirst($noticia->id);

        if ($puntuacionNoticia != null) {

            $puntuacionNoticia ++;

            $insertValoracion = Valoracion::findOrFail($valoracion->id);

            $insertValoracion->valoracionesTotales = $puntuacionNoticia;
            $insertValoracion->save();
            
            return $puntuacionNoticia;

        } else {
            return back();
        }

    }

    // Ventana modal delete

    public function modal_delete_Noticia()
    {

        $idNoticia = filter_input(INPUT_GET, 'id');

        $noticia = Noticia::findOrFail($idNoticia);

        return [$noticia];
    }

    // Vista de crear noticia

    public function view_create_Noticia($tituloBlog)
    {
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {

            return view('blogs.gestion.noticias.createNoticia', compact('blog', 'usuario'));

        } else {
            return redirect('/');
        }

    }

    // Vista de actualizar noticia

    public function view_update_Noticia($tituloBlog, $tituloNoticia)
    {
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;
        $conexionNoticia = new Noticia;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {
            $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia);

            return view('blogs.gestion.noticias.updateNoticia', compact('blog', 'usuario', 'noticia'));

        } else {
            return redirect('/');
        }

    }

    // Crea la noticia

    public function createNoticia(Request $request, $tituloBlog)
    {
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;

        $noticia = new Noticia;
        $valoracion = new Valoracion;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {

            $tituloNoticia = $request->input('tituloNoticia');
            $longitudTituloNoticia = strlen($tituloNoticia);

            if ($longitudTituloNoticia < 3) {
                return back()->withErrors(['El título de la notícia es demasiado corto']);
            } elseif ($longitudTituloNoticia > 50) {
                return back()->withErrors(['El título de la notícia es demasiado largo']);
            } else {

                if (($request->input('publico') != 1) && ($request->input('publico') != 0)){
                    return back()->withErrors(['El valor del menú desplegable publico es incorrecto']);
                } else {
                    $this->validate(request(), [
                        'tituloNoticia' => 'required|string',
                        'cuerpoNoticia' => 'required|string'
                    ]);

                    $noticia->tituloNoticia = $tituloNoticia;
                    $noticia->cuerpoNoticia = $request->input('cuerpoNoticia');
                    $noticia->fechaNoticia = date("Y-m-d");
                    $noticia->idBlog = $blog->id;
                    $noticia->noticiaPublica = $request->input('noticiaPublica');
                    $noticia->save();

                    $ultimaNoticia = $noticia->ultimaNoticiaIDFirst(); // Esto es para sacar la ultima noticia

                    $valoracion->idNoticia = $ultimaNoticia->id;
                    $valoracion->valoracionesTotales = 0;
                    $valoracion->save();

                    return redirect( url('/'.$tituloBlog.'/gestionarBlog/gestionarNoticias') );

                }

            }

        } else {
            return redirect('/');
        }
    }

    // Actualiza la noticia

    public function updateNoticia(Request $request, $tituloBlog, $tituloOriginalNoticia)
    {
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;

        $conexionNoticia = new Noticia;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {
            $buscarNoticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloOriginalNoticia); // Para buscar la noticia

            $noticia = Noticia::findOrFail($buscarNoticia->id); // Hago esto para poder guardar los datos

            $tituloNoticia = $request->input('tituloNoticia'); // Titulo retornado (nuevo)
            $longitudTituloNoticia = strlen($tituloNoticia);

            if ($longitudTituloNoticia < 3) {
                return back()->withErrors(['El título de la notícia es demasiado corto']);
            } elseif ($longitudTituloNoticia > 50) {
                return back()->withErrors(['El título de la notícia es demasiado largo']);
            } else {

                if (($request->input('publico') != 1) && ($request->input('publico') != 0)){
                    return back()->withErrors(['El valor del menú desplegable publico es incorrecto']);
                } else {
                    $this->validate(request(), [
                        'tituloNoticia' => 'required|string',
                        'cuerpoNoticia' => 'required|string'
                    ]);

                    $noticia->tituloNoticia = $tituloNoticia;
                    $noticia->cuerpoNoticia = $request->input('cuerpoNoticia');
                    //$noticia->fechaNoticia = date("Y-m-d");
                    $noticia->idBlog = $blog->id;
                    $noticia->noticiaPublica = $request->input('noticiaPublica');
                    $noticia->save();

                    return redirect( url('/'.$tituloBlog.'/gestionarBlog/gestionarNoticias') );

                }

            }

        } else {
            return redirect('/');
        }
    }

    // Eliminar noticia

    public function delete_Noticia($tituloBlog, $idNoticia)
    {
        
        $conexionBlog = new Blog;
        $conexionUsuario = new Usuari;
        //$conexionNoticia = new Noticia;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);
        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);

        if (session()->get('usuario') == $usuario->usuario) {
            //$noticia = $conexionNoticia->getNoticiaPorIDFirst($idNoticia);
            $noticia = Noticia::findOrFail($idNoticia);

            if ($noticia == null) {
                return redirect(url('/'.$tituloBlog.'/gestionarBlog/gestionarNoticias'));
            } else {

                Valoracion::eliminarValoracionesIDNoticia($noticia->id);
                Comentario::eliminarComentariosIDNoticia($noticia->id);

                Noticia::findOrFail($idNoticia)->delete();

                return redirect(url('/'.$tituloBlog.'/gestionarBlog/gestionarNoticias'));
            }

        }

    }


}
