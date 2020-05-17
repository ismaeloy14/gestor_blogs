@extends('layouts.master')

@section('body')
    

    <div id="div_registro">
        <h2>
            Registrate
        </h2>
        <form method="POST" action="{{url('/registro/createUsuario')}}" id="formulario_registro_usuarios">

            {{ csrf_field() }}

            @if ($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
                

            <label>
                <span>Usuario</span>
                <input type="text" name="usuario" required>
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password" name="password" id="registro_U_password" required>
            </label>

            <label>
                <span>Repite contraseña</span>
                <input type="password" name="password2" id="registro_U_password2" required>
            </label>

            <label>
                <span>Nombre</span>
                <input type="text" name="nombre" required>
            </label>

            <label>
                <span>Apellidos</span>
                <input type="text" name="apellidos" required>
            </label>

            <label>
                <span>Email</span>
                <input type="email" name="email" id="registro_U_email" required>
            </label>

            <label>
                <span>Fecha nacimiento</span>
                <input type="date" name="fecha_nacimiento">
            </label>

            <label>
                <span>País</span>
                <select name="pais" id="select_pais">
                    <option value="España">España</option>
                    <option value="Francia">Francia</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Portugal">Portugal</option>
                </select>
            </label>

            <label id="label_input_image">
                <input type="file" name="imagen_usuario" accept="image/*">
            </label>

            <div>
                <button type="submit">Registrar</button>
            </div>
        </form>

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
    
@endsection