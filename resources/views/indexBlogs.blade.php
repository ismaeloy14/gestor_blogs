@extends('layouts.blogs.masterBlog')

@section('body')
    <div id="div_noticias">

        @foreach ($noticias as $noticia)

            @if ($noticia->noticiaPublica == 1)
                <a href="" class="noticiasDivs">
                    <img src="" alt="">
                </a>
            @endif

            
        @endforeach

    </div>

    <div id="div_menu_lateral">

    </div>

@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@endsection