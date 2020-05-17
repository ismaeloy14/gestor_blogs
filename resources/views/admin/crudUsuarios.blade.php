@extends('layouts.master')

@section('body')
    
{{-- Incluimos las ventanas modales --}}
@include('admin.showUsuario')

<div id="div_principal">
    <h2>Crud Usuarios</h2>


    @php
        $arrayAsocUsuarios = array();
    @endphp

    <table id="tabla_crud_Usuarios" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol Usuario</th>
                <th>Crud Usuario</th>
                <th>Crud Blogs Usuario</th>

            </tr>
        </thead>
        
        <tbody>

        

        {{--@foreach ($usuarios_sql as $users)
        <tr>
            <td>
                {{$users->usuario}}
            </td>
            <td>
                {{$users->rol}}
            </td>
            <td>
                <a class="btn btn-info" href="{{url('/crudUsuarios/verUsuario/' . $users->usuario)}}">Ver Perfil</a>
                <a class="btn btn-primary" href="{{url('/crudUsuarios/editarUsuario/' . $users->usuario)}}">Editar</a>
                <a class="btn btn-danger" href="{{url('/crudUsuarios/eliminarUsuario/' . $users->id)}}">Eliminar</a>
            </td>
            <td>
                @foreach ($blog_sql as $blog)
                    @if ($users->id == $blog->idUsuario)
                        <a class="btn btn-info" href="{{url('/crudUsuarios/infoBlog/' . $blog->id)}}">Ver información</a>
                        <a class="btn btn-primary" href="{{url('/crudUsuarios/editarBlog/' . $blog->id)}}">Editar</a>
                        <a class="btn btn-danger" href="{{url('/crudUsuarios/eliminarBlog/' . $blog->id)}}">Eliminar</a>
                    @endif
                @endforeach
                
            </td>
        </tr>--}}

        {{-- Pruebas del datatable --}}

        @foreach ($users as $u)
        
        <tr>
            <td>
                @php
                    $arrayAsocUsuarios["usuario".$u->id] = $u->id;
                @endphp
                
                {{$u->id}}
            </td>
            <td>{{$u->usuario}}</td>
            <td>{{$u->rol}}</td>

            

            <td>
                <button class="btn btn-info" name="modalShowUsuario" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Ver Perfil</button>
                <button class="btn btn-primary" name="modalEditUsuario" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Editar</button>
                <button class="btn btn-danger" name="modalShowDeleteUsuario" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Eliminar</button>
            </td>
                
            <td>
                @foreach ($blogs as $blog)
                    @if ($u->id == $blog->idUsuario)
                    
                        <button class="btn btn-info">Ver información</button>
                        <button class="btn btn-primary">Editar</button>
                        <button class="btn btn-danger">Eliminar</button>
                    
                        
                    @endif
                @endforeach
                
            </td>
        </tr>




        @endforeach
        </tbody>


    </table>

</div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    
    // Para ventanas modales

    $("button[name='modalShowUsuario']").on('click', function() {
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/showUsuario?id=' )}}";

        // Conexion ajax

        $.get(urlShow+idUser)
                .done(function(data){

                    console.log(data);


                }).fail(function(){
                    alert('Error a la hora de hacer la petición');
                });



        alert(' URL '+ urlShow + idUser);
    });
</script>






@endsection