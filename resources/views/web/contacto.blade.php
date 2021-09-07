@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">

    <div class="slider-item" style="background-image: url(web/images/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center">

                <div class="col-md-7 col-sm-12 text-center ftco-animate">
                    <h1 class="mb-3 mt-5 bread">CONTÁCTANOS</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Inicio</a></span>
                        <span>Contacto</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section contact-section">
    <div class="container mt-5">
        <div class="row block-9 justify-content-around">
            <div class="col-md-6 ftco-animate">
                <form action="#" class="contact-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="txtNombre" id="txtNombre" class="form-control" placeholder="Nombre:">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="txtCorreo" id="txtCorreo" class="form-control" placeholder="Email:">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="txtAsunto" id="txtAsunto" class="form-control" placeholder="Asunto:">
                    </div>
                    <div class="form-group">
                        <textarea name="txtMensaje" id="txtMensaje" cols="30" rows="7" class="form-control"
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