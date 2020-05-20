@extends('layouts.master')

@section('body')
    
    <div id="div_showUsuario">
        @foreach ($user as $user)
        {{--
        <div>
            <img src="" alt="Imagen de perfil" id="imagen_perfil_show_edit">
        </div>
        --}}

            <div>
                <img src="{{asset('imagenes/perfil/'.session()->get('imagenPerfil')) }}" alt="Imagen de perfil" id="imagen_perfil_show_edit">
            </div>
            <span><b>Usuario:</b> {{$user->usuario}}</span>
            <span><b>Rol:</b> {{$user->rol}}</span>
            <span><b>Nombre:</b> {{$user->nombre}}</span>
            <span><b>Apellidos:</b> {{$user->apellidos}}</span>
            <span><b>Email:</b> {{$user->email}}</span>

            @if ($user->fechaNacimiento != null)
                <span><b>Fecha de nacimiento:</b> {{$user->fechaNacimiento}}</span>
            @endif

            @if ($user->pais != null)
                <span><b>Pais de origen:</b> {{$user->pais}}</span>           
            @endif

            {{-- Para comprobar si eres un administrador o eres el propio usuario --}}
            @if ((session()->get('rol') == 'admin') || (Auth::user()->usuario == $user->usuario))
            <div id="botonEditarPerfilImagen">
                <div>
                    <a class="btn btn-primary" href="{{url('/editarUsuario/'. $user->usuario)}}">Editar perfil</a>
                </div>
                <div>
                    <a class="btn btn-warning" href="{{url('/editarImagen/'. $user->usuario)}}">Cambiar avatar</a>
                </div>
            </div>

            @endif
                
                
        @endforeach
            
        

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection