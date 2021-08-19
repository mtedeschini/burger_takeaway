@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')

<script>
    globalId = '<?php

echo isset($sucursal->idsucursal) && $sucursal->idsucursal > 0 ? $sucursal->idsucursal : 0; ?>';
    <?php $globalId = isset($sucursal->idsucursal) ? $sucursal->idsucursal : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/sucursal/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fas fa-save" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if ($globalId > 0)
    <li class="btn-item"><a title="Eliminar" href="#" class="fas fa-trash-alt" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a>
    </li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fas fa-reply" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
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
    <form id="form1" method="POST">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>

            <div class="form-group col-lg-6">
                <label>Sucursal: </label>
                <select id="txtSucursal" name="txtSucursal" class="form-control" required>
                    @foreach ($aSucursales as $sucursal)
                        <option selected value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-lg-6">
                <label>Cliente: </label>
                <select id="txtCliente" name="txtCliente" class="form-control" required>
                    @foreach ($aClientes as $cliente)
                            <option selected value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Fecha: </label>
                <input type="tet" maxlength="50" id="txtSubmodulo" name="txtSubmodulo" class="form-control" value="" required>
            </div>

            <div class="form-group col-lg-6">
                <label>Estado del pago: </label>
                <select id="txtOperacion" name="txtOperacion" class="form-control">
                    <option value="1" selected>Sí</option>
                    <option value="0" selected>No</option>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Total:</label>
                <input type="text" maxlength="50" id="txtNombre" name="txtNombre" class="form-control" value="" required>
            </div>
            <div class="form-group col-lg-6">
                <label>Estado del pedido:</label>
                <input type="text" maxlength="50" id="txtNombre" name="txtNombre" class="form-control" value="" required>
            </div>
        </div>
</div>
</form>
</div>
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            url: "{{ asset('/admin/patente/eliminar') }}",
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
                    $("form").hide();
                } else {
                    msgShow("Error al eliminar", "success");
                }
            }
        });
    }
</script>
@endsection