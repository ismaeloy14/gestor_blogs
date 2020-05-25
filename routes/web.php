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
Route::get('/usuario/{usuario}', 'UsuarioController@show_Usuario'); // Lleva al perfil del usuario
Route::get('/editarUsuario/{usuario}', 'UsuarioController@index_UsuarioEdit'); // Muestra la vista del editar usuario
Route::get('/cambiarContrasena/{usuario}', 'UsuarioController@index_UsuarioEditContrasena'); // Cambiar contraseña del mismo usuario
Route::get('/editarImagen/{usuario}', 'UsuarioController@index_UsuarioEditAvatar');

Route::put('/editarUsuario/{usuario}', 'UsuarioController@put_UsuarioEdit'); // Actualiza el usuario
Route::put('/cambiarContrasena/{usuario}', 'UsuarioController@put_UsuarioEditContrasena'); // Actualiza la contraseña de un usuario
Route::post('/editarImagen/{usuario}', 'UsuarioController@put_UsuarioEditAvatar'); // Actualiza el avatar / imagen de perfil del usuario



// Páginas de admin
Route::get('/crudUsuarios', 'AuthController@index_crudUsuarios'); // Para ir al crud principal

// Ventanas modales ADMIN \\

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

// END VENTANAS MODALES ADMIN \\


// Rutas de blogs
Route::get('/{tituloBlog}', 'BlogController@index_blog');
Route::get('/{tituloBlog}/gestionarBlog', 'BlogController@gestionar_blog');
Route::get('/{tituloBlog}/gestionarBlog/editarBlog', 'BlogController@edita_Blog');

Route::put('/{tituloBlog}/gestionarBlog/editarBlog/{id}', 'BlogController@put_edita_Blog');

// Rutas noticias
Route::get('/{tituloBlog}/{tituloNoticia}', 'NoticiaController@show_Noticia_Completa' );
Route::post('/{tituloBlog}/{tituloNoticia}/createComentario', 'NoticiaController@post_Comentario'); // Inserta un comentario en la base de datos


Route::get('/{tituloBlog}/gestionarBlog/gestionarNoticias', 'NoticiaController@index_gestionarNoticias'); // Abre el crud de noticias
Route::get('/{tituloBlog}/gestionarBlog/gestionarNoticias/crearNoticia', 'NoticiaController@view_create_Noticia'); // Redirige a la pagina para crear la noticia
Route::get('/{tituloBlog}/gestionarBlog/gestionarNoticias/{tituloNoticia}', 'NoticiaController@view_update_Noticia'); // Redirige a la pagina para editar la noticia
Route::get('/{tituloBlog}/gestionarBlog/gestionarNoticias/showDeleteNoticia', 'NoticiaController@modal_delete_Noticia'); // Ejecuta la ventana modal de delete

Route::post('/{tituloBlog}/gestionarBlog/gestionarNoticias/createNoticia', 'NoticiaController@createNoticia'); // Crea la noticia
Route::put('/{tituloBlog}/gestionarBlog/gestionarNoticias/{tituloNoticia}', 'NoticiaController@updateNoticia'); // Actualiza la noticia
Route::post('/{tituloBlog}/gestionarBlog/gestionarNoticias/deleteNoticia/{id}', 'NoticiaController@delete_Noticia'); // Elimina la noticia







