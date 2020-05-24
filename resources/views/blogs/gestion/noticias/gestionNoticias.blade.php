@extends('layouts.blogs.masterBlog')

@section('body')

@include('blogs.gestion.noticias.deleteNoticia')

<div id="div_principal">

    <h2>Gestionar noticias</h2>

    @if ($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif

    <table id="tabla_crud_Noiticias" class="table">
        <thead>
            <tr>
                <th>Fecha de creación</th>
                <th>Notícia</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($noticias as $noticia)
                
            <tr>

                <td>{{$noticia->fechaNoticia}}</td>
                <td>{{$noticia->tituloNoticia}}</td>
                <td>
                    <a class="btn btn-info" href="{{url('/'.$blog->tituloBlog.'/'.$noticia->tituloNoticia)}}">Ver noticia</a>
                    <a class="btn btn-primary" href="{{url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias/'.$noticia->tituloNoticia)}}">Editar noticia</a>
                    
                    <button class="btn btn-danger" name="modalDeleteNoticia" data-toggle="modal" value="{{$noticia->id}}">Eliminar</button>
                </td>

            </tr>

            @endforeach
            
        </tbody>

    </table>


</div>

<div id="botonCrearNoticia">
    <a class="btn btn-success" href="{{url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias/crearNoticia')}}">Crear Noticia</a>
</div>


@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<script>

    $('button[name=modalDeleteNoticia]').on('click', function(){
        var idNoticia = this.value;
        var urlShow = "{{ url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias/showDeleteNoticia?id=' )}}";
        var urlForm = "{{ url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias/deleteNoticia/' )}}";
        var urlFormCompleta = urlForm+'/'+idNoticia;

        $.get(urlShow+idNoticia)
            .done(function(data) {
                console.log(data);
                $('#formDeleteNoticia').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente
                $('#deletetituloNoticia').text(data[0].tituloNoticia);


                $("#deleteModalNoticia").modal('toggle');
                $('#deleteModalNoticia').modal('show');

            }).fail(function(){
                alert('No se ha podido cargar la ventana modal de delete noticia');
            });

    });

</script>



@endsection