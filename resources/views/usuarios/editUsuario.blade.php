@extends('layouts.master')

@section('body')
    

<div id="div_editUsuario">

    <div>
        <h2>Editar Perfil</h2>

                <form action="{{url('/editarUsuario/'.$user->usuario)}}" method="post" id="formEditarUsuario">

                    {{method_field('PUT')}}

                    {{ csrf_field() }}
                    
                    @if ($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                    <label>
                        <span>Usuario </span>
                        <input type="text" name="usuario" value="{{$user->usuario}}" id="editarUsuario" required>
                    </label>

                    <label>
                        <span>Nombre </span>
                        <input type="text" name="nombre" value="{{$user->nombre}}" id="editarNombre" required>
                    </label>

                    <label>
                        <span>Apellidos </span>
                        <input type="text" name="apellidos" value="{{$user->apellidos}}" id="editarApellidos" required>
                    </label>

                    <label>
                        <span>Email </span>
                        <input type="email" name="email" value="{{$user->email}}" id="editarEmail" required>
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
                    <label>
                        <span>Pais de origen </span>
                        @if ($user->pais == null)
                            <select name="pais" id="select_pais">
                                <option value="null" selected>Selecciona un pais</option>
                                <option value="{{$arrayPaises[0]}}">{{$arrayPaises[0]}}</option>
                                <option value="{{$arrayPaises[1]}}">{{$arrayPaises[1]}}</option>
                                <option value="{{$arrayPaises[2]}}">{{$arrayPaises[2]}}</option>
                                <option value="{{$arrayPaises[3]}}">{{$arrayPaises[3]}}</option>
                            </select>
                        @else
                            <select name="pais" id="select_pais">
                                <option value="null">Selecciona un pais</option>
                                @for ($i = 0; $i < count($arrayPaises); $i++)
                                    @if ($user->pais == $arrayPaises[$i])
                                        <option value="{{$arrayPaises[$i]}}" selected>{{$arrayPaises[$i]}}</option>
                                    @else
                                        <option value="{{$arrayPaises[$i]}}">{{$arrayPaises[$i]}}</option>
                                    @endif
                                @endfor
                            </select>
                        @endif
                        
                    </label>

                    <label>
                        <span>Twitter</span>
                        <input type="text" value="<?php echo substr($user->twitter, 8, 100000); ?>" name="twitter" id="editarTwitter" placeholder="Ejemplo: www.twitter.com/perfil">
                    </label>

                    <label>
                        <span>Facebook</span>
                        <input type="text" value="<?php echo substr($user->facebook, 8, 100000); ?>" name="facebook" id="editarFacebook" placeholder="Ejemplo: www.facebook.com/perfil">
                    </label>

                    <label>
                        <span>Instagram</span>
                        <input type="text" value="<?php echo substr($user->instagram, 8, 100000); ?>" name="instagram" id="editarInstagram" placeholder="Ejemplo: www.instagram.com/perfil">
                    </label>

                    <label>
                        <span>Página Web</span>
                        <input type="text" value="<?php echo substr($user->paginaWeb, 8, 100000); ?>" name="paginaWeb" id="editarWeb">
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