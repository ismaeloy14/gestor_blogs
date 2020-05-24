@extends('layouts.blogs.masterBlog')

@section('body')

<div id="gestionBlog">

    <h2>Información blog</h2>
        <span><b>Título:</b> {{$blog->tituloBlog}}</span>
        <span><b>Categoria:</b> {{$blog->categoria}}</span>
        <span><b>Público:</b> 
            @if ($blog->blogPublico == 1)
                Es Público
            @else
                No es público
            @endif
        </span>
        
        {{-- Para comprobar si eres el propio usuario --}}
        @if (session()->get('usuario') == $usuario->usuario)
        
        <div id="botonGestionarBlog">
            <div>
                <a class="btn btn-primary" href="{{url('/'.$blog->tituloBlog.'/gestionarBlog/editarBlog')}}">Editar blog</a>
            </div>
            <div>
                <a class="btn btn-warning" href="{{url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias')}}">Gestionar noticias</a>
            </div>
        </div>

        @endif

</div>

@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection