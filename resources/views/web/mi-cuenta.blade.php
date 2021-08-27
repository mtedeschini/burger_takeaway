@extends('web.plantilla-sitio')
@section('contenido')

<section class="home-slider owl-carousel img" style="background-image: url(web/images/micuenta2.jpg);">

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
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Nombre">
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Apellido">
	                </div>
	                </div>
                </div>
                <div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Celular">
	                </div>
                </div>
                <div class="row">
            		<div class="col-md-12">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Email">
	                </div>
                </div>	
                <table class="table table-hover border">
	                  <input type="table" class="table table-hover border" placeholder="Pedidos Activos">        
                </table>                
            </form>
          </div>
        </div>
      </div>
    </section>

    <div id="map"></div>
    @endsection