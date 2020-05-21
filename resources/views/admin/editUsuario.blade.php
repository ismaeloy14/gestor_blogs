{{-- VENTANA MODAL Update usuario --}}
<div class="modal fade" id="editModal" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar usuario</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEdit" method="post" class="form-horizontal">
                <div class="modal-body">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}

                    <input type="text" name="idUsuario" id="editidUsuario" hidden>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Usuario:</b> <input type="text" name="usuario" id="editusuario" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Rol:</b> <select name="rol" id="editrol" class="col-sm-12"></select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Email:</b> <input type="email" name="email" id="editemail" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Nombre:</b> <input type="text" name="nombre" id="editnombre" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Apellidos:</b> <input type="text" name="apellidos" id="editapellidos" class="col-sm-12" required>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Fecha de Nacimiento:</b> <input type="date" name="fechaNacimiento" id="editfechaNacimiento" class="col-sm-12">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Pais:</b> 
                            <select name="pais" id="editpais" class="col-sm-12" required></select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Twitter:</b> <input type="text" name="twitter" id="edittwitter" class="col-sm-12">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Facebook:</b> <input type="text" name="facebook" id="editfacebook" class="col-sm-12">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Instagram:</b> <input type="text" name="instagram" id="editinstagram" class="col-sm-12">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Página web:</b> <input type="text" name="paginaWeb" id="editpaginaWeb" class="col-sm-12">
                        </label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

            </form>
               
        </div>

    </div>
</div>

