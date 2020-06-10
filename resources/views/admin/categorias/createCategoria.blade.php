{{-- VENTANA MODAL Create categoria --}}
<div class="modal fade" id="createModalCategoria" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Crear categoria</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formCreateCategoria" method="post" class="form-horizontal" action="{{url('/crudUsuarios/administrarCategorias/createCategoria')}}">
                <div class="modal-body">
                        {{ csrf_field() }}

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Nombre categoria:</b> 
                            <input type="text" name="categoria" class="col-sm-12" required>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear categoria</button>
                    </div>
                </div>
            </form>
               
        </div>

    </div>
</div>

