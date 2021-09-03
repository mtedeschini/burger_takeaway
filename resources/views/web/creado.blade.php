@extends('web.plantilla-sitio')
@section('contenido')


<section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9 justify-content-center">
        <div class="col-md-12 ftco-animate">
          <form action="" method="post" class="contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="row justify-content-center text-center" >
              <div class="col-12 col-md-8 mx-3">
                <h1>¡Usuario creado satisfactoriamente!</h1>
                <h5 >Para comenzar a hacer pedidos<a href="/login"> logueate con tu correo y contraseña </a> .</h5>
              </div>
            </div>

        </div>
      </div>
    </div>
</section>

    <div id="map"></div>
    @endsection
