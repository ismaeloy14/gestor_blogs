@extends('layouts.master')

@section('body')
    

<div id="div_editUsuario">

    <div>
        <h2>Editar Perfil</h2>

            @foreach ($user as $user)

                <form action="{{url('/crudUsuarios/editarUsuario/'.$user->usuario)}}" method="post">

                    {{method_field('PUT')}}

                    {{ csrf_field() }}
                    
                    @if ($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                    <label>
                        <span>Usuario </span>
                        <input type="text" name="usuario" value="{{$user->usuario}}" required>
                    </label>

                    <label>
                        <span>Nombre </span>
                        <input type="text" name="nombre" value="{{$user->nombre}}" required>
                    </label>

                    <label>
                        <span>Apellidos </span>
                        <input type="text" name="apellidos" value="{{$user->apellidos}}" required>
                    </label>

                    <label>
                        <span>Email </span>
                        <input type="email" name="email" value="{{$user->email}}" id="registro_U_email" required>
                    </label>

                    <label>
                        @if ($user->fechaNacimiento != null)
                            <span>Fecha nacimiento </span>
                            <input type="date" name="fechaNacimiento" value="{{$user->fechaNacimiento}}">
                        @else
                            <span>Fecha nacimiento </span>
                            <input type="date" name="fechaNacimiento" value=null>
                        @endif

                    </label>
                        <span>Pais de origen </span>
                        <select name="pais" id="select_pais">
                            <option value="España">España</option>
                            <option value="Francia">Francia</option>
                            <option value="Alemania">Alemania</option>
                            <option value="Portugal">Portugal</option>
                        </select>
                    </label>

                    <label id="label_input_image">
                        <input type="file" name="imagenPerfil" accept="image/*">
                    </label>

                    <div>
                        <button class="btn btn-success">Guardar cambios</button>
                    </div>
                </form>

            @endforeach
        
    </div>

</div>




@endsection