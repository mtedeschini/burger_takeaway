@extends('web.plantilla-sitio')
@section('contenido')
<form name="form" method="POST">
<section style="background-image: url(web/images/bg_1.jpg);">
    <div class="container" style="width: 400px;">
        <div class="row">
            <div class="col-12 col-sm-12 mt-5 mb-5">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <div class="container">
                            <?php
                            if (isset($msg)) {
                                echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
                            }
                            ?>
                            <div class="row">
                                <div class="col-10 col-sm-10">
                                    <img src="web/images/burgerCarrito.jpg" alt="Hamburguesa" width="30%" height="100%">
                                    Hamburguesa
                                </div>
                                <div class="col-2 col-sm-2 text-center">
                                    <a href="#">X</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 mt-5">
                                    <table class="table">
                                        <tbody>
                                            @foreach($aCarritos as $carrito)
                                            <tr>
                                                <th scope="row">{{ $carrito->producto}}</th>
                                                <td class="text-center">${{ $carrito->precio}}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th scope="row" class="text-warning">TOTAL</th>
                                                <td class="text-center">PrecioProducto</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <label>Sucursal de su pedido: </label>
                                    <select id="txtSucursal" name="txtSucursal" class="form-control" required>
                                        <option value="" disabled selected>Seleccionar</option>
                                        @foreach ($aSucursales as $sucursal)
                                            @if (isset($sucursal->idsucursal) && $sucursal->idsucursal == $sucursal->idsucursal)
                                                <option  value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                                            @else
                                                <option  value="{{$sucursal->idsucursal}}">{{$sucursal->nombre}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 mt-3">
                                    <label>Abona por: </label>
                                    <select id="txtAbona" name="txtAbona" class="form-control" required>
                                        <option value="" disabled selected>Seleccionar</option>
                                            <option  value="">En local</option>
                                            <option  value="">Mercado Pago</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 mt-5">
                                    <div class="form-group">
                                        <label for="textarea">Comentarios...</label>
                                        <textarea class="form-control" id="textarea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-6 col-sm-6 text-center">
                                        <button class="btn btn-warning">Modificar el pedido</button>
                                    </div>
                                    <div class="col-6 col-sm-6 text-center">
                                        <button class="btn btn-warning">Finalizar el pedido</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form>
@endsection