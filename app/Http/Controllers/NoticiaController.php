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


        $usuario = $conexionUsuario->soloUnUsuarioIDFirst($blog->idUsuario);
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia);

        //return print($usuario->usuario);

        if ($noticia->noticiaPublica == 1) {
            return view('blogs.noticias.showNoticia', compact('blog', 'noticia', 'usuario'));
        } else {

            if ((session()->get('usuario') == $usuario->usuario) || (session()->get('rol') == 'admin')) {
                return view('blogs.noticias.showNoticia', compact('blog', 'noticia', 'usuario'));
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
        $noticias = $conexionNoticia->noticiaIDblogNormal($blog->id);
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
