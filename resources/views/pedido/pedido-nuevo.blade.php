@extends('plantilla')
@section('titulo', "$titulo")
@section('scripts')

<script>
    globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
    <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0"; ?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
    <li class="breadcrumb-item active">Modificar</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/pedido/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
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
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aSucursales as $sucursal)
                        @if (isset($sucursal->idsucursal) && $sucursal->idsucursal == $pedido->fk_idsucursal)
                            <option  selected value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                        @else
                            <option  value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Cliente: </label>
                <select id="txtCliente" name="txtCliente" class="form-control" required>
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aClientes as $cliente)
                        @if ((isset($cliente->idcliente) && $cliente->idcliente == $pedido->fk_idcliente))
                            <option selected value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @else
                            <option value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtFechaHora" class="d-block">Fecha y Hora:</label>
                <select class="form-control d-inline" name="txtDia" id="txtDia" style="width: 80px">
                    <option selected="" disabled="">DD</option>
                    @for ($i = 1; $i <= 31; $i++)
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"d"))
                            <option selected value="{{ $i }}">{{ $i}}</option>
                        @else
                            <option value="{{ $i }}">{{ $i}}</option>
                        @endif 
                    @endfor
                </select>
                <select class="form-control d-inline" name="txtMes" id="txtMes" style="width: 80px">
                    <option selected="" disabled="">MM</option>
                    @for ($i = 1; $i <= 12; $i++)
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"m"))
                            <option selected value="{{ $i }}">{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
                <select class="form-control d-inline" name="txtAnio" id="txtAnio" style="width: 100px">
                    <option selected="" disabled="">YYYY</option>
                    @for ($i = 2021; $i <= date("Y"); $i++) 
                        @if ($pedido->fecha != ""  and $i == date_format(date_create($pedido->fecha),"Y"))
                            <option selected value="{{ $i }}">{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
                    @endfor
                </select>
                @if ($pedido->fecha != ""  and $i == date_format(date_create($pedido->fecha),"H:i"))
                    <input type="time" required="" class="form-control d-inline" style="width: 120px" name="txtHora" id="txtHora" value="{{ $i }}">
                @else
                <input type="time" required="" class="form-control d-inline" style="width: 120px" name="txtHora" id="txtHora" value="">
                @endif

            </div>
            <div class="form-group col-lg-6">
                <label>Estado de pago: </label>
                <select id="txtEstadoPago" name="txtEstadoPago" class="form-control" required>
                <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aEstadoPagos as $estadoPago)
                            @if (isset($estadoPago->idestadopago) && $estadoPago->idestadopago == $pedido->fk_idestadopago)
                                <option selected value="{{$estadoPago->idestadopago}}">{{$estadoPago->nombre}}</option>
                            @else
                                <option value="{{$estadoPago->idestadopago}}">{{$estadoPago->nombre}}</option>
                            @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Total:</label>
                    <input type="text" maxlength="50" id="txtTotal" name="txtTotal" class="form-control" value="{{$pedido->total}}" >
            </div>
            <div class="form-group col-lg-6">
                <label>Estado de pedido:</label>
                <select id="txtEstadoPedido" name="txtEstadoPedido" class="form-control">
                <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aEstados as $estado)
                            @if ((isset($estado->idestado) && $estado->idestado == $pedido->fk_idestado))
                                <option selected value="{{$estado->idestado}}">{{$estado->nombre}}</option>
                            @else
                                <option value="{{$estado->idestado}}">{{$estado->nombre}}</option>
                            @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-6">
                <label>Detalle del Pedido:</label>
                    <table id="grilla" class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead> 
                    @if (isset($aPedidoDetalles))
                        @foreach ($aPedidoDetalles as $detalle)
                        <tr>
                            <th scope="row">{{$detalle->producto }}</th>
                            <td>{{$detalle->cantidad }}</td>
                            <td>$ {{ number_format($detalle->precio_unitario,2,",",".")}}</td>                 
                            <td>$ {{ number_format($detalle->precio_unitario * $detalle->cantidad)}} </td>                 
                        </tr>
                        @endforeach
                    @endif
                    
                    <tr class="thead-dark">
                        <th colspan="3">Total</th>
                        <th>$ {{number_format($pedido->total,2,",",".")}} </th>
                    </tr>

                </table>
                </select>
            </div>

        </div>
    </form>
    </div>
    
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
            url: "{{ asset('admin/sistema/menu/eliminar') }}",
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