{{-- VENTANA MODAL DELETE NOTICIA --}}
<div class="modal fade" id="deleteModalNoticia" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Eliminar noticia</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDeleteNoticia" method="post" class="form-horizontal">
                <div class="modal-body">
                    {{ csrf_field() }}

                    <div>
                        <p class="col-sm-12">
                            ¿Estas seguro de querer eliminar esta noticia?
                        </p>
                    </div>

                    <div>
                        <label class="col-sm-12 control-label">
                            <b>Titulo:</b> <span id="deletetituloNoticia"></span>
                        </label>
                    </div>

                    
                </div>

                <div class="modal-footer">
                    <button name="cerrar" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>

            </form>
               
        </div>

    </div>
</div>

