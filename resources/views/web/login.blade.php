@extends('web.plantilla-sitio')
@section('contenido')


    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
          <div class="col-md-12 ftco-animate">
            <form action="#" class="contact-form">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                  
            	<div class="row">
            		<div class="col-12 col-md-8">
	                <div class="form-group">
	                  <input type="text" class="form-control" name="txtUsuario" placeholder="Usuario">
	                </div>
                  </div>

                  <div class="col-12 col-md-8">
	                  <div class="form-group">
	                    <input type="text" name="txtClave" class="form-control" placeholder="Clave">
	                  </div>
                  </div>
                  <div class="col-12 col-md-8">
	                  ¿No tenés cuenta? Registrate
                  </div>
                  <div class="col-12 col-md-8">
	                  <button type="submit">ENTRAR</button>
                  </div>




            </form>
          </div>
        </div>
      </div>
    </section>

    <div id="map"></div>
    @endsection
