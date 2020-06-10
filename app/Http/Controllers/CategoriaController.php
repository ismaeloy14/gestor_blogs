<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Categoria;

class CategoriaController extends Controller
{

    public function index_administrarCategorias()
    {
        $categorias = Categoria::all();

        if(session()->get('rol') == 'admin') {
            return view('admin.categorias.indexCategorias', compact('categorias'));
        } else {
            return back();
        }

    }

    // VENTANAS MODALES

    public function modal_createCategorias() // ejecuta el ajax para el modal de crear categorias
    {
        return[];
    }

    public function modal_editCategorias() // ejecuta el ajax para el modal de editar categorias
    {
        $conexionCategoria = new Categoria;

        $nombreCategoria = filter_input(INPUT_GET, 'categoria');

        $categoria = $conexionCategoria->unaCategoria($nombreCategoria);

        return [$categoria];
    }

    public function modal_deleteCategorias() // ejecuta el ajax para el modal de eliminar categorias
    {
        $conexionCategoria = new Categoria;

        $nombreCategoria = filter_input(INPUT_GET, 'categoria');

        $categoria = $conexionCategoria->unaCategoria($nombreCategoria);

        return [$categoria];
    }



    // Crud de categorias

    public function modal_post_createCategoria(Request $request) // ejecuta la creación de una categoria desde el modal
    {
        $categoria = new Categoria;
        

        if (session()->get('rol') == 'admin') {

            $existeCategoria = $categoria->unaCategoria($request->input('categoria'));

            if ($existeCategoria == false) {

                $this->validate(request(), [
                    'categoria' => 'required|string'
                ]);
    
                $categoria->categoria = $request->input('categoria');
                $categoria->save();
    
                return redirect('/crudUsuarios/administrarCategorias');
                
            } else {
                return back()->withErrors(['La categoria insertada ya existe']);
            }

        } else {
            return redirect('/');
        }


    }

    public function modal_put_editCategoria(Request $request, $categoriaOriginal) // ejecuta la edición de una categoria desde el modal
    {
        $categoria = new Categoria;

        $conexionBlog = new Blog;
        

        if (session()->get('rol') == 'admin') {


            $this->validate(request(), [
                'categoria' => 'required|string'
            ]);
            
            $categoria->updateCategoria($categoriaOriginal, $request->input('categoria'));

            return redirect('/crudUsuarios/administrarCategorias');
        

        } else {
            return redirect('/');
        }


    }

    public function modal_post_deleteCategoria($categoriaRetornada)
    {

        $categoria = new Categoria;
        $conexionBlog = new Blog;


        if (session()->get('rol') == 'admin') {

            if ($categoriaRetornada == 'Sin categoria') {
                return back()->withErrors(['No se puede eliminar esta categoria']);
            } else {

                $conexionBlog->blogUpdateToNoCategoria($categoriaRetornada);

                $categoria->deleteCategoria($categoriaRetornada);

                return redirect('/crudUsuarios/administrarCategorias');

            }

        } else {
            return redirect('/');
        }
    }

    



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
