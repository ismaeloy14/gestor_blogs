@extends('layouts.master')

@section('body')
    

    <div id="div_login">
        <h2>
            Login
        </h2>
        <form method="POST" action="">
            <label id="login_usuario">
                <span>Usuario</span>
                <input type="text">
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password">
            </label>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>

    </div>

    
    
@endsection