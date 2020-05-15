@extends('layouts.master')

@section('body')
    
<div id="div_principal">
    <h2>Crud Usuarios</h2>



    <table id="tabla_crud_Usuarios">
        <tr>
            <th>Usuario</th>
            <th>Rol Usuario</th>
            <th>Crud Usuario</th>
            <th>Crud Blogs Usuario</th>
        </tr>

        @foreach ($usuarios_sql as $users)
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
        </tr>
        @endforeach
    </table>

</div>






@endsection