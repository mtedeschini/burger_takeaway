@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')
<script>
<<<<<<< HEAD
<<<<<<< HEAD
globalId = '<?php echo isset($producto->idpostulacion) && $producto->idpostulacion > 0 ? $producto->idpostulacion : 0; ?>';
<?php $globalId = isset($producto->idpostulacion) ? $producto->idpostulacion : "0";?>
=======
globalId = '<?php echo isset($postulacion->idpostulacion) && $postulacion->idpostulacion > 0 ? $postulacion->idpostulacion : 0; ?>';
<?php $globalId = isset($postulacion->idpostulacion) ? $postulacion->idpostulacion : "0";?>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
globalId = '<?php echo isset($postulacion->idpostulacion) && $postulacion->idpostulacion > 0 ? $postulacion->idpostulacion : 0; ?>';
<?php $globalId = isset($postulacion->idpostulacion) ? $postulacion->idpostulacion : "0";?>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/postulaciones">Postulaciones</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/postulacion/nuevo" class="fa fa-plus-circle"
            aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true"
            onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true"
            onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true"
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
                <label>Nombre: *</label>
                <input type="text" id="txtNombre" name="txtNombre" class="form-control"
<<<<<<< HEAD
<<<<<<< HEAD
                    value="{{ $postulacion->nombre or '' }}" required>
=======
                    value="{{ $postulacion->nombre }}" required>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                    value="{{ $postulacion->nombre }}" required>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
            </div>
            <div class="form-group col-lg-6">
                <label>Apellido: *</label>
                <input type="text" id="txtApellido" name="txtApellido" class="form-control"
<<<<<<< HEAD
<<<<<<< HEAD
                    value="{{ $postulacion->apellido or '' }}" required>
=======
                    value="{{ $postulacion->apellido }}" required>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                    value="{{ $postulacion->apellido }}" required>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
            </div>
            <!--<div class="form-group col-lg-6">
                <label>Localidad: *</label>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
               <select  id="lstLocalidad" name="lstLocalidad" class="form-control" required>
                    <option disabled selected>Seleccionar</option>
                    <option value="">CABA</option>
                </select>
            </div>-->
            <div class="form-group col-lg-6">
                <label>Localidad: *</label>
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="" required>
=======
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="{{ $postulacion->localidad or '' }}" required>
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="{{ $postulacion->localidad or '' }}" required>
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="{{ $postulacion->localidad or '' }}" required>
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="{{ $postulacion->localidad }}" required>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                <input type="text" id="txtLocalidad" name="txtLocalidad" class="form-control"
                    value="{{ $postulacion->localidad }}" required>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
            </div>
            <div class="form-group col-lg-6">
                <label>Documento: *</label>
                <input type="text" id="txtDocumento" name="txtDocumento" class="form-control"
<<<<<<< HEAD
<<<<<<< HEAD
                    value="{{ $postulacion->documento or '' }}" required>
=======
                    value="{{ $postulacion->documento }}" required>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                    value="{{ $postulacion->documento }}" required>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
            </div>
            <div class="form-group col-lg-6">
                <label>Correo: *</label>
                <input type="text" id="txtCorreo" name="txtCorreo" class="form-control"
<<<<<<< HEAD
<<<<<<< HEAD
                    value="{{ $postulacion->correo or '' }}" required>
=======
                    value="{{ $postulacion->correo }}" required>
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                    value="{{ $postulacion->correo }}" required>
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
            </div>
            <div class="form-group col-lg-6">
                <label>Teléfono: *</label>
                <input type="text" id="txtTelefono" name="txtTelefono" class="form-control"
<<<<<<< HEAD
<<<<<<< HEAD
                    value="{{ $postulacion->telefono or '' }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtArchivo">Archivo adjunto:</label>
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                <input type="file" id="txtArchivo" name="txtArchivo" class="form-control-file shadow" accept=".pdf">
=======
                <input type="file" id="txtArchivo" name="txtArchivo" class="form-control-file shadow" accept=".pdf" value="{{ $postulacion->archivo_cv or '' }}">
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
                <input type="file" id="txtArchivo" name="txtArchivo" class="form-control-file shadow" accept=".pdf" value="{{ $postulacion->archivo_cv or '' }}">
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
                <input type="file" id="txtArchivo" name="txtArchivo" class="form-control-file shadow" accept=".pdf" value="{{ $postulacion->archivo_cv or '' }}">
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    value="{{ $postulacion->telefono }}" required>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtArchivo">Archivo adjunto:</label>
                <input type="file" id="txtArchivo" name="txtArchivo" class="form-control-file shadow" accept=".pdf" value="{{ $postulacion->archivo_cv }}">
<<<<<<< HEAD
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                <small class="d-block">Archivo CV: .pdf</small>
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
        url: "{{ asset('admin/postulacion/eliminar') }}",
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