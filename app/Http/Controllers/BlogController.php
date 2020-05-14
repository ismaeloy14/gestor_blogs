<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Categoria;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_creacion()
    {
        $categorias = new Categoria;
        $categoria = $categorias->todasCategorias();
        return view('blogs.crearBlog', array('categorias' => $categoria));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post_createBlog(Request $request)
    {
        $blog = new Blog;
        $todosBlogs = $blog->todosBlogs();

        $usuario_logueado = Auth::user();

        $titulo = $request->input('tituloBlog');
        $longitud_titulo = strlen($titulo);

        $existeUsuario = false;

        foreach($todosBlogs as $b){ // Para los nombres de usuarios
            if($b->idUsuario === $usuario_logueado->id){
                $existeUsuario = true;
            }
        }

        if ($existeUsuario == false) {
            
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
                        'imagenBlog' => 'image'
                    ]);
        
                    $blog->tituloBlog = $titulo;
                    $blog->imagenBlog = $request->input('imagen_blog');
                    $blog->idUsuario = $usuario_logueado->id;
                    $blog->blogPublico = $request->input('publico');
                    $blog->categoria = $request->input('categoria');
                    $blog->save();

                    return redirect('/');

                }
    
            }

        } else {

            return back()->withErrors(['Ya tienes un blog creado. No puedes hacer otro']);

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
