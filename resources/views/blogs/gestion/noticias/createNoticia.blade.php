@extends('layouts.blogs.masterBlog')

@section('body')


<div id="createUpdateNoticia">

    <h2>Crear noticia</h2>

    <form action="{{url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias/createNoticia')}}" method="post" id="formulario_create_edit_noticia">
        {{ csrf_field() }}

        @if ($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif

        <label>
            <span>Título de la notícia: </span>
            <input type="text" name="tituloNoticia" id="tituloNoticia" required>
        </label>

        <label id="labelCuerpoNoticia">
            {{--<span>Cuerpo de la notícia</span>--}}
            <textarea name="cuerpoNoticia" id="cuerpoNoticia" cols="30" rows="10"></textarea>
        </label>

        <label>
            <span>¿Notícia púbica?</span>
            <select name="noticiaPublica" id="noticiaPublica">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </label>

        <div>
            <button type="submit" class="btn btn-success">Crear notícia</button>
            <a href="{{url('/'.$blog->tituloBlog.'/gestionarBlog/gestionarNoticias')}}" class="btn btn-danger">Cancelar</a>
        </div>

    </form>


</div>


@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('cuerpoNoticia');
</script>


@endsection