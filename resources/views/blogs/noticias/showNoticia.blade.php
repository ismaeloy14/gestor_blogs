@extends('layouts.blogs.masterBlog')

@section('body')


<div id="noticiacompleta">

    
        <div id="tituloNoticia">
            <h2>{{$noticia->tituloNoticia}}</h2>
        </div>

        <div id="cuerpoNoticia">
            <p id="parrafoCuerpoNoticia">
                @php
                    echo $noticia->cuerpoNoticia;
                @endphp
                
            </p>
        </div>
    

</div>







@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection