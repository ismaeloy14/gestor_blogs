$(function(){
    $('#formulario_registro_usuarios').on('submit', formulario_registro_usuarios);// Formulario de registros
    $('#formulario_creacion_blog').on('submit', formulario_creacion_blog); // Formulario de creacion del blog

    $('#formCreate').on('submit', formulario_crudUsuarios_usuario);

    $('#formCreateBlog').on('submit', formulario_creacion_blog);
    /*$('#').on('submit', );
    $('#').on('submit', );
    $('#').on('submit', );
    $('#').on('submit', );
    $('#').on('submit', );
    $('#').on('submit', );*/

    



});

$('#tabla_crud_Usuarios').ready(function() {
    $('#tabla_crud_Usuarios').DataTable();
});


function formulario_registro_usuarios(e){
    var password = $('#registro_U_password').val();
    var password2 = $('#registro_U_password2').val();
    var email = $('#registro_U_email').val();
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    if (password != password2){
        alert('Las contraseñas no son iguales');
        e.preventDefault();
    }

    //console.log(patron_email);

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
    var expresion_regular_email = '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$';
    var patron_email = new RegExp(expresion_regular_email);

    if (password != password2){
        alert('Las contraseñas no son iguales');
        e.preventDefault();
    }

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }
}



