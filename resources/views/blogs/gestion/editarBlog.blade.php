@extends('layouts.blogs.masterBlog')

@section('body')

<div id="gestionBlog">

    <form action="{{url('/'.$blog->tituloBlog.'/gestionarBlog/editarBlog/'.$blog->id)}}" method="post" id="gestionarBlog">
    
        {{method_field('PUT')}}

        {{ csrf_field() }}

        <h2>Editar blog</h2>
    
        @if ($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
    
        <label>
            <span><b>Titulo: </b> </span>
            <input type="text" name="tituloBlog" id="titulo_blog" min="3" max="20" value="{{$blog->tituloBlog}}" required>
        </label>

        <label>
            <span><b>Categoria: </b> </span>
            <select name="categoria" required>
                @foreach ($categorias as $categoria)

                    @if ($categoria->categoria == $blog->categoria)
                        <option value="{{$categoria->categoria}}" selected>{{$categoria->categoria}}</option>
                    @else
                        <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                    @endif    

                @endforeach
            </select>
        </label>

        <label>
            <span><b>Público: </b> </span>
            <select name="publico" id="publico" required>

                @if ($blog->blogPublico == 1)
                    <option value="1" selected>Público</option>
                    <option value="0">No público</option>
                @else
                    <option value="0" selected>No público</option>
                    <option value="1">Público</option>
                @endif

            </select>
        </label>

        <div>
            <button class="btn btn-success" type="submit">Guardar cambios</button>
            <a href="{{url('/'.$blog->tituloBlog.'/gestionarBlog')}}" class="btn btn-danger">Cancelar</a>
        </div>
    
    </form>

</div>

@include('layouts.blogs.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection