{{-- VENTANA MODAL Create blog --}}
<div class="modal fade" id="createModalBlog" role="dialog" style="overflow-y: scroll;">
    <div class="modal-dialog">
        <div id="containerUser" class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Crear blog</h4>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formCreateBlog" method="post" class="form-horizontal" action="{{url('/crudUsuarios/createBlog')}}">
                <div class="modal-body">
                        {{ csrf_field() }}

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Usuario:</b> 
                            <select name="usuario" id="createBlogUsuario" class="col-sm-12" required></select>
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Titulo del Blog:</b> <input type="text" name="tituloBlog" id="createtitulo_blog" class="col-sm-12" min="3" max="20" required>
                        </label>
                    </div>

                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Categoria:</b> 
                            <select name="categoria" id="createBlogCategoria" class="col-sm-12"></select>
                        </label>
                    </div>
                   
                    <div class="form-group col-sm-12">
                        <label class="col-sm-12 control-label">
                            <b class="col-sm-12">Público:</b> 
                                <select name="publico" id="publico" class="col-sm-12">
                                    <option value="1">Público</option>
                                    <option value="0">No público</option>
                                </select>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button name="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear blog</button>
                    </div>
                </div>
            </form>
               
        </div>

    </div>
</div>

