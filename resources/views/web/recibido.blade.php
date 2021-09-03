@extends('web.plantilla-sitio')
@section('contenido')


<section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9 justify-content-center">
        <div class="col-md-12 ftco-animate">
          <form action="" method="post" class="contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="row justify-content-center" >
              <div class="col-12 col-md-8 mx-3">
                <h1>¡Recibimos tu pedido!</h1>
                <h4>En instantes vas a poder retirarlo por la sucursal seleccionada.</h4>
              </div>
            </div>

        </div>
      </div>
    </div>
</section>

    <div id="map"></div>
    @endsection
