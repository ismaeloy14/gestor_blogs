@extends('layouts.master')

@section('body')
    
{{-- Incluimos las ventanas modales --}}
@include('admin.showUsuario')
@include('admin.editUsuario')
@include('admin.deleteUsuario')
@include('admin.createUsuario')

@include('admin.createBlog')
@include('admin.showBlog')
@include('admin.editBlog')
@include('admin.deleteBlog')

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

        @foreach ($users as $u)
        
        <tr>
            
            <td>{{$u->usuario}}</td>
            <td>{{$u->rol}}</td>

            <td>
                <button class="btn btn-info" name="modalShowUsuario" data-toggle="modal" value="{{$u->id}}">Ver Perfil</button>
                <button class="btn btn-primary" name="modalEditUsuario" data-toggle="modal" value="{{$u->id}}?>">Editar</button>
                <button class="btn btn-danger" name="modalDeleteUsuario" data-toggle="modal" value="{{$u->id}}">Eliminar</button>
            </td>
                
            <td>
                @foreach ($blogs as $blog)
                    @if ($u->id == $blog->idUsuario)
                    
                        <button class="btn btn-info" name="modalShowBlog" value="{{$blog->id}}">Ver información</button>
                        <button class="btn btn-primary" name="modalEditBlog" value="{{$blog->id}}">Editar</button>
                        <button class="btn btn-danger" name="modalDeleteBlog" value="{{$blog->id}}">Eliminar</button>
                        
                    @endif

                @endforeach
                
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>

<div id="botonCrearUsuarioBlog">
    <button class="btn btn-success" name="modalCrearUsuario" data-toggle="modal">Crear usuario</button>
    <button class="btn btn-primary" name="modalCreateBlog">Crear blog</button>
</div>


