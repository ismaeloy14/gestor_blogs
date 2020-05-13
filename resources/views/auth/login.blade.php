@extends('layouts.master')

@section('body')
    

    <div id="div_login">
        <h2>
            Login
        </h2>
        <form method="POST" action="">
            <label>
                <span>Usuario</span>
                <input type="text" name="usuario">
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password" name="password">
            </label>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>

    </div>

    
    
@endsection