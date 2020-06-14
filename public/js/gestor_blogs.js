$(function(){
    $('#formulario_registro_usuarios').on('submit', formulario_registro_usuarios);// Formulario de registros
    $('#formulario_creacion_blog').on('submit', formulario_creacion_blog); // Formulario de creacion del blog
    $('#gestionarBlog').on('submit', formulario_editar_blog);
    $('#formEditarUsuario').on('submit', formulario_edit_usuarioPropio);
    $('#formulario_create_edit_noticia').on('submit', crear_editar_noticia);
    //$('#formulario_edit_noticia').on('submit', editar_noticia);

    $('#formCreate').on('submit', formulario_crudUsuarios_usuario);
    $('#formEdit').on('submit', formulario_crudUsuarios_editUsuario);

    $('#formCreateBlog').on('submit', formulario_creacion_blog_admin);
    $('#formEditBlog').on('submit', formulario_editar_blog_admin);
    

    $('#formCambiarContrasena').on('submit', formulario_cambiar_contrasena);


    /*$('#').on('submit', );
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
    //var politica = $('#registro_U_checkboxPolitica').prop();
    //var pais = $('#select_pais').val();
    //var pais = document.getElementById('select_pais').value;

    // Expresiones regulares

    /* Usuario */
    var expresion_regular_usuario = '^[A-Za-z0-9]+$';
    var patron_usuario = new RegExp(expresion_regular_usuario);

    /* Email */
    var email = $('#registro_U_email').val();
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    /* Twitter */
    var twitter = $('#registro_U_twitter').val();
    var expresion_regular_twitter = '^www\.twitter\.com\/[A-Za-z0-9_\.]+$';
    var patron_twitter = new RegExp(expresion_regular_twitter);

    /* Facebook */
    var facebook = $('#registro_U_facebook').val();
    var expresion_regular_facebook = '^www\.facebook\.com\/[A-Za-z0-9_\.]+$';
    var patron_facebook = new RegExp(expresion_regular_facebook);

    /* Instagram */
    var instagram = $('#registro_U_instagram').val();
    var expresion_regular_instagram = '^www\.instagram\.com\/[A-Za-z0-9_\.]+(\/){0,1}$';
    var patron_instagram = new RegExp(expresion_regular_instagram);

    /* Pagina web */
    var web = $('#registro_U_web').val();
    var expresion_regular_web = '^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$';
    var patron_web = new RegExp(expresion_regular_web);

    /*console.log(twitter);
    console.log(facebook);
    console.log(instagram);*/


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

    /* Comprobaciones contraseñas */

    if (password != password2){
        alert('Las contraseñas no son iguales');
        //console.log(password);
        e.preventDefault();
    }

    if (password == usuario) {
        alert('La contraseña no puede ser igual al nombre de usuario');
        e.preventDefault();
    }

    if (password == password2) {
        if (password.length < 6) {
            alert('La contraseña ha de tener un mínimo de 6 carácteres');
            e.preventDefault();
        }
    }

    // Comprobaciones de regexp
    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

    if (!patron_usuario.test(usuario)) {
        alert('Este nombre de usuario no esta permitido');
        e.preventDefault();
    }

    if (twitter != "") {
        if(!patron_twitter.test(twitter)) {
            alert('La URL de tu perfil de Twitter esta mal escrita.');
            e.preventDefault();
        }
    }

    if (facebook != "") {
        if(!patron_facebook.test(facebook)) {
            alert('La URL de tu perfil de Facebook esta mal escrita.');
            e.preventDefault();
        }
    }

    if (instagram != "") {
        if(!patron_instagram.test(instagram)) {
            alert('La URL de tu perfil de instagram esta mal escrita.');
            e.preventDefault();
        }
    }

    if (web != "") {
        if (!patron_web.test(web)) {
            alert('La URL de tu web esta mal escrita o quite el protocolo (http:// o https://).');
            e.preventDefault();
        }
    }

    if ($('#registro_U_checkboxPolitica').prop('checked') != true) {
        alert('Acepta la política de privacidad');
        e.preventDefault();
    }

}

function formulario_edit_usuarioPropio(e) { // Edit usuario de él mismo
    var usuario = $('#editarUsuario').val();
    var nombre = $('#editarNombre').val();
    var apellidos = $('#editarApellidos').val();

    // Expresiones regulares

    /* Usuario */
    var expresion_regular_usuario = '^[A-Za-z0-9]+$';
    var patron_usuario = new RegExp(expresion_regular_usuario);

    /* Email */
    var email = $('#editarEmail').val();
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    /* Twitter */
    var twitter = $('#editarTwitter').val();
    var expresion_regular_twitter = '^www\.twitter\.com\/[A-Za-z0-9_\.]+$';
    var patron_twitter = new RegExp(expresion_regular_twitter);

    /* Facebook */
    var facebook = $('#editarFacebook').val();
    var expresion_regular_facebook = '^www\.facebook\.com\/[A-Za-z0-9_\.]+$';
    var patron_facebook = new RegExp(expresion_regular_facebook);

    /* Instagram */
    var instagram = $('#editarInstagram').val();
    var expresion_regular_instagram = '^www\.instagram\.com\/[A-Za-z0-9_\.]+(\/){0,1}$';
    var patron_instagram = new RegExp(expresion_regular_instagram);

    /* Pagina web */
    var web = $('#editarWeb').val();
    var expresion_regular_web = '^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$';
    var patron_web = new RegExp(expresion_regular_web);


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

    /* REGEXP */

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

    if (!patron_usuario.test(usuario)) {
        alert('Este nombre de usuario no esta permitido');
        e.preventDefault();
    }

    if (twitter != "") {
        if(!patron_twitter.test(twitter)) {
            alert('La URL de tu perfil de Twitter esta mal escrita.');
            e.preventDefault();
        }
    }

    if (facebook != "") {
        if(!patron_facebook.test(facebook)) {
            alert('La URL de tu perfil de Facebook esta mal escrita.');
            e.preventDefault();
        }
    }

    if (instagram != "") {
        if(!patron_instagram.test(instagram)) {
            alert('La URL de tu perfil de instagram esta mal escrita.');
            e.preventDefault();
        }
    }

    if (web != "") {
        if (!patron_web.test(web)) {
            alert('La URL de tu web esta mal escrita o quite el protocolo (http:// o https://).');
            e.preventDefault();
        }
    }
}

function formulario_creacion_blog(e){ // Creación del blog por el usuario
    var titulo_blog = $("#titulo_blog").val();
    var publico = $("#publico").val();

    /* REGEXP */
    /* Blog */
    var expresion_regular_titulo_blog = '^[A-Za-z0-9_\-\s]+$';
    var patron_titulo_blog = new RegExp(expresion_regular_titulo_blog);
    
    if (titulo_blog.length > 20) {
        alert('Tu titulo es demasiado largo.');
        e.preventDefault();
    } else if (titulo_blog.length < 3) {
        alert('Tu titulo es demasiado corto.');
        e.preventDefault();
    }

    if (!patron_titulo_blog.test(titulo_blog)) {
        alert('Nombre para el blog incorrecto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }
}

function formulario_editar_blog (e) {
    var titulo_blog = $("#titulo_blog").val();
    var publico = $("#publico").val();

    /* REGEXP */
    /* Blog */
    var expresion_regular_titulo_blog = '^[A-Za-z0-9_\-\s]+$';
    var patron_titulo_blog = new RegExp(expresion_regular_titulo_blog);
    
    if (titulo_blog.length > 20) {
        alert('Tu titulo es demasiado largo.');
        e.preventDefault();
    } else if (titulo_blog.length < 3) {
        alert('Tu titulo es demasiado corto.');
        e.preventDefault();
    }

    if (!patron_titulo_blog.test(titulo_blog)) {
        alert('Nombre para el blog incorrecto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }
}

function formulario_creacion_blog_admin (e) {
    var titulo_blog = $("#createtitulo_blog").val();
    var publico = $("#publico").val();

    /* REGEXP */
    /* Blog */
    var expresion_regular_titulo_blog = '^[A-Za-z0-9_\-\s]+$';
    var patron_titulo_blog = new RegExp(expresion_regular_titulo_blog);
    
    if (titulo_blog.length > 20) {
        alert('Tu titulo es demasiado largo.');
        e.preventDefault();
    } else if (titulo_blog.length < 3) {
        alert('Tu titulo es demasiado corto.');
        e.preventDefault();
    }

    if (!patron_titulo_blog.test(titulo_blog)) {
        alert('Nombre para el blog incorrecto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }
}

function formulario_editar_blog_admin (e) {
    var titulo_blog = $("#edittitulo").val();
    var publico = $("#editpublico").val();

    /* REGEXP */
    /* Blog */
    var expresion_regular_titulo_blog = '^[A-Za-z0-9_\-\s]+$';
    var patron_titulo_blog = new RegExp(expresion_regular_titulo_blog);
    
    if (titulo_blog.length > 20) {
        alert('Tu titulo es demasiado largo.');
        e.preventDefault();
    } else if (titulo_blog.length < 3) {
        alert('Tu titulo es demasiado corto.');
        e.preventDefault();
    }

    if (!patron_titulo_blog.test(titulo_blog)) {
        alert('Nombre para el blog incorrecto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }
}

function formulario_crudUsuarios_usuario(e) { // Creación de usuario por admin
    var password = $('#password').val();
    var password2 = $('#password2').val();
    var email = $('#createemail').val();
    var usuario = $('#createusuario').val();
    var nombre = $('#createnombre').val();
    var apellidos = $('#createapellidos').val();

    // Expresiones regulares

    /* Usuario */
    var expresion_regular_usuario = '^[A-Za-z0-9]+$';
    var patron_usuario = new RegExp(expresion_regular_usuario);

    /* Email */
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    /* Twitter */
    var twitter = $('#createtwitter').val();
    var expresion_regular_twitter = '^www\.twitter\.com\/[A-Za-z0-9_\.]+$';
    var patron_twitter = new RegExp(expresion_regular_twitter);

    /* Facebook */
    var facebook = $('#createfacebook').val();
    var expresion_regular_facebook = '^www\.facebook\.com\/[A-Za-z0-9_\.]+$';
    var patron_facebook = new RegExp(expresion_regular_facebook);

    /* Instagram */
    var instagram = $('#createinstagram').val();
    var expresion_regular_instagram = '^www\.instagram\.com\/[A-Za-z0-9_\.]+(\/){0,1}$';
    var patron_instagram = new RegExp(expresion_regular_instagram);

    /* Pagina web */
    var web = $('#createpaginaWeb').val();
    var expresion_regular_web = '^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$';
    var patron_web = new RegExp(expresion_regular_web);

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
        alert('Introduce el nombre');
        e.preventDefault();
    }

    if (apellidos == null) {
        alert('Introduce los apellidos');
        e.preventDefault();
    }

    // Comprobación contraseñas
    if (password != password2){
        alert('Las contraseñas no son iguales');
        e.preventDefault();
    }

    if (password == usuario) {
        alert('La contraseña no puede ser igual al nombre de usuario');
        e.preventDefault();
    }

    if (password == password2) {
        if (password.length < 6) {
            alert('La contraseña ha de tener un mínimo de 6 carácteres');
            e.preventDefault();
        }
    }

    // comprobación expresiones regulares
    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

    if (!patron_usuario.test(usuario)) {
        alert('Este nombre de usuario no esta permitido');
        e.preventDefault();
    }

    if (twitter != "") {
        if(!patron_twitter.test(twitter)) {
            alert('La URL de tu perfil de Twitter esta mal escrita.');
            e.preventDefault();
        }
    }

    if (facebook != "") {
        if(!patron_facebook.test(facebook)) {
            alert('La URL de tu perfil de Facebook esta mal escrita.');
            e.preventDefault();
        }
    }

    if (instagram != "") {
        if(!patron_instagram.test(instagram)) {
            alert('La URL de tu perfil de instagram esta mal escrita.');
            e.preventDefault();
        }
    }

    if (web != "") {
        if (!patron_web.test(web)) {
            alert('La URL de tu web esta mal escrita o quite el protocolo (http:// o https://).');
            e.preventDefault();
        }
    }
}

function formulario_crudUsuarios_editUsuario(e) { // Editar usuario por admin
    var email = $('#editemail').val();
    var usuario = $('#editusuario').val();
    var nombre = $('#editnombre').val();
    var apellidos = $('#editapellidos').val();

    // Expresiones regulares

    /* Usuario */
    var expresion_regular_usuario = '^[A-Za-z0-9]+$';
    var patron_usuario = new RegExp(expresion_regular_usuario);

    /* Email */
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    /* Twitter */
    var twitter = $('#edittwitter').val();
    var expresion_regular_twitter = '^www\.twitter\.com\/[A-Za-z0-9_\.]+$';
    var patron_twitter = new RegExp(expresion_regular_twitter);

    /* Facebook */
    var facebook = $('#editfacebook').val();
    var expresion_regular_facebook = '^www\.facebook\.com\/[A-Za-z0-9_\.]+$';
    var patron_facebook = new RegExp(expresion_regular_facebook);

    /* Instagram */
    var instagram = $('#editinstagram').val();
    var expresion_regular_instagram = '^www\.instagram\.com\/[A-Za-z0-9_\.]+(\/){0,1}$';
    var patron_instagram = new RegExp(expresion_regular_instagram);

    /* Pagina web */
    var web = $('#editpaginaWeb').val();
    var expresion_regular_web = '^[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$';
    var patron_web = new RegExp(expresion_regular_web);

    if (email == null) {
        alert('Introduce el email');
        e.preventDefault();
    }

    if (usuario == null) {
        alert('Introduce el usuario');
        e.preventDefault();
    }

    if (nombre == null) {
        alert('Introduce el nombre');
        e.preventDefault();
    }

    if (apellidos == null) {
        alert('Introduce los apellidos');
        e.preventDefault();
    }

    // comprobación expresiones regulares
    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

    if (!patron_usuario.test(usuario)) {
        alert('Este nombre de usuario no esta permitido');
        e.preventDefault();
    }

    if (twitter != "") {
        if(!patron_twitter.test(twitter)) {
            alert('La URL de tu perfil de Twitter esta mal escrita.');
            e.preventDefault();
        }
    }

    if (facebook != "") {
        if(!patron_facebook.test(facebook)) {
            alert('La URL de tu perfil de Facebook esta mal escrita.');
            e.preventDefault();
        }
    }

    if (instagram != "") {
        if(!patron_instagram.test(instagram)) {
            alert('La URL de tu perfil de instagram esta mal escrita.');
            e.preventDefault();
        }
    }

    if (web != "") {
        if (!patron_web.test(web)) {
            alert('La URL de tu web esta mal escrita o quite el protocolo (http:// o https://).');
            e.preventDefault();
        }
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

    if (passwordNew == passwordNew2) {
        if (passwordNew.length < 6) {
            alert('La contraseña ha de tener un mínimo de 6 caracteres.');
            e.preventDefault();
        }
    }

}

function crear_editar_noticia(e) {
    var titulo_noticia = $('#tituloNoticia').val();
    var publico = $('#noticiaPublica').val();

    /* Regexp */
    var expresion_regular_titulo_noticia = '^[A-Za-z0-9_\-\s]+$';
    var patron_titulo_noticia = new RegExp(expresion_regular_titulo_noticia);

    if (titulo_noticia.length < 1 ) {
        alert('El título no puede quedar en blanco');
        e.preventDefault();
    }

    if (!patron_titulo_noticia.test(titulo_noticia)) {
        alert('Título para la notícia incorrecto.');
        e.preventDefault();
    }

    if ((publico != 1) && (publico != 0)) {
        alert('Valor de publico incorrecto')
        e.preventDefault();
    }

}

