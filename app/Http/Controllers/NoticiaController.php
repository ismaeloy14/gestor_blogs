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

        /*$comentariosUsuarios = null;
        $arrayUsuariosComentarios = [];
        $contador = 0;


        foreach ($comentarios as $comentario) {
            $arrayUsuariosComentarios[$contador] = $conexionUsuario->soloUnUsuarioID($comentario->idUsuario);
            $contador ++;
        }

        foreach ($arrayUsuariosComentarios[1] as $array) {
            return print_r($array->cuerpo);
        }

        return print_r($arrayUsuariosComentarios);*/
        

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
