@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">NUESTRO MENÚ</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Inicio</a></span></p> 
                </div>

            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">TAKE AWAY</h2>
                <p>Estamos en C.A.B.A y G.B.A. Te esperamos en cualquiera de nuestras sucursales para retirar nuestras mejores hamburguesas.</p>
            </div>
        </div>
    </div>
        <div class="container">
            <div class="row no-gutters d-flex justify-content-center ">

            <!--Comienzo Item Menu-->
            @foreach ($aProductos as $producto)                            
                    <div class="col-lg-4 mb-4 d-flex ftco-animate row" style="height: 400px">
                        <div class="col-5">
                            <img src="files/{{$producto->imagen}}" style="max-width: 250px; height: 400px; object-fit: cover" alt="">
                        </div>
                        <div class="text p-4 m-3 col-5" style="height: 250px;">
                            <h3 >{{$producto->nombre}}</h3>
                            <p > {{$producto->descripcion}}  </p>
                            <p class="mb-0" style="color:orange">Precio: {{$producto->precio}} </p>
                            <div class="form-group ">
                                <label>Cantidad:</label>
                                <input type="number" maxlength="50" id="txtCantidad" name="txtCantidad" class="form-control" placeholder="0" required>
                            </div>
                            <a href="#" class="ml-2 btn btn-white btn-outline-white">Agregar</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
            <!--Fin Item Menu-->

            <!--Comienzo Item Menu-->
            @foreach ($aProductos as $producto)         
            <div class="col-md-4 col-12 p-sm-4 px-4 py-2">
                <div class="row tarjeta">
                    <div class="col-12 p-0">
                        <img src="files/{{$producto->imagen}}" style="max-width: 330px; height: 400px; object-fit: cover" alt="">
                        <!-- img-fluid para que se adapte la foto al tamaño del contenedor -->
                    </div>
                    <div class="col-12 color-gradiente py-3 px-3 text-center" style="height: 100px;">
                        <h3>{{$producto->nombre}}</h3>
                    </div>
                    <div class="col-12 text-center">
                        <p>{{$producto->descripcion}} </p>
                    </div>
                    <div class="row pt-2 text-center">
                        <div class="col-3 pt-3 pb-2">
                          <p>Cantidad:</p>
                        </div>
                          <div class="col-3 pt-1 pb-2">
                          <input type="number" maxlength="50" id="txtCantidad" name="txtCantidad" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-6 pt-3 pb-2">
                        <button><i class="icon-shopping-cart"></i> Agregar</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!--Fin Item Menu-->

            </div>
        </div>
    </div>

</section>

@endsection


