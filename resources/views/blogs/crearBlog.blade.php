@extends('layouts.master')

@section('body')


<div id="div_principal">
    <div id="div_creacion_blog">
        <h2>Crea tu Blog</h2>

        <form method="post" action="{{url('/creacionBlog/validando')}}" id="formulario_creacion_blog" enctype="multipart/form-data">

            {{ csrf_field() }}

            @if ($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            <label>
                <span>Título del blog</span>
                <input type="text" name="tituloBlog" id="titulo_blog" min="3" max="20" required>
            </label>

            <label>
                <span>Categoria del blog</span>
                <select name="categoria" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->categoria}}">{{$categoria->categoria}}</option>
                    @endforeach
                </select>
            </label>

            <label>
                <span>¿Quieres que sea público?</span>
                {{--<div>

                    <label><input type="radio" name="publico" value=1 required><span>Sí</span></label>
                    <label><input type="radio" name="publico" value=0 required><span>No</span></label>

                </div>--}}

                <select name="publico">
                    <option value="1">Público</option>
                    <option value="0">No público</option>
                </select>
            </label>

            <label id="label_input_image">
                <input type="file" name="imagen_blog" accept="image/*" id="inputFile">
            </label>

            <button type="submit" class="btn btn-primary">
                Crear blog
            </button>
                
            
        </form>
    </div>
    

</div>

@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection