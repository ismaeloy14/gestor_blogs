@extends('layouts.master')

@section('body')


    <div id="div_indexBlogs">

        @foreach ($blogs as $blog)

            @if ($blog->blogPublico == 1)

                <a href="{{url('/'.$blog->tituloBlog)}}" class="blogsDivs">
                
                    <img src="{{asset('imagenes/blog/'.$blog->imagenBlog)}}" alt="Imagen del blog">
                    <h4>{{$blog->tituloBlog}}</h4>
                    
                    <span><b>Categoria:</b> {{$blog->categoria}}</span>
                    
                </a>
            @endif

            
        @endforeach

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@endsection