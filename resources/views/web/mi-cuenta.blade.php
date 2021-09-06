@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/micuenta3.jpg);">

<div class="slider-item" style="background-image: url(images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Mi Cuenta</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Mi Cuenta</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">						
          <div class="col-md-12 ftco-animate">
            <form action="#" class="contact-form">
            	<div class="row">
            		<div class="col-12 col-md-8">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Nombre" value="{{ $cliente->nombre }}">
	                </div>
                </div>
                
            		  <div class="col-12 col-md-8">
	                  <div class="form-group">
	                    <input type="text" class="form-control" placeholder="Apellido" value="{{ $cliente->apellido }}">
	                  </div>
	                </div>
                
                
            		  <div class="col-12 col-md-8">
	                  <div class="form-group">
	                    <input type="text" class="form-control" placeholder="Celular" value="{{ $cliente->telefonoo }}">
	                  </div>
                  </div>
                
               
            		  <div class="col-12 col-md-8">
	                  <div class="form-group">
	                    <input type="text" class="form-control" placeholder="Email" value="{{ $cliente->correo }}">
	                  </div>
                  </div>	
                  <div class="col-12 col-md-8">
	                  <div class="form-group">
                      <table class="table table-hover border">
	                      <input type="table" class="table table-hover border" placeholder="Pedidos Activos">        
                      </table> 
                    </div>
                  </div>	               
            </form>
          </div>
        </div>
      </div>
    </section>

    <div id="map"></div>
    @endsection