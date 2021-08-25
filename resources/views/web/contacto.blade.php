@extends('web.plantilla-sitio')
@section('contenido')

    <section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">

      <div class="slider-item" style="background-image: url(web/images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">CONTACTANOS</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Inicio</a></span> <span>Contacto</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					<div class="col-md-4 contact-info ftco-animate">
						<div class="row">
							<div class="col-md-12 mb-4">
	              <h2 class="h4">Información de Contacto</h2>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Dirección:</span> Av. Alicia Moreau de Justo 1150, C1107 AAX, Buenos Aires</p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Teléfono:</span> <a href="tel://1234567920">+54 9 11 34075725</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@burguers.com</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Sitio Web:</span> <a href="#">burguers.com</a></p>
	            </div>
						</div>
					</div>
					<div class="col-md-1"></div>
          <div class="col-md-6 ftco-animate">
            <form action="#" class="contact-form">
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Nombre">
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Email">
	                </div>
	                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <div id="map"></div>
    @endsection