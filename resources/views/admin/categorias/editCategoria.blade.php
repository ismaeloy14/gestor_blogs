{{-- VENTANA MODAL Edit categoria --}}
<div class="modal fade" id="editModalCategoria" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Editar categoria</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formEditCategoria" method="post" class="form-horizontal">
                <div class="modal-body">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}

                    <input type="hidden" name="categoriaOriginal" id="categoriaOriginal">

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Nuevo nombre de categoria:</b> 
                            <input type="text" name="categoria" id="categoria" class="col-sm-12" required>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Editar categoria</button>
                    </div>
                </div>
            </form>
               
        </div>

    </div>
</div>

