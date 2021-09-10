@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">

    <div class="slider-item" style="background-image: url(web/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">QUIERES SUMAR TUS PRODUCTOS A NUESTRA EMPRESA?</h1>
                    <h1 class="mb-3 mt-5 bread">Contactanos!</h1>
                    <p class="breadcrumbs"><h4 class="mr-2"><a href="/">Inicio</a></h4></span>
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
            <div class="row d-flex justify-content-center mt-3 ">
                <h1>Nuestros Socios . . .</h1>
            </div>
            <div class="row d-flex justify-content-center p-4 rounded" style="background: rgba(0,0,0,0.3);">

            <!--Comienzo Item Menu-->
           
            @foreach ($aSponsors as $sponsor)
            <div class="col-lg-3 col-md-6 col-sm-12 ftco-animate">
                <div class="d-flex justify-content-around flex-nowrap">
                    <div class="descripcion-items" style="background-color:rgb(18, 18, 18, .5);">
                    
                        <div class="col-12 p-0" >
                             <img class="mx-auto d-block rounded m-4" src="files/{{$sponsor->foto_producto}}" style="height:15em; width:17em;" alt="">
                        </div>
                       
                    </div>
                </div>
            </div>
            @endforeach
            <!--Fin Item Menu-->

            </div>
        </div>
        <section class="ftco-section contact-section">
            <div class="container mt-3">
                <div class="row block-9 justify-content-around">
                    <div class="col-md-6 ftco-animate">
                        <form action="" method="POST" class="contact-form">
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