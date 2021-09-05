@extends('web.plantilla-sitio')
@section('contenido')
@section('scripts')

<section style="background-image: url(web/images/bg_1.jpg);">
<form name="form" method="POST">
    <div class="container " style="max-width: 500px;">
        <div class="row ">
            <div class="col-12 col-sm-12 mt-5 mb-5">
                <div class="card text-white bg-dark"> 
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                            <form action="" method="post">
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
                                            <?php $total = 0; ?>
                                            @foreach($aCarritos as $carrito)
                                            <tr>
                                                <td scope="row">{{ $carrito->cantidad}}</td>
                                                <th scope="row">{{ $carrito->producto}}</th>
                                                <td class="text-center">
                                                    <?php 
                                                        $precioProducto = $carrito->precio * $carrito->cantidad; 
                                                        $total += $precioProducto;
                                                        echo "$" . number_format($precioProducto, 2); 
                                                    ?>
                                                    <br>
                                                    <form action="" method="POST">
                                                        <input class="btn btn-danger" type="button" value="Delete"></input>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <th scope="row" class="text-warning">TOTAL</th>
                                                <td class="text-center">${{ number_format($total, 2) }}</td>
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
                                        <label for="textarea">Comentarios </label>
                                        <textarea style="font-size: 15px;" class="form-control" id="textarea" name="txtComentarios" rows="1"> Sin comentarios</textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="row justify-content-around">
                                    <div class="col-12 text-center my-1" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <a href="/takeaway" class="btn btn-outline-light" style="width: 200px;"> Agregar más productos</a>
                                    </div>
                                    <div class="col-12 text-center my-1">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <button name="vaciar" type="submit" value="vaciar" class="btn btn-outline-light" style="width: 200px;">Vaciar carrito</button>
                                    </div>
                                    <div class="col-12 text-center my-1">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                        <button name="finalizar" type="submit" value="finalizar" class="btn btn-warning" style="width: 200px;"><b>Finalizar el pedido</button>
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