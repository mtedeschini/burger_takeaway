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
          <p> <a href="/takeaway" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
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
          <p><a href="/takeaway" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
        </div>
        <div class="col-md-6 ftco-animate">
          <img src="web/images/burgers777.png" class="img-fluid" alt="">
        </div>

      </div>
    </div>
  </div>

  <div class="slider-item">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text align-items-center" data-scrollax-parent="true">

        <div class="col-md-6 col-sm-12 order-md-last ftco-animate">
          <span class="subheading">Patagonia </span>
          <h1 class="mb-4">Cervezas</h1>
          <p class="mb-4 mb-md-5">Acompaña tu hamburguesa.</p>
          <p><a href="/takeaway" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Menu</a></p>
        </div>

        <div class="col-md-6 ftco-animate">
          <img src="web/images/beer.PNG" class="img-fluid" alt="">
        </div>

      </div>
    </div>
  </div>


</section>


@endsection