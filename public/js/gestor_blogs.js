$(function(){
    $('#formulario_registro_usuarios').on('submit', formulario_registro_usuarios);
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

    console.log(patron_email);

    if (!patron_email.test(email)) {
        alert('El email esta mal escrito.');
        e.preventDefault();
    }

    

}

