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
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

    </div>

@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    
@endsection