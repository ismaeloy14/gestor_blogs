{{-- VENTANA MODAL DELETE --}}
<div class="modal fade" id="deleteModalBlog" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Eliminar blog</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDeleteBlog" method="post" class="form-horizontal">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{--<input type="text" name="idUsuario" id="deleteidUsuario" hidden>--}}

                    <div>
                        <p class="col-sm-12">
                            ¿Estas seguro de querer eliminar este blog?
                        </p>
                    </div>

                    <div>
                        <label class="col-sm-12 control-label">
                            <b>ID:</b> <span id="deleteidBlog"></span>
                        </label>
                    </div>
                    <div>
                        <label class="col-sm-12 control-label">
                            <b>Titulo:</b> <span id="deletetituloBlog"></span>
                        </label>
                    </div>

                    <div>
                        <label class="col-sm-12 control-label">
                            <b>Responsable:</b> <span id="deleteBlogUsuario"></span>
                        </label>
                    </div>

                    
                </div>

                <div class="modal-footer">
                    <button name="cerrar" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="cerrar" class="btn btn-danger">Eliminar</button>
                </div>

            </form>
               
        </div>

    </div>
</div>

