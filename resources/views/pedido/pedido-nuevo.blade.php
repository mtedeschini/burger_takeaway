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
                        @if (isset($sucursal->idsucursal) == $pedido->fk_idsucursal)
=======
                        @if (isset($sucursal->idsucursal) == $pedido->fk_idsucursal)
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                            <option  selected value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                        @else
                            <option  value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                        @endif
<<<<<<< HEAD
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Cliente: </label>
                <select id="txtCliente" name="txtCliente" class="form-control" required>
                    <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aClientes as $cliente)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                            <option  value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
=======
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
                        @if (isset($cliente->idcliente) == $entidadPedido->fk_idcliente)
                            <option  selected value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @else
                            <option value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @endif
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                        @if (isset($cliente->idcliente) == $entidadPedido->fk_idcliente)
=======
                        @if (isset($cliente->idcliente) == $pedido->fk_idcliente)
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                        @if (isset($cliente->idcliente) == $entidadPedido->fk_idcliente)
=======
                        @if (isset($cliente->idcliente) == $pedido->fk_idcliente)
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                            <option selected value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @else
                            <option value="{{$cliente->idcliente}}">{{$cliente->nombre}}</option>
                        @endif
<<<<<<< HEAD
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label for="txtFechaHora" class="d-block">Fecha y Hora:</label>
                <select class="form-control d-inline" name="txtDia" id="txtDia" style="width: 80px">
                    <option selected="" disabled="">DD</option>
                    @for ($i = 1; $i <= 31; $i++)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        <option value="{{ $i }}">{{ $i }}</option>
=======
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                        @if ($entidadPedido->fecha != "" and $i == date_format(date_create($entidadPedido->fecha),"d"))
=======
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"d"))
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                        @if ($entidadPedido->fecha != "" and $i == date_format(date_create($entidadPedido->fecha),"d"))
=======
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"d"))
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                            <option selected value="{{ $i }}">{{ $i}}</option>
                        @else
                            <option value="{{ $i }}">{{ $i}}</option>
                        @endif 
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endfor
                </select>
                <select class="form-control d-inline" name="txtMes" id="txtMes" style="width: 80px">
                    <option selected="" disabled="">MM</option>
                    @for ($i = 1; $i <= 12; $i++)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        <option value="{{ $i }}">{{ $i }}</option>
=======
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                        @if ($entidadPedido->fecha != "" and $i == date_format(date_create($entidadPedido->fecha),"m"))
=======
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"m"))
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                        @if ($entidadPedido->fecha != "" and $i == date_format(date_create($entidadPedido->fecha),"m"))
=======
                        @if ($pedido->fecha != "" and $i == date_format(date_create($pedido->fecha),"m"))
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                            <option selected value="{{ $i }}">{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endif
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endfor
                </select>
                <select class="form-control d-inline" name="txtAnio" id="txtAnio" style="width: 100px">
                    <option selected="" disabled="">YYYY</option>
                    @for ($i = 2000; $i <= date("Y"); $i++) 
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        <option value="{{ $i }}">{{ $i }}</option>
=======
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                        @if ($entidadPedido->fecha != ""  and $i == date_format(date_create($entidadPedido->fecha),"Y"))
=======
                        @if ($pedido->fecha != ""  and $i == date_format(date_create($pedido->fecha),"Y"))
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                        @if ($entidadPedido->fecha != ""  and $i == date_format(date_create($entidadPedido->fecha),"Y"))
=======
                        @if ($pedido->fecha != ""  and $i == date_format(date_create($pedido->fecha),"Y"))
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                            <option select value="{{ $i }}">{{ $i }}</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}</option>
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
                        @endif
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
                        @endif
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endfor
                </select>
                <input type="time" required="" class="form-control d-inline" style="width: 120px" name="txtHora" id="txtHora">
            </div>
            <div class="form-group col-lg-6">
                <label>Estado de pago: </label>
                <select id="txtEstadoPago" name="txtEstadoPago" class="form-control" required>
                <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aEstadoPagos as $estadoPago)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                            <option value="{{$estadoPago->idestadopago}}">{{$estadoPago->nombre}}</option>
=======
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                            @if (isset($estadoPago->idestadopago) and $entidadPedido->fk_estadopago)
=======
                            @if (isset($estadoPago->idestadopago) and $pedido->fk_estadopago)
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                            @if (isset($estadoPago->idestadopago) and $entidadPedido->fk_estadopago)
=======
                            @if (isset($estadoPago->idestadopago) and $pedido->fk_estadopago)
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                                <option selected value="{{$estadoPago->idestadopago}}">{{$estadoPago->nombre}}</option>
                            @else
                                <option value="{{$estadoPago->idestadopago}}">{{$estadoPago->nombre}}</option>
                            @endif
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Total:</label>
                <input type="text" maxlength="50" id="txtTotal" name="txtTotal" class="form-control" value="" required>
            </div>
            <div class="form-group col-lg-6">
                <label>Estado de pedido:</label>
                <select id="txtEstadoPedido" name="txtEstadoPedido" class="form-control">
                <option value="" disabled selected>Seleccionar</option>
                    @foreach ($aEstados as $estado)
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                            <option value="{{$estado->idestado}}">{{$estado->nombre}}</option>
=======
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                            @if (isset($estado->idestado) == $entidadPedido->fk_estado)
=======
                            @if (isset($estado->idestado) == $pedido->fk_estado)
>>>>>>> 68addd592c18fa0e67fe7f83b3cca0aca8a0c462
=======
                            @if (isset($estado->idestado) == $entidadPedido->fk_estado)
=======
                            @if (isset($estado->idestado) == $pedido->fk_estado)
>>>>>>> 1626b41ab6762d6ada91df7c003c1e65481eaf5e
>>>>>>> 34b9da231040f3befcb528ce98e59a99abfaac0d
                                <option selected value="{{$estado->idestado}}">{{$estado->nombre}}</option>
                            @else
                                <option value="{{$estado->idestado}}">{{$estado->nombre}}</option>
                            @endif
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 3d978005a327f06825d0b7d92a0ecf44b1eb7d4b
=======
>>>>>>> 7061f9e3906b01613f7b7c795a616b1750464831
=======
>>>>>>> ddc8bf8e3909045f2dbbbed547190fb0d010201d
=======
>>>>>>> b3d114c67b788c160658ae780e243f14349bd20c
                    @endforeach
                </select>
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
            url: "{{ asset('/admin/pedido/eliminar') }}",
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