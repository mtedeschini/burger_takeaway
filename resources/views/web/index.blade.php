@extends('web.plantilla-sitio')
@section('contenido')
<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">
      <div class="slider-item">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">

            <div class="col-md-6 col-sm-12 ftco-animate">
            	<span class="subheading">Clasic</span>
              <h1 class="mb-4">Burgers</h1>
              <p class="mb-4 mb-md-5">Solo para los amantes de las hamburguesas.</p>
              <p> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>
            <div class="col-md-6 ftco-animate">
            	<img src="web/images/burger08.png" class="img-fluid" alt="">
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center" data-scrollax-parent="true">

            <div class="col-md-6 col-sm-12 order-md-last ftco-animate">
            	<span class="subheading">Bacombo </span>
              <h1 class="mb-4">Burgers</h1>
              <p class="mb-4 mb-md-5">Disfruta de 2 hamburguesas Bacon doble por $850.</p>
              <p><a href="#" <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
            </div>
            <div class="col-md-6 ftco-animate">
            	<img src="web/images/burgers777.png" class="img-fluid" alt="">
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(web/images/fuego.gif);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Mil sabores en un solo lugar.</h1>
              <p class="mb-4 mb-md-5"> Donde la comida habla con el paladar. Una sabrosa hamburguesa es lo que te mereces.</p>
              <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> </p>
            </div>

          </div>
        </div>
      </div>
    </section>


@endsection