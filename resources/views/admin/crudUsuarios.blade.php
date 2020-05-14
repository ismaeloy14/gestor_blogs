@extends('layouts.master')

@section('body')
    
<div id="div_principal">
    <h2>Crud Usuarios</h2>



    <table id="tabla_crud_Usuarios">
        <tr>
            <td>Usuario</td>
            <td>Crud Usuario</td>
            <td>Crud Blogs Usuario</td>
        </tr>

        @foreach ($usuarios as $users)
        <tr>
            <td>
                {{$users->usuario}}
            </td>
            <td>
                <a class="btn btn-info" href="{{url('/crudUsuarios/verUsuario/' . $users->id)}}">Ver Perfil</a>
                <a class="btn btn-primary" href="{{url('/crudUsuarios/editarUsuario/' . $users->id)}}">Editar</a>
                <a class="btn btn-danger" href="{{url('/crudUsuarios/eliminarUsuario/' . $users->id)}}">Eliminar</a>
            </td>
            <td>
                @foreach ($blogs as $blog)
                    @if ($users->id == $blogs->id_usuario)
                        <a class="btn btn-info" href="{{url('/crudUsuarios/verBlog/' . $blogs->id)}}">Ver información</a>
                        <a class="btn btn-primary" href="{{url('/crudUsuarios/editarBlog/' . $blogs->id)}}">Editar</a>
                        <a class="btn btn-danger" href="{{url('/crudUsuarios/eliminarBlog/' . $blogs->id)}}">Eliminar</a>
                    @endif
                @endforeach
                

            </td>
        </tr>
        @endforeach
    </table>

</div>






@endsection