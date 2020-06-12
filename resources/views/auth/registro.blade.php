@extends('layouts.master')

@section('body')
    

    <div id="div_registro">
        <h2>
            Registrate
        </h2>
        <form method="POST" action="{{url('/registro/createUsuario')}}" id="formulario_registro_usuarios" enctype="multipart/form-data">

            {{ csrf_field() }}

            @if ($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
                

            <label>
                <span>Usuario</span>
                <input type="text" name="usuario" id="registro_U_usuario" required>
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password" name="password" id="registro_U_password" min="6" required>
            </label>

            <label>
                <span>Repite contraseña</span>
                <input type="password" name="password2" id="registro_U_password2" required>
            </label>

            <label>
                <span>Nombre</span>
                <input type="text" name="nombre" id="registro_U_nombre" required>
            </label>

            <label>
                <span>Apellidos</span>
                <input type="text" name="apellidos" id="registro_U_apellidos" required>
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
                    <option value="null" selected>Selecciona un pais</option>
                    <option value="España">España</option>
                    <option value="Argentina">Argentina</option>
                    <option value="México">México</option>
                    <option value="Colombia">Colombia</option>
                </select>
            </label>

            <label>
                <span>Twitter</span>
                <input type="text" name="twitter" id="registro_U_twitter" placeholder="Ejemplo: www.twitter.com/perfil">
            </label>

            <label>
                <span>Facebook</span>
                <input type="text" name="facebook" id="registro_U_facebook" placeholder="Ejemplo: www.facebook.com/perfil">
            </label>

            <label>
                <span>Instagram</span>
                <input type="text" name="instagram" id="registro_U_instagram" placeholder="Ejemplo: www.instagram.com/perfil">
            </label>

            <label>
                <span>Tu página web</span>
                <input type="text" name="paginaWeb">
            </label>

            <label id="label_input_image">
                <input type="file" name="imagen_usuario" accept="image/*">
            </label>

            <label id="label_checkbox_politica">
                <div>
                    <input type="checkbox" id="registro_U_checkboxPolitica" required><span>Acepto la <a href="{{url('/politicaDePrivacidad')}}" target="_blank">política de privacidad</a></span>
                </div>
            </label>

            <div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>

    </div>


@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    
@endsection