<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('index');
});*/

Route::get('/', 'IndexController@index');

Route::get('/login', 'AuthController@index_login');
Route::get('/registro', 'AuthController@index_registro');
Route::get('/logout', 'AuthController@index_logout');



// Formulario de registro de usuarios
Route::post('/registro/createUsuario', 'UsuarioController@post_create_usuario');

// Verificando el login
Route::post('/login/verificando', 'AuthController@post_login_usuario');

// Creacion y verificación del blog
Route::get('/creacionBlog', 'BlogController@index_creacion');
Route::post('/creacionBlog/validando', 'BlogController@post_createBlog');


// Páginas para usuarios
Route::get('/usuario/{usuario}', 'UsuarioController@show_Usuario');
Route::get('/editarUsuario/{usuario}', 'UsuarioController@index_UsuarioEdit');

Route::put('/editarUsuario/{usuario}', 'UsuarioController@put_UsuarioEdit');



// Páginas de admin
Route::get('/crudUsuarios', 'AuthController@index_crudUsuarios'); // Para ir al crud principal


// Ventanas modales

/* Crud de usuarios */
Route::get('/crudUsuarios/showUsuario', 'UsuarioController@modal_show_Usuario'); // Modal show usuario
Route::get('/crudUsuarios/showCreateUsuario', 'UsuarioController@modal_create_Usuario'); // Modal create usuario
Route::get('/crudUsuarios/editUsuario', 'UsuarioController@modal_edit_usuario'); // Modal edit usuario
Route::get('/crudUsuarios/deleteUsuario', 'UsuarioController@modal_show_Usuario'); // Modal delete usuario


Route::post('/crudUsuarios/createUsuario', 'UsuarioController@post_create_usuario'); // Crear usuario (admin)
Route::put('/crudUsuarios/editUsuario/{id}', 'UsuarioController@modal_UsuarioEdit'); // modificar usuario (admin)
Route::post('/crudUsuarios/deleteUsuario/{id}', 'UsuarioController@modal_UsuarioDelete'); // eliminar usuario (admin)



/* Crud de blogs */
Route::get('/crudUsuarios/showCreateBlog', 'BlogController@modal_create_Blog'); // Modal crear blog
Route::get('/crudUsuarios/showBlog', 'BlogController@modal_show_delete_Blog'); // Modal show blog
Route::get('/crudUsuarios/showEditBlog', 'BlogController@modal_edit_Blog'); // Modal edit blog
Route::get('/crudUsuarios/showDeleteBlog', 'BlogController@modal_show_delete_Blog'); // Modal delete blog

Route::post('/crudUsuarios/createBlog', 'BlogController@modal_post_create_blog'); // Crear el blog (admin)
Route::put('/crudUsuarios/editBlog/{id}', 'BlogController@modal_put_edit_Blog'); // Edita un blog (admin)
Route::post('/crudUsuarios/deleteBlog/{id}', 'BlogController@modal_post_delete_Blog'); // elimina un blog (admin)



// Rutas de blogs

Route::get('/{tituloBlog}', 'BlogController@index_blog');
Route::get('/{tituloBlog}/{tituloNoticia}', 'BlogController@show_Noticia_Completa' );





