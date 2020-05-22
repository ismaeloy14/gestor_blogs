{{-- VENTANA MODAL Update usuario --}}
<div class="modal fade" id="editModalBlog" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar blog</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEditBlog" method="post" class="form-horizontal">
                <div class="modal-body">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}

                    <input type="text" name="idBlog" id="editidBlog" hidden>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Titulo:</b> <input type="text" name="tituloBlog" id="edittitulo" class="col-sm-12" min="3" max="20" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Categoria:</b> <select name="categoria" id="editcategoria" class="col-sm-12"></select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Publico:</b> 
                            <select name="publico" id="editpublico" class="col-sm-12" required></select>
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

