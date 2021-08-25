@extends('web.plantilla-sitio')
@section('contenido')
<section style="background-image: url(web/images/bg_1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 mt-5 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6 col-sm-6">
                                    <img src="" alt="">
                                    NombreProducto
                                </div>
                                <div class="col-6 col-sm-6 text-center">
                                    <a href="#">X</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 mt-5">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Precio</th>
                                                <td class="text-center">PrecioProducto</td>
                                            </tr>
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
                                    <p>Sucursal donde retirar el pedido</p>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <select class="custom-select">
                                        <option selected>Seleccionar:</option>
                                        <option value="1">...</option>
                                        <option value="2">...</option>
                                        <option value="3">...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-12 mt-5">
                                    <div class="form-group">
                                        <label for="textarea">Example textarea</label>
                                        <textarea class="form-control" id="textarea" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-sm-6 text-center">
                                    <button class="btn btn-warning">Continuar con el pedido</button>
                                </div>
                                <div class="col-6 col-sm-6 text-center">
                                    <button class="btn btn-warning">Finalizar el pedido</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection