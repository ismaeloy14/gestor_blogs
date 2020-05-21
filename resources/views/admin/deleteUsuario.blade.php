{{-- VENTANA MODAL DELETE --}}
<div class="modal fade" id="deleteModal" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Eliminar usuario</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDelete" method="post" class="form-horizontal">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{--<input type="text" name="idUsuario" id="deleteidUsuario" hidden>--}}

                    <div>
                        <p class="col-sm-12">
                            ¿Estas seguro de querer eliminar a este usuario?
                        </p>
                    </div>

                    <div>
                        <label class="col-sm-12 control-label">
                            <b>ID:</b> <span id="deleteidUsuario"></span>
                        </label>
                    </div>
                    <div>
                        <label class="col-sm-12 control-label">
                            <b>Usuario:</b> <span id="deleteusuario"></span>
                        </label>
                    </div>
                    <div>
                        <label class="col-sm-12 control-label">
                            <b>Rol:</b> <span id="deleterol"></span>
                        </label>
                    </div>

                    
                </div>

                <div class="modal-footer">
                    <button name="cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="cerrar" class="btn btn-danger">Eliminar</button>
                </div>

            </form>
               
        </div>

    </div>
</div>

