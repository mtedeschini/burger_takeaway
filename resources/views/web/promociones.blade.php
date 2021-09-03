@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/micuenta2.jpg);">

    <div class="slider-item" style="background-image: url(images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">Promociones</h1>
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
                <h2 class="mb-4">Promos</h2>
                <p>Estamos en C.A.B.A y G.B.A. Te esperamos en cualquiera de nuestras sucursales para retirar nuestras mejores hamburguesas.</p>
            </div>
        </div>
    </div>
        <div class="container-wrap">
            <div class="row no-gutters d-flex">


            @foreach ($aProductos as $producto)                            
                    <div class="col-lg-4 d-flex ftco-animate row">
                        <div class="col-5">
                            <img class="w-100 p-3" src="files/{{$producto->imagen}}" alt="">
                        </div>
                        <div class="text p-4 m-3 col-5">
                            <h3>{{$producto->nombre}}</h3>
                            <p> {{$producto->descripcion}}  </p>
                            <p style="color:orange">Precio: {{ number_format($producto->precio,2,",",".")}} </p> 
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
            </div>
        </div>
    </div>

</section> 

@endsection

