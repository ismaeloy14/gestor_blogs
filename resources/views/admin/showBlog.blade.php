{{-- VENTANA MODAL Show blog--}}
<div class="modal fade" id="showModalblog" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Información del blog</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body">

                <div>
                    <label class="col-sm-12 control-label">
                        <b>Titulo:</b> <span id="showTituloBlog"></span>
                    </label>
                </div>
                <div>
                    <label class="col-sm-12 control-label">
                        <b>Responsable:</b> <span id="showUsuario"></span>
                    </label>
                </div>
                <div>
                    <label class="col-sm-12 control-label">
                        <b>Categoria:</b> <span id="showCataegoria"></span>
                    </label>
                </div>
                <div>
                    <label class="col-sm-12 control-label">
                        <b>Publico:</b> <span id="showPublico"></span>
                    </label>
                </div>

            </div>

            <div class="modal-footer">
                <a name="irBlog" id="irblog" target="_blank" class="btn btn-primary">Ir al blog</a>

                <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
               
        </div>

    </div>
</div>

