@extends('web.plantilla-sitio')
@section('contenido')


	<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">
		<div class="slider-item" style="background-image: url(web/images/image_10.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text align-items-center" data-scrollax-parent="true">
					<div class="col-md- col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread">#MoodHamburguesa</h1>
						<p class="breadcrumbs"><span class="mr-"><a href="/">Inicio</a></span></p>
					</div>
				</div>
			</div>
		</div>
		<div class="slider-item" style="background-image: url(web/images/image_11.jpg);">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text align-items-center" data-scrollax-parent="true">
					<div class="col-md- col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread">#QuieroTodo</h1>
						<p class="breadcrumbs"><span class="mr-"><a href="/">Inicio</a></span></p>
					</div>
				</div>
			</div>
		</div>
	</section>
    


	<section class="ftco-about d-md-flex">
	<div class="container-fluid">
		<div class="col-xs-12">
		<div class="row row-eq-height">		
			<div class = "col-sm-12 col-md-6 col-lg-6">
				<div class="overlay">
					<img src="web/images/image_7.jpg" class="img-fluid" alt="">
				</div>
			</div>
			<div class = "col-sm-12 col-md-6 col-lg-6">
					<div class="one-half ftco-animate">
						<div class="heading-section ftco-animate ">
							<h2 class="mb-4">Burger SRL</h2>
						</div>
						<div>
							<p>
							   Si quiere formar parte de nuestro proyecto y de nuestro equipo de profesionales, por favor rellene este formulario para ponerse en contacto con nosotros y envíenos su currículum para que podamos incorporar su candidatura en futuros procesos de selección. 
							</p>
							<a type="button" class="btn btn-outline-light" href="#formulario">Rellene el formulario</a>
							<br>
							<br>
							<p>¡Gracias!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	</section>


    <section class="ftco-section">
	<div id="mi-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
		  <div class="carousel-item active">
			<div class="container">
			    <div class="row justify-content-center mb-5 pb-3 text-center">
					<h2 class="mt-5">>> Si entre amigos quieres compartir, nuestras hamburguesas debes pedir. <<</h2>
			  </div>
			</div>
		  </div>
		  <div class="carousel-item">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-3 text-center">
					<h2 class="mt-5">>> Cocinamos para ti las mejores hamburguesas de mundo mundial, perfectas en todo momento, sobre todo cuando no quieres cocinar. <<</h2>
			  </div>
			</div>
		  </div>
		  <div class="carousel-item">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-3 text-center">
					<h2 class="mt-5">>> Con el primer bocado ya te sentirás en el cielo, será una experiencia del otro mundo. <<</h2>
				</div>
			    </div>
			</div>
		  </div>
		</div>
		<a class="carousel-control-prev" href="#mi-carousel" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#mi-carousel" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
	</div>
    </section>



	<section class="ftco-appointment" id="formulario">
		<div class="container mt-5 py-5">
			<div class="row block-9 justify-content-around">
				<div class="col-md-6 ftco-animate">
					<h3 class="mb-3">Trabajá con Nosotros</h3>
					<small class="d-block"><i>Recuerde adjuntar su CV</i></small>
					<form action="#" method="POST" class="appointment-form" enctype="multipart/form-data">						
						  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
      
						<div class="d-md-flex">
							<div class="form-group">
								<input  type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre" required>
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido" required>
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="text" id="txtDni" name="txtDocumento" class="form-control" placeholder="DNI" required>
							</div>
						</div>  
						<div class="d-md-flex">
							<div class="form-group">
								<input  type="text" id="txtLocalidad" name="txtLocalidad" class="form-control" placeholder="Localidad" required>
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Email" required>
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="tel" id="txtTelefono" name="txtTelefono" class="form-control" placeholder="Teléfono/Whatsapp" required>
							</div>
						</div>

						<div class="d-me-flex">
							<div class="form-group">
								<label for="txtDocumento">Archivo adjunto:</label>
								<input type="file" id="archivo_cv" name="archivo_cv" class="form-control-file py-2" accept=".pdf, .doc, .docx">
								<small class="d-block">Archivos admitidos: .pdf, .doc .docx</small>
							</div>		
						</div>


				<div class="form-group">
					<input type="submit" value="Enviar" class="btn btn-primary py-3 px-4">
				</div>
				</form>
			</div>
			</div>  

			</div>
		</div>
    </section>
@endsection