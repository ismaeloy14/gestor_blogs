@extends('layouts.master')

@section('body')
    
<div id="div_principal">
    <h2>Crud Usuarios</h2>



    <table id="tabla_crud_Usuarios" class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Rol Usuario</th>
                <th>Crud Usuario</th>
                <th>Crud Blogs Usuario</th>

            </tr>
        </thead>
        
        {{--<tbody>

        

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
            <td>{{$u->usuario}}</td>
            <td>{{$u->rol}}</td>
            <td>
                <button class="btn btn-info" form="{{$u->id}}">Ver Perfil</button>
                <button class="btn btn-primary">Editar</button>
                <button class="btn btn-danger">Eliminar</button>
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

{{--
<script>
    //$('#tabla_crud_Usuarios').ready(function() {
        $('#tabla_crud_Usuarios').DataTable({
            "serverSide": true, // Procesa la consulta php del lado servidor
            "ajax": {{ url('api/crudUsuarios')}},
            "columns": [
                {data: 'usuario'},
                {data: 'rol'},
            ]
        });
    //} );
</script>--}}









@endsection