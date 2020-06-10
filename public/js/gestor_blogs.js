$(function(){
    $('#formulario_registro_usuarios').on('submit', formulario_registro_usuarios);// Formulario de registros
    $('#formulario_creacion_blog').on('submit', formulario_creacion_blog); // Formulario de creacion del blog
    $('#formEditarUsuario').on('submit', formulario_edit_usuarioPropio);

    $('#formCreate').on('submit', formulario_crudUsuarios_usuario);

    $('#formCreateBlog').on('submit', formulario_creacion_blog);

    $('#formCambiarContrasena').on('submit', formulario_cambiar_contrasena);


    /*$('#').on('submit', );
    $('#').on('submit', );
    $('#').on('submit', );*/

});

$('#tabla_crud_Usuarios').ready(function() {
    $('#tabla_crud_Usuarios').DataTable();
});

$('#tabla_crud_Noiticias').ready(function() {
    $('#tabla_crud_Noiticias').DataTable();
});

$('#tabla_Categorias').ready(function() {
    $('#tabla_Categorias').DataTable();
});



function formulario_registro_usuarios(e){ // Registro
    var password = $('#registro_U_password').val();
    var password2 = $('#registro_U_password2').val();
    var usuario = $('#registro_U_usuario').val();
    var nombre = $('#registro_U_nombre').val();
    var apellidos = $('#registro_U_apellidos').val();
    var email = $('#registro_U_email').val();
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);


    if (password == null) {
        alert('Introduce la contraseña');
        e.preventDefault();
    }

    if (password2 == null) {
        alert('Introduce la contraseña repetida');
        e.preventDefault();
    }

    if (email == null) {
        alert('Introduce el email');
        e.preventDefault();
    }

    if (usuario == null) {
        alert('Introduce el usuario');
        e.preventDefault();
    }

    if (nombre == null) {
        alert('Introduce tu nombre');
        e.preventDefault();
    }

    if (apellidos == null) {
        alert('Introduce tus apellidos');
        e.preventDefault();
    }

    if (password != password2){
        alert('Las contraseñas no son iguales');
        console.log(password);
        e.preventDefault();
    }

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

}

function formulario_edit_usuarioPropio(e) {
    var usuario = $('#editarUsuario').val();
    var nombre = $('#editarNombre').val();
    var apellidos = $('#editarApellidos').val();
    var email = $('#editarEmail').val();
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    if (email == null) {
        alert('Introduce el email');
        e.preventDefault();
    }

    if (usuario == null) {
        alert('Introduce el usuario');
        e.preventDefault();
    }

    if (nombre == null) {
        alert('Introduce tu nombre');
        e.preventDefault();
    }

    if (apellidos == null) {
        alert('Introduce tus apellidos');
        e.preventDefault();
    }

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }
}

function formulario_creacion_blog(e){
    var titulo_blog = $("input[name='tituloBlog']").val();
    var publico = $("select[name='publico']").val();

    
    if (titulo_blog.length > 20) {
        alert('Tu titulo es demasiado largo.');
        e.preventDefault();
    } else if (titulo_blog.length < 3) {
        alert('Tu titulo es demasiado corto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }

    
}

function formulario_crudUsuarios_usuario(e) {
    var password = $('#password').val();
    var password2 = $('#password2').val();
    var email = $('#createemail').val();
    var usuario = $('#createusuario').val();
    var nombre = $('#createnombre').val();
    var apellidos = $('#createapellidos').val();

    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    if (password == null) {
        alert('Introduce la contraseña');
        e.preventDefault();
    }
    if (password2 == null) {
        alert('Introduce la contraseña repetida');
        e.preventDefault();
    }
    if (email == null) {
        alert('Introduce el email');
        e.preventDefault();
    }

    if (usuario == null) {
        alert('Introduce el usuario');
        e.preventDefault();
    }

    if (nombre == null) {
        alert('Introduce tu nombre');
        e.preventDefault();
    }

    if (apellidos == null) {
        alert('Introduce tus apellidos');
        e.preventDefault();
    }

    if (password != password2){
        alert('Las contraseñas no son iguales');
        e.preventDefault();
    }

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }
}

function formulario_cambiar_contrasena(e) { // Cambiar contraseña propio usuario
    var passwordNew = $('#passwordNew').val();
    var passwordNew2 = $('#passwordNew2').val();
    
    if (passwordNew == null) {
        alert('Introduce la contraseña nueva');
        e.preventDefault();
    }
    if (passwordNew2 == null) {
        alert('Repite la contraseña nueva');
        e.preventDefault();
    }

    if (passwordNew != passwordNew2) {
        alert('Las contraseñas no son iguales');
        e.preventDefault();
    }

}

