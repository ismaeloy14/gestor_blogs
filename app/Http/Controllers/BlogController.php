<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Categoria;
use App\Noticia;
use App\Usuari;
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

    public function index_blog($tituloblog) {
        $consexionblog = new Blog;
        $consexionUsuario = new Usuari;
        $conexionNoticia = new Noticia;

        $blog = $consexionblog->blogNombre($tituloblog);

        foreach ($blog as $b) {
            $usuarioBlogID = $b->idUsuario;
            $blogID = $b->id;
        }
        
        $usuario = $consexionUsuario->soloUnUsuarioID($usuarioBlogID);
        $noticias = $conexionNoticia->noticiaIDblog($blogID);

        return view('indexBlogs', compact('blog', 'usuario', 'noticias'));


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
        $nombreImagen = null;

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
                        'imagenBlog' => 'string|image'
                    ]);

                    // En este IF se crea el fichero en la carpeta publica de imagenes/blog y se guarda el nombre del fichero para luego integrarlo a la base de datos.
                    if ($request->file('imagen_blog') != null){ 
                        $iBlog = $request->file('imagen_blog');
                        $iExtension = $request->file('imagen_blog')->getClientOriginalExtension();
                        $nombreFichero = time() . '.' . $iExtension; // getClientOriginalExtension pilla la extension del fichero subido
                        Image::make($iBlog)->resize(250,100)->save(public_path('/imagenes/blog/'.$nombreFichero));
            
                        $nombreImagen = $nombreFichero;
                    }
        
                    $blog->tituloBlog = $titulo;
                    $blog->imagenBlog = $nombreImagen;
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
