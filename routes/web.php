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
Route::post('/registro/createUsuario', 'AuthController@post_create_usuario');

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

Route::get('/crudUsuarios/showUsuario', 'UsuarioController@modal_show_Usuario');
Route::get('/crudUsuarios/editUsuario', 'UsuarioController@modal_edit_usuario');
Route::get('/crudUsuarios/deleteUsuario', 'UsuarioController@modal_show_Usuario');

Route::put('/crudUsuarios/editUsuario/{id}', 'UsuarioController@modal_UsuarioEdit'); // modificar usuario
Route::post('/crudUsuarios/deleteUsuario/{id}', 'UsuarioController@modal_UsuarioDelete'); // eliminar usuario

/* Crud de usuarios */
Route::get('/crudUsuarios/verUsuario/{usuario}', 'UsuarioController@index_UsuarioShow');
Route::get('/crudUsuarios/editarUsuario/{usuario}', 'UsuarioController@index_UsuarioEdit');
Route::get('/crudUsuarios/eliminarUsuario/{id}', 'UsuarioController@index_UsuarioDelete');


Route::put('/crudUsuarios/editarUsuario/{usuario}', 'UsuarioController@put_UsuarioEdit');

/* Crud de blogs */
Route::get('/crudUsuarios/infoBlog/{id}', 'BlogController@index_BlogInfo');
Route::get('/crudUsuarios/editarBlog/{id}', 'BlogController@index_BlogEdit');
Route::get('/crudUsuarios/eliminarBlog/{id}', 'BlogController@index_BlogDelete');

// Rutas de blogs

Route::get('/{tituloBlog}', 'BlogController@index_blog');
Route::get('/{tituloBlog}/{tituloNoticia}', 'BlogController@show_Noticia_Completa' );





