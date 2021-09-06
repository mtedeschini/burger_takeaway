@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">

    <div class="slider-item" style="background-image: url(web/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">QUIERES SUMAR TUS PRODUCTOS A NUESTRA EMPRESA?</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="/">Inicio</a></span>
                        <span>Contactanos!</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
            <div class="row d-flex justify-content-center ">
                <h1>Empresas que trabajan con nosotros</h1>
            </div>
            <div class="row d-flex justify-content-center ">

            <!--Comienzo Item Menu-->
           
            @foreach ($aSponsors as $sponsor)
            <div class="col-md-6 col-xl-4 col-12 p-sm-4 px-4 py-2 ftco-animate">
                <div class="row tarjeta d-flex justify-content-center">
                    <div class="descripcion-items" style="background-color:rgb(18, 18, 18, .5);">
                        <div class="col-12 color-gradiente pt-3 text-center">
                            <h2>{{$sponsor->nombre_empresa}}</h2>
                        </div>
                        <div class="col-12 p-0" style="overflow:hidden; height: 200px">
                             <img class="mx-auto d-block " src="files/{{$sponsor->foto_producto}}" style="height:240px;" alt="">
                        </div>
                        <div class="col-12 text-center">
                            <h4>{{$sponsor->nombre_producto}} </h4>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!--Fin Item Menu-->

            </div>
        </div>
<section class="ftco-section contact-section">
    <div class="container mt-5">
        <div class="row block-9 justify-content-around">
            <div class="col-md-6 ftco-animate">
                <form action="#" class="contact-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre De la Empresa:">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email:">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Asunto:">
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control"
                            placeholder="Mensaje:"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Enviar" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection