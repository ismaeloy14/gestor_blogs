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

        <div id="puntuacionNoticia">
            <button type="button" name="botonPuntuacionNoticia" class="btn btn-default btn-sm"><i class="fas fa-thumbs-up"></i></button>
            <span id="puntuacionTotalNoticia"></span>
        </div>


        <div id="seccionComentarios">
            <h3>Comentarios</h3>

            <div id="crearComentario">
                <form action="{{url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia.'/createComentario')}}" method="post" id="formComentario">
                    {{ csrf_field() }}

                    @if (session()->get('usuario') != null)
                        <input type="hidden" name="usuario" value="{{session()->get('usuario')}}" id="usuarioComentario" required>
                        <span><b>Nombre de usuario:</b> {{session()->get('usuario')}}</span>
                        <label>
                            <span><b>Tu comentario</b></span>
                            <textarea name="cuerpoComentario" id="cuerpoComentario" cols="30" rows="5"></textarea>
                        </label>
                        <div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    @else
                        <span><b>Tu email:</b></span>
                        <input type="email" name="email" id="emailComentario" required>
                        <span><b>Tu comentario</b></span>
                        <label>
                            <textarea name="cuerpoComentario" id="cuerpoComentario" cols="30" rows="5"></textarea>
                        </label>
                        <div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    @endif

                </form>

                @foreach ($comentarios as $comentario) {{-- Comentarios --}}
                    <hr id="separador">
                    <div class="comentarios">
                        @if ($comentario->idUsuario == null)
                            <span><b>Email:</b> {{$comentario->email}}</span>
                            <p>{{$comentario->comentario}}</p>
                        @else
                            @foreach ($allUsuarios as $user)
                                @if ($user->id == $comentario->idUsuario)
                                    <span><b>Usuario:</b> {{$user->usuario}}</span>
                                    <p>{{$comentario->comentario}}</p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
                

            </div>


        </div>
    

</div>


@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

    $('#puntuacionTotalNoticia').ready(function() {
        var urlDeConexion = "{{ url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia.'/coger') }}";

        $.get(urlDeConexion)
            .done(function(data) {
                //console.log(data);

                $('#puntuacionTotalNoticia').text(data);

            }).fail(function(){
                alert('No se ha podido hacer la conexion para sumar un punto a la noticia');
            });
    });


    $('button[name=botonPuntuacionNoticia]').on('click', function(){

        var puntuacionNoticia = $('#puntuacionTotalNoticia').text();

        var urlDeConexion = "{{ url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia.'/sumar?puntuacionNoticia=') }}";

        var urlCompleta = urlDeConexion+puntuacionNoticia;

        //console.log(urlCompleta);

        $.get(urlCompleta)
            .done(function(data) {
                console.log(data);

                $('#puntuacionTotalNoticia').text(data);

            }).fail(function(){
                alert('No se ha podido hacer la conexion para sumar un punto a la noticia');
            });

    });
</script>

@endsection