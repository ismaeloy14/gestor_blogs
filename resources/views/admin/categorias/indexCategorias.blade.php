@extends('layouts.master')

@section('body')

@include('admin.categorias.createCategoria')
@include('admin.categorias.editCategoria')
@include('admin.categorias.deleteCategoria')


<div id="div_principal">
    <h2>Administrar categorias</h2>

    @if ($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif

    <table class="table" id="tabla_Categorias">
        <thead>
            <tr>
                <th>Categorias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $cat)
                
                <tr>

                    <td>{{$cat->categoria}}</td>
                    <td>
                        @if ($cat->categoria != 'Sin categoria')
                            <button class="btn btn-primary" name="modalEditarCategoria" value="{{$cat->categoria}}">Editar categoria</button>
                            <button class="btn btn-danger" name="modalEliminarCategoria" value="{{$cat->categoria}}">Eliminar categoria</button>
                        @endif
                    </td>

                </tr>

            @endforeach
        </tbody>
        
    </table>

</div>


<div id="botonCrearCategorias">
    <button class="btn btn-success" name="modalCrearCategoria">Crear categoria</button>
</div>



@include('layouts.footer')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<script>
    $("button[name='modalCrearCategoria']").on('click', function() { // Modal crear categoria
        var urlShow = "{{ url('/crudUsuarios/administrarCategorias/showCreateCategoria')}}";

        //console.log(urlShow);

        $.get(urlShow)
            .done(function(data) {

            //console.log(data);

            $("#createModalCategoria").modal('toggle');
            $('#createModalCategoria').modal('show');

            }).fail(function() {
                alert('No se ha podido cargar la ventana modal de create categoria');
            });
    });

    $("button[name='modalEditarCategoria']").on('click', function() { // Modal editar categoria
        var categoria = this.value;
        var urlShow = "{{ url('/crudUsuarios/administrarCategorias/showEditCategoria?categoria=')}}";
        var urlForm = "{{ url('/crudUsuarios/administrarCategorias/editCategoria/')}}"
        var urlFormCompleta = urlForm+'/'+categoria;

        //console.log(urlShow);

        $.get(urlShow+categoria)
            .done(function(data) {

            //console.log(data);
            $('#categoriaOriginal').val(data[0].categoria);

            $('#categoria').val(data[0].categoria);

            $('#formEditCategoria').attr("action", urlFormCompleta);
            

            $("#editModalCategoria").modal('toggle');
            $('#editModalCategoria').modal('show');

            }).fail(function() {
                alert('No se ha podido cargar la ventana modal de edit categoria');
            });
    });

    $("button[name='modalEliminarCategoria']").on('click', function() { // Modal eliminar categoria
        var categoria = this.value;
        var urlShow = "{{ url('/crudUsuarios/administrarCategorias/showDeleteCategoria?categoria=')}}";
        var urlForm = "{{ url('/crudUsuarios/administrarCategorias/deleteCategoria/')}}"
        var urlFormCompleta = urlForm+'/'+categoria;

        //console.log(urlShow);

        $.get(urlShow+categoria)
            .done(function(data) {

            console.log(data);
            $('#nombreCategoria').text(data[0].categoria);

            $('#formDeleteCategoria').attr("action", urlFormCompleta);
            

            $("#deleteModalCategoria").modal('toggle');
            $('#deleteModalCategoria').modal('show');

            }).fail(function() {
                alert('No se ha podido cargar la ventana modal de delete categoria');
            });
    });

</script>

@endsection