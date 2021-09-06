@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
globalId = '<?php echo isset($sponsor->idsponsor) && $sponsor->idsponsor > 0 ? $sponsor->idsponsor : 0; ?>';
<?php $globalId = isset($sponsor->idsponsor) ? $sponsor->idsponsor : "0";?>
</script>

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/sponsors">Sponsor</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/sponsors/nuevo" class="fa fa-plus-circle"
            aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-save" aria-hidden="true"
            onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-alt" aria-hidden="true"
            onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-reply" aria-hidden="true"
            onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir() {
    location.href = "/admin";
}
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
    <div id="msg"></div>
    <?php
if (isset($msg)) {
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
    <form id="form1" method="POST" enctype="multipart/form-data">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
            <div class="form-group col-lg-6">
                <label>Nombre de la Empresa: *</label>
                <input type="text" id="txtNombreEmpresa" name="txtNombreEmpresa" class="form-control"
                value="{{$sponsor->nombre_empresa}}"
                    required>
            </div>
            <div class="form-group col-lg-6">
                <label>Nombre del Producto: *</label>
                <input type="text" id="txtNombreProducto" name="txtNombreProducto" class="form-control"
                value="{{$sponsor->nombre_producto}}"    required>
            </div>
            <div class="form-group col-lg-6">
                <label>Cantidad: *</label>
                <input type="text" id="intCantidad" name="intCantidad" class="form-control"
                value="{{$sponsor->cantidad_producto}}" required>
            </div>
            <div class="form-group col-lg-6">
                <label>Email: *</label>
                <input type="email" id="txtEmail" name="txtEmail" class="form-control"
                value="{{$sponsor->email}}" required>
            </div>
            <div class="form-group col-lg-6">
                <label>Descripcion: *</label>
                <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control"
                value="{{$sponsor->descripcion}}"   required>
            </div>
           
            <div class="form-group col-lg-6">
                <label>Teléfono: *</label>
                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control"
                value="{{$sponsor->telefono}}"    required>
            </div>
            <div class="form-group col-lg-6">
                <label for="archivo">Foto del producto:</label>
                <input type="file" id="archivo" name="archivo" class="form-control-file shadow" accept="all" 
                value="{{$sponsor->foto_producto}}">
                <small class="d-block">Foto: </small>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">¿Deseas eliminar el registro actual?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
            </div>
        </div>
    </div>
</div>
<script>
$("#form1").validate();

function guardar() {
    if ($("#form1").valid()) {
        modificado = false;
        form1.submit();
    } else {
        $("#modalGuardar").modal('toggle');
        msgShow("Corrija los errores e intente nuevamente.", "danger");
        return false;
    }
}

function eliminar() {
    $.ajax({
        type: "GET",
        url: "{{ asset('admin/sponsors/eliminar') }}",
        data: {
            id: globalId
        },
        async: true,
        dataType: "json",
        success: function(data) {
            if (data.err = "0") {
                msgShow("Registro eliminado exitosamente.", "success");
                $("#btnEnviar").hide();
                $("#btnEliminar").hide();
                $('#mdlEliminar').modal('toggle');
            } else {
                msgShow("Error al eliminar", "success");
            }
        }
    });
}
</script>
@endsection