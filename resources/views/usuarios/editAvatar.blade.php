@extends('layouts.master')

@section('body')
    

<div id="div_editImagenPerfil">

    <div>
        <h2>Cambiar imagen de perfil</h2>

                <form action="{{url('/editarImagen/'.$user->usuario)}}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    
                    @if ($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif
                    
                    <label>
                        <input type="file" name="imagenUsuario" accept="image/*">
                    </label>

                    <div>
                        <button class="btn btn-success" type="submit">Guardar cambios</button>
                        <a href="{{url('/usuario/'.$user->usuario)}}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
        
    </div>

</div>

@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>




@endsection