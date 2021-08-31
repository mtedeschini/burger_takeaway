@extends('web.plantilla-sitio')
@section('contenido')


<section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9">
        <div class="col-md-12 ftco-animate">
          <form action="#" class="contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

            <div class="row justify-content-center">
              <div class="col-8 col-md-8">
                <h2>Iniciar Sesión</h2>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control" name="txtUsuario" placeholder="Correo">
                </div>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" name="txtClave" class="form-control" placeholder="Clave">
                </div>
              </div>
              <div class="col-12 col-md-8">
                <button class="btn btn-primary" type="submit">ENTRAR</button>
              </div>
              <div class="col-12 col-md-8">
                ¿No tenés cuenta? <a href="/registro"> Registrate </a>
              </div>
          </form>
        </div>
      </div>
    </div>
</section>

<div id="map"></div>
@endsection