{{-- VENTANA MODAL Create usuario --}}
<div class="modal fade" id="createModal" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Crear usuario</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formCreate" method="post" class="form-horizontal" action="{{url('/crudUsuarios/createUsuario')}}">
                <div class="modal-body">
                        {{ csrf_field() }}

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Usuario:</b> <input type="text" name="usuario" id="createusuario" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Rol:</b> <select name="rol" id="createrol" class="col-sm-12" required></select>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Contraseña:</b> <input type="password" name="password" id="password" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Repite contraseña:</b> <input type="password" name="password2" id="password2" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Email:</b> <input type="email" name="email" id="createemail" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Fecha de Nacimiento:</b> <input type="date" name="fechaNacimiento" id="createfechaNacimiento" class="col-sm-12">
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Nombre:</b> <input type="text" name="nombre" id="createnombre" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Apellidos:</b> <input type="text" name="apellidos" id="createapellidos" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Pais:</b> 
                            <select name="pais" id="createpais" class="col-sm-12" required></select>
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Twitter:</b> <input type="text" name="twitter" id="createtwitter" class="col-sm-12" placeholder="Ejemplo: www.twitter.com/perfil">
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Facebook:</b> <input type="text" name="facebook" id="createfacebook" class="col-sm-12" placeholder="Ejemplo: www.facebook.com/perfil">
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Instagram:</b> <input type="text" name="instagram" id="createinstagram" class="col-sm-12" placeholder="Ejemplo: www.instagram.com/perfil">
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Página web:</b> <input type="text" name="paginaWeb" id="createpaginaWeb" class="col-sm-12">
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                </div>

            </form>
               
        </div>

    </div>
</div>

