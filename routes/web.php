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


Route::post('/registro/createUsuario', 'AuthController@post_create_usuario');

