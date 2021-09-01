@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/grill.jpg);">

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
            <div class="row d-flex justify-content-center ">

            <!--Comienzo Item Menu-->
            @foreach ($aProductos as $producto)
            <div class="col-md-6 col-xl-4 col-12 p-sm-4 px-4 py-2 ftco-animate">
                <div class="row tarjeta d-flex justify-content-center">
                    <div class="col-12 p-0" style="overflow:hidden; height: 300px">
                        <img class="mx-auto d-block" src="files/{{$producto->imagen}}" style="height:340px;" alt="">
                    </div>
                    <div class="descripcion-items" style="background-color:rgb(18, 18, 18, .5);">
                        <div class="col-12 color-gradiente pt-3 text-center">
                            <h4>{{$producto->nombre}}</h4>
                        </div>
                        <div class="col-12 text-center">
                            <p>{{$producto->descripcion}} </p>
                        </div>
                        <div class="col-12 text-center">
                            <p class="precio-item"> Precio: ${{number_format($producto->precio,2,",",".")}}</p> 
                        </div>
                        <form action="" method="POST">
                            <div class="row pt-2 text-center d-flex justify-content-center">
                                <div class="col-3 pt-3 pb-2">
                                    <p>Cantidad:</p>
                                </div>
                                <div class="col-3 pt-1 pb-2">
                                    <input type="number" min="0" max="10" id="txtCantidad" name="txtCantidad" class="form-control" placeholder="0" required>
                                    <input type="hidden"id="txtProducto" name="txtProducto" class="form-control" value="{{$producto->idproducto}}">
                                </div>
                                <div class="col-4 pt-3 pb-2">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                    <button class="btn btn-primary p-3 px-xl-4 py-xl-3" type="submit"><i class="icon-shopping-cart"></i> Agregar</button>
                                </div>
                            </div>
                        </form>
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
