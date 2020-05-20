@extends('layouts.blogs.masterBlog')

@section('body')


<div id="noticiacompleta">

    
    @foreach ($noticia as $n)
    
        <div id="tituloNoticia">
            <h2>{{$n->tituloNoticia}}</h2>
        </div>

        <div id="cuerpoNoticia">
            <p>{{$n->cuerpoNoticia}}</p>
        </div>

    @endforeach
    

</div>







@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@endsection