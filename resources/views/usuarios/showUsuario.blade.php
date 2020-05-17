@extends('layouts.master')

@section('body')
    
    <div id="div_showUsuario">

        <div>
            <img src="" alt="Imagen de perfil" id="imagen_perfil_show_edit">
        </div>

        <div>
            @foreach ($user as $user)
                <span>Usuario: {{$user->usuario}}</span>
                <span>Rol: {{$user->rol}}</span>
                <span>Nombre: {{$user->nombre}}</span>
                <span>Apellidos: {{$user->apellidos}}</span>
                <span>Email: {{$user->email}}</span>

                @if ($user->fechaNacimiento != null)
                    <span>Fecha de nacimiento: {{$user->fechaNacimiento}}</span>
                @endif

                @if ($user->pais != null)
                    <span>Pais de origen: {{$user->pais}}</span>           
                @endif

                {{-- Para comprobar si eres un administrador o eres el propio usuario --}}
                @if ((session()->get('rol') == 'admin') || (Auth::user()->usuario == $user->usuario))

                    <a class="btn btn-primary" href="{{url('/editarUsuario/'. $user->usuario)}}">Editar perfil</a>

                @endif
                
                
            @endforeach
            
        </div>

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection