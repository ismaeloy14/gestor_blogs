<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Noticia;
use App\Usuari;

class NoticiaController extends Controller
{


    public function show_Noticia_Completa($tituloBlog, $tituloNoticia) {

        $conexionBlog = new Blog;
        $conexionNoticia = new Noticia;
        $conexionUsuario = new Usuari;

        $blog = $conexionBlog->blogNombreFirst($tituloBlog);


        $usuario = $conexionUsuario->soloUnUsuarioID($blog->id);
        $noticia = $conexionNoticia->soloUnaNoticia($blog->id, $tituloNoticia);


        return view('blogs.noticias.showNoticia', compact('blog', 'noticia', 'usuario'));

    }







    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
