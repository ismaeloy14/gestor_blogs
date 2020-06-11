@extends('layouts.master')

@section('body')
    
    <div id="div_showUsuario">

            <div>
                <img src="{{asset('imagenes/perfil/'.$user->imagenPerfil) }}" alt="Imagen de perfil" id="imagen_perfil_show_edit">
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

            @if ($user->twitter != null)
                <span><b>Twitter:</b> 
                    <a href="{{$user->twitter}}" target="_blank">Tu perfil Twitter</a> 
                </span>           
            @endif

            @if ($user->facebook != null)
                <span>
                    <b>Facebook:</b> 
                    <a href="{{$user->facebook}}" target="_blank">Tu perfil Facebook</a>
                </span>           
            @endif

            @if ($user->instagram != null)
                <span>
                    <b>Instagram:</b> 
                    <a href="{{$user->instagram}}" target="_blank">Tu perfil Instagram</a>
                </span>           
            @endif

            @if ($user->paginaWeb != null)
                <span><b>Página Web:</b> <a href="{{$user->paginaWeb}}" target="_blank">{{$user->paginaWeb}}</a></span>           
            @endif

            {{-- Para comprobar si eres el propio usuario --}}
            @if (session()->get('usuario') == $user->usuario)
            
            <div id="botonEditarPerfilImagen">
                <div>
                    <a class="btn btn-primary" href="{{url('/editarUsuario/'. $user->usuario)}}">Editar perfil</a>
                </div>
                <div>
                    <a class="btn btn-warning" href="{{url('/editarImagen/'. $user->usuario)}}">Cambiar avatar</a>
                </div>
                <div>
                    <a class="btn btn-dark" href="{{url('/cambiarContrasena/'. $user->usuario)}}">Cambiar contraseña</a>
                </div>
            </div>

            @endif           
        

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection