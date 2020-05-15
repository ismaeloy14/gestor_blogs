<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuari;
use App\User;
use App\Blog;
use Auth;

class UsuarioController extends Controller
{
    /**
     * Devuelve la vista del usuario seleccionado
     *
     * @return \Illuminate\Http\Response
     */
    public function index_UsuarioShow($usuario_retornado)
    {
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuario($usuario_retornado);

        //return print_r($user);
        return view('usuarios.showUsuario', array('user' => $user));

    }

    // Devuelve la vista del modficar perfild del usuario seleccionado
    public function index_UsuarioEdit($usuario_retornado){
        $usuario = new Usuari;

        $user = $usuario->soloUnUsuario($usuario_retornado);

        $mismoUsuario = false;

        foreach($user as $u){
            if(session()->get('usuario') == $u->usuario){
                $mismoUsuario = true;
            }
        }

        // Comprobamos si es el mismo usuario o si es el usuario admin
        if(($mismoUsuario == true) || (session()->get('rol') == 'admin')){

            //return print_r($user);
            return view('usuarios.editUsuario', array('user' => $user));

        } else {

            return redirect('/');
        }

    }

    public function put_UsuarioEdit(Request $request, $usuario_retornado) {
        $usuario = new Usuari;

        $todosUsuarios = $usuario->todosUsuarios();
        $user = $usuario->soloUnUsuario($usuario_retornado);

        $usuarioRepetido = false;
        $emailRepetido = false;
        $mismoUsuario = false;

        $id = null; // Sera la id de nuestro usuario


        foreach($user as $u){ // Comprueba si el nombre del usuario de esta sesion sea igual al usuario de la base de datos.
            if(session()->get('usuario') == $u->usuario){
                $mismoUsuario = true;
            }

            $id = $u->id;
        }

        $users = Usuari::findOrFail($id); // Busco el usuario por su id





        // Comprueba si el email y usuario se repiten en la base de datos.
        foreach($todosUsuarios as $todosU){
            if ($todosU->usuario === $request->input('usuario')) {
                if ($todosU->id == session()->get('idUsuario')) {

                    $usuarioRepetido = false;
             
                } else if (session()->get('rol') == 'admin') {

                    $usuarioRepetido = false;

                } else {

                    $usuarioRepetido = true;
                }
            }
            if ($todosU->email === $request->input('email')) {
                if ($todosU->id == session()->get('idUsuario')) {

                    $emailRepetido = false;

                } else if (session()->get('rol') == 'admin') {

                    $emailRepetido = false;

                } else {

                    $emailRepetido = true;
                }
                
            }
        }

        // Comprobamos si es el mismo usuario o si es el usuario admin
        if(($mismoUsuario == true) || (session()->get('rol') == 'admin')){
            if ($usuarioRepetido == false) {
                if ($emailRepetido == false) {

                    $this->validate(request(), [
                        'usuario' => 'required',
                        'email' => 'required|email',
                        'nombre' => 'required',
                        'apellidos' => 'required',
                        'fechaNacimiento' => 'nullable|date',
                        'pais' => 'nullable|string',
                        'imagenPerfil' => 'nullable|image'
                    ]);

                      
                    $users->usuario = $request->input('usuario');
                    $users->email = $request->input('email');
                    $users->nombre = $request->input('nombre');
                    $users->apellidos = $request->input('apellidos');
                    $users->fechaNacimiento = $request->input('fechaNacimiento');
                    $users->pais = $request->input('pais');
                    $users->imagenPerfil = $request->input('imagenPerfil');
                    $users->save();

                    return redirect('/');


                } else {
                    return back()->withErrors(['El email ya existe']);
                }

            } else {
                return back()->withErrors(['El usuario ya existe']);
            }

        } else {

            return back();
        }

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
