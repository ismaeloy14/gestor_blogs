@extends('layouts.blogs.masterBlog')

@section('body')
    <div id="div_noticias">

        @foreach ($noticias as $noticia)

            @if ($noticia->noticiaPublica == 1)

                @foreach ($blog as $b)
                <a href="{{url('/'.$b->tituloBlog.'/'.$noticia->tituloNoticia)}}" class="noticiasDivs">
                @endforeach
                    
                    <img src="{{asset('imagenes/noticia/'.$noticia->imagenNoticia)}}" alt="Imagen de la noticia">
                    <h4>{{$noticia->tituloNoticia}}</h4>
                    
                    @php
                        echo '<span>'. mb_strimwidth($noticia->cuerpoNoticia, 0, 200, '...') .'</span>'; // Es para cortar la cadena de texto que saldra en los divs
                    @endphp
                </a>
            @endif

            
        @endforeach

    </div>

    <div id="div_menu_lateral">

    </div>

@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@endsection