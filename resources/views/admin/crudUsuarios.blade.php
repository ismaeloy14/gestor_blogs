@extends('layouts.master')

@section('body')
    
{{-- Incluimos las ventanas modales --}}
@include('admin.showUsuario')
@include('admin.editUsuario')
@include('admin.deleteUsuario')

<div id="div_principal">
    <h2>Crud Usuarios</h2>


    @php
        $arrayAsocUsuarios = array();
    @endphp
    
    @if ($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif

    <table id="tabla_crud_Usuarios" class="table">
        <thead>
            <tr>
            {{--<th>ID</th>--}}
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
            
                @php
                    $arrayAsocUsuarios["usuario".$u->id] = $u->id;
                @endphp
            {{--<td>
                {{$u->id}}
            </td>--}}
            <td>{{$u->usuario}}</td>
            <td>{{$u->rol}}</td>

            

            <td>
                <button class="btn btn-info" name="modalShowUsuario" data-toggle="modal" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Ver Perfil</button>
                <button class="btn btn-primary" name="modalEditUsuario" data-toggle="modal" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Editar</button>
                <button class="btn btn-danger" name="modalDeleteUsuario" data-toggle="modal" value="<?php echo $arrayAsocUsuarios["usuario".$u->id]; ?>">Eliminar</button>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>


<script>
    
    // Para ventanas modales

    $("button[name='modalShowUsuario']").on('click', function() {
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/showUsuario?id=' )}}";

        // Conexion ajax

        $.get(urlShow+idUser)
                .done(function(data){
                    console.log(data);
                    $('#idUsuario').text(data[0][0].id);
                    $('#usuario').text(data[0][0].usuario);
                    $('#rol').text(data[0][0].rol);
                    $('#email').text(data[0][0].email);
                    $('#nombre').text(data[0][0].nombre);
                    $('#apellidos').text(data[0][0].apellidos);

                    if (data[0][0].fechaNacimiento == null){
                        $('#fechaNacimiento').text('Desconocida');
                    } else {
                        $('#fechaNacimiento').text(data[0][0].fechaNacimiento);
                    }
                    
                    if (data[0][0].pais == null) {
                        $('#pais').text('Desconocido');    
                    } else {
                        $('#pais').text(data[0][0].pais);
                    }
                    $('#twitter').text(data[0][0].twitter);
                    $('#twitter').attr("href", data[0][0].twitter);
                    
                    $('#facebook').text(data[0][0].facebook);
                    $('#facebook').attr("href", data[0][0].facebook);
                    
                    $('#instagram').text(data[0][0].instagram);
                    $('#instagram').attr("href", data[0][0].instagram);
                    
                    $('#paginaWeb').text(data[0][0].paginaWeb);
                    $('#paginaWeb').attr("href", data[0][0].paginaWeb);

                    $("#showModal").modal('toggle');
                    $('#showModal').modal('show');

                }).fail(function(){
                    alert('Error a la hora de hacer la petición');
                });
        console.log(' URL '+ urlShow + idUser);
    });

    $("button[name='modalEditUsuario']").on('click', function() { // MODAL EDITAR
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/editUsuario?id=' )}}";
        var urlForm = "{{ url('/crudUsuarios/editUsuario/' )}}";
        var urlFormCompleta = urlForm+'/'+idUser;

        var options = "";
        var pais = "";
        var paisesArray = ["España", "Francia", "Alemania", "Portugal"];

        $.get(urlShow+idUser)
            .done(function(data) {
                //console.log(data);

                $('#formEdit').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente
                $('#editidUsuario').val(data[0][0].id);
                $('#editusuario').val(data[0][0].usuario);

                $('#editrol').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                for (var i = 0; i < data[1].length; i++){
                    if (data[1][i].rol == 'basico') {
                        options += "<option value='"+data[1][i].rol+"' selected>"+data[1][i].rol+"</option>";
                    } else {
                        options += "<option value='"+data[1][i].rol+"'>"+data[1][i].rol+"</option>";
                    }
                    //console.log(options)
                }
                
                $('#editrol').append(options);
                
                $('#editemail').val(data[0][0].email);
                $('#editnombre').val(data[0][0].nombre);
                $('#editapellidos').val(data[0][0].apellidos);

                if (data[0][0].fechaNacimiento != null) {
                    $('#editfechaNacimiento').val(data[0][0].fechaNacimiento);
                }

                $('#editpais').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                for (var j = 0; j < 4; j++) {
                    if (data[0][0].pais  == paisesArray[j]) {
                        pais += "<option value='"+paisesArray[j]+"' selected>"+paisesArray[j]+"</option>";
                    } else if (data[0][0].pais == null) {
                        //console.log("ha entrado en null de paises");
                        pais += "<option value='"+paisesArray[j]+"'>"+paisesArray[j]+"</option>";
                    } else {
                        pais += "<option value='"+paisesArray[j]+"'>"+paisesArray[j]+"</option>";
                    }
                }
                //console.log(pais);
                $('#editpais').append(pais);

                $('#edittwitter').val(data[0][0].twitter);
                $('#editfacebook').val(data[0][0].facebook);
                $('#editinstagram').val(data[0][0].instagram);
                $('#editpaginaWeb').val(data[0][0].paginaWeb);


                $("#editModal").modal('toggle');
                $('#editModal').modal('show');

            }).fail(function(){
                alert('No de ha podido cargar la ventana modal de edit usuario');
            });

    });

    $("button[name='modalDeleteUsuario']").on('click', function() {
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/deleteUsuario?id=' )}}";
        var urlForm = "{{ url('/crudUsuarios/deleteUsuario/' )}}";
        var urlFormCompleta = urlForm+'/'+idUser;

        $.get(urlShow+idUser)
            .done(function(data) {
                $('#formDelete').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente
                $('#deleteidUsuario').text(data[0][0].id);
                $('#deleteusuario').text(data[0][0].usuario);
                $('#deleterol').text(data[0][0].rol);


                $("#deleteModal").modal('toggle');
                $('#deleteModal').modal('show');

            }).fail(function(){
                alert('No de ha podido cargar la ventana modal de delete usuario');
            });

    });
</script>






@endsection