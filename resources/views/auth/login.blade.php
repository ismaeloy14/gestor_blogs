@extends('layouts.master')

@section('body')
    

    <div id="div_login">
        <h2>
            Login
        </h2>
    <form method="POST" action="{{url('/login/verificando')}}">

        {{ csrf_field() }}
        
            @if ($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            <label>
                <span>Usuario</span>
                <input type="text" name="usuario" required>
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password" name="password" required>
            </label>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>

    </div>

    
    
@endsection