{{--@include('layouts.footer')--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>


<script>
    
    // Para ventanas modales

    $("button[name='modalShowUsuario']").on('click', function() { // Modal ver usuario
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/showUsuario?id=' )}}";

        // Conexion ajax

        $.get(urlShow+idUser)
                .done(function(data){
                    //console.log(data);
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
        //console.log(' URL '+ urlShow + idUser);
    });

    $("button[name='modalEditUsuario']").on('click', function() { // Modal editar usuario
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/editUsuario?id=' )}}";
        var urlForm = "{{ url('/crudUsuarios/editUsuario/' )}}";
        var urlFormCompleta = urlForm+'/'+idUser;

        var options = "";
        var pais = "";
        var paisesArray = ["España", "Francia", "Alemania", "Portugal"];

        $.get(urlShow+idUser)
            .done(function(data) {
                console.log(data);

                $('#formEdit').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente
                $('#editidUsuario').val(data[0][0].id);
                $('#editusuario').val(data[0][0].usuario);

                $('#editrol').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                for (var i = 0; i < data[1].length; i++){
                    if (data[1][i].rol == data[0][0].rol) {
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

    $("button[name='modalDeleteUsuario']").on('click', function() { // Modal delete usuario
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

    $("button[name='modalCrearUsuario']").on('click', function() { // Modal crear usuario
        var idUser = this.value;
        var urlShow = "{{ url('/crudUsuarios/showCreateUsuario')}}";

        var options = "";
        var pais = "";

        $.get(urlShow)
            .done(function(data) {

            //console.log(data);

            $('#createrol').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                for (var i = 0; i < data[0].length; i++){
                    options += "<option value='"+data[0][i].rol+"'>"+data[0][i].rol+"</option>";
                    console.log(data[0][i].rol);
                }
                
            $('#createrol').append(options);


            $('#createpais').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
            for (var j = 0; j < data[1].length; j++) {
                    pais += "<option value='"+data[1][j]+"'>"+data[1][j]+"</option>";
            }

            $('#createpais').append(pais);

            $("#createModal").modal('toggle');
            $('#createModal').modal('show');

            }).fail(function() {
                alert('No de ha podido cargar la ventana modal de create usuario');
            });
    });

    // Modales de Blogs \\

    $("button[name='modalCreateBlog']").on('click', function() { // Modal crear blog
        var urlShow = "{{ url('/crudUsuarios/showCreateBlog')}}";

        var usuarios = "";
        var categorias = "";

        $.get(urlShow)
            .done(function(data) {
            
                if (data[0].length > 0){
                    //console.log(data);

                    $('#createBlogUsuario').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                        for (var i = 0; i < data[0].length; i++){
                            usuarios += "<option value='"+data[0][i]+"'>"+data[0][i]+"</option>";
                            //console.log(data[0][i]);
                        }
                        
                    $('#createBlogUsuario').append(usuarios);


                    $('#createBlogCategoria').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                    for (var j = 0; j < data[1].length; j++) {
                            categorias += "<option value='"+data[1][j].categoria+"'>"+data[1][j].categoria+"</option>";
                    }

                    $('#createBlogCategoria').append(categorias);

                    $("#createModalBlog").modal('toggle');
                    $('#createModalBlog').modal('show');

                } else {
                    alert('No hay usuarios sin blog.');
                }

                }).fail(function() {
                    alert('No de ha podido cargar la ventana modal de create blog');
                });
    });

    $("button[name='modalShowBlog']").on('click', function() { // Modal información del blog
        var idblog = this.value;
        var urlShow = "{{ url('/crudUsuarios/showBlog?id=' )}}";
        var urlBlog = "{{ url('/' )}}";

        // Conexion ajax

        $.get(urlShow+idblog)
                .done(function(data){
                    //console.log(data);
                    
                    $('#showTituloBlog').text(data[1].tituloBlog);
                    $('#showUsuario').text(data[0].usuario);
                    $('#showCataegoria').text(data[1].categoria);

                    if (data[1].blogPublico == 0) {
                        $('#showPublico').text('No es público');
                    } else {
                        $('#showPublico').text('Sí es público');
                    }
                    
                    $('#irblog').attr('href', urlBlog+'/'+data[1].tituloBlog);

                    $("#showModalblog").modal('toggle');
                    $('#showModalblog').modal('show');

                }).fail(function(){
                    alert('Error a la hora de hacer la petición');
                });
        //console.log(' URL '+ urlShow + idblog);
    });

    $("button[name='modalEditBlog']").on('click', function() { // Modal editar blog
        var idBlog = this.value;
        var urlShow = "{{ url('/crudUsuarios/showEditBlog?id=' )}}";
        var urlForm = "{{ url('/crudUsuarios/editBlog/' )}}";
        var urlFormCompleta = urlForm+'/'+idBlog;

        var categorias = "";
        var publico = "";

        $.get(urlShow+idBlog)
            .done(function(data) {
                console.log(data);

                $('#formEditBlog').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente

                $('#edittitulo').val(data[0].tituloBlog);
                
                $('#editcategoria').empty();

                for (var j = 0; j < data[1].length; j++) {
                    if (data[0].categoria == data[1][j].categoria){
                        categorias += "<option value='"+data[1][j].categoria+"' selected>"+data[1][j].categoria+"</option>";
                    } else {
                        categorias += "<option value='"+data[1][j].categoria+"'>"+data[1][j].categoria+"</option>";
                    }

                }
                $('#editcategoria').append(categorias);


                $('#editpublico').empty(); // Lo vacio primero para borrar los hijos anteriores y no se acumulen
                var publicoNoPublico = data[0].blogPublico;
                

                if (data[0].blogPublico == publicoNoPublico) {

                    publico += "<option value='"+data[0].blogPublico+"' selected> Sí es público </option>";

                    if ((publicoNoPublico == 1) && (data[0].blogPublico != publicoNoPublico)) {
                        publico += "<option value='1'> Sí es público </option>";
                    } else {
                        publico += "<option value='0'> No es público </option>";
                    }
                }
                    
                    //console.log(publico)
                
                $('#editpublico').append(publico);


                $("#editModalBlog").modal('toggle');
                $('#editModalBlog').modal('show');

            }).fail(function(){
                alert('No de ha podido cargar la ventana modal de edit usuario');
            });

    });

    $("button[name='modalDeleteBlog']").on('click', function() { // Modal delete usuario
        var idBlog = this.value;
        var urlShow = "{{ url('/crudUsuarios/showDeleteBlog?id=' )}}";
        var urlForm = "{{ url('/crudUsuarios/deleteBlog/' )}}";
        var urlFormCompleta = urlForm+'/'+idBlog;

        $.get(urlShow+idBlog)
            .done(function(data) {
                console.log(data);
                $('#formDeleteBlog').attr("action", urlFormCompleta); // Le añado el atributo action dinámicamente
                $('#deleteidBlog').text(data[1].id);
                $('#deletetituloBlog').text(data[1].tituloBlog);
                $('#deleteBlogUsuario').text(data[0].usuario);


                $("#deleteModalBlog").modal('toggle');
                $('#deleteModalBlog').modal('show');

            }).fail(function(){
                alert('No de ha podido cargar la ventana modal de delete usuario');
            });

    });


</script>






@endsection