{{-- VENTANA MODAL Edit categoria --}}
<div class="modal fade" id="deleteModalCategoria" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Eliminar categoria</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDeleteCategoria" method="post" class="form-horizontal">
                <div class="modal-body">
                        {{ csrf_field() }}

                    <div>
                        <p class="col-sm-12">
                            ¿Estas seguro de querer eliminar esta categoria?
                        </p>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Categoria:</b> 
                            <span id="nombreCategoria"></span>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button name="cerrar" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar categoria</button>
                    </div>
                </div>
            </form>
               
        </div>

    </div>
</div>

