@extends('web.plantilla-sitio')
@section('contenido')


	<section class="home-slider owl-carousel img" style="background-image: url(web/images/bg_1.jpg);">
		<div class="slider-item" style="background-image: url(web/images/bg_3.jpg);">
		<div class="overlay"></div>
		<div class="container">
		<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
			<div class="col-md- col-sm-12 text-center ftco-animate">
				<h1 class="mb-3 mt-5 bread">#MoodHamburguesa</h1>
				<p class="breadcrumbs"><span class="mr-"><a href="index.php">Inicio</a></span></p>
			</div>
		</div>
	</section>
    


	<section class="ftco-about d-md-flex">
	<div class="container-fluid">
		<div class="col-xs-12">
		<div class="row row-eq-height">		
			<div class = "col-sm-12 col-md-6 col-lg-6">
				<div class="home-slider owl-carousel img">
					<div class="slider-item">
						<div class="overlay"></div>
						<div class="row slider-text align-items-center" data-scrollax-parent="true">
							<img src="web/images/person_5.jpg" class="img-fluid" alt="">
						</div>
					</div>
				
					<div class="slider-item">
						<div class="overlay"></div>
						<div class="row slider-text align-items-center" data-scrollax-parent="true">
							<img src="web/images/image_7.jpg" class="img-fluid" alt="">
						</div>
					</div>
				
					<div class="slider-item">
						<div class="overlay"></div>
						<div class="row slider-text align-items-center" data-scrollax-parent="true">
							<img src="web/images/image_8.jpg" class="img-fluid" alt="">
						</div>
					</div>

					<div class="slider-item">
						<div class="overlay"></div>
						<div class="row slider-text align-items-center" data-scrollax-parent="true">
							<img src="web/images/image_9.jpg" class="img-fluid" alt="">
						</div>
					</div>	

				</div>
			</div>
			<div class = "col-sm-12 col-md-6 col-lg-6">
					<div class="one-half ftco-animate">
						<div class="heading-section ftco-animate ">
							<h2 class="mb-4">Hamburguesa<span class="flaticon-pizza">Deliciosas</span>Ricas ricas</h2>
						</div>
						<div>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt quo, vitae dolore, placeat aspernatur cumque error porro nisi expedita dolorem quisquam! Illum ab quod eveniet odit ex eaque itaque dolorem.
							   <br>
							   <br>
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
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Nuestro Equipo</h2>
            <p class="flip"><span class="deg1"></span><span class="deg2"></span><span class="deg3"></span></p>
            <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident aut animi enim possimus officiis quae, laborum rerum iure neque! Officia quibusdam magnam deleniti beatae sapiente quaerat ipsam ullam dolore facere!</p>
          </div>
        </div>
        <div class="row">
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(web/images/person_7.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">Oscar Alegre</a></h3>
      					<span class="position">JEFE AYB</span>
      					<div class="text">
	        				<p>Apasionado por el servicio. Toda su experiencia puesta al servicio de las hamburguesas.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(web/images/person_8.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">Susana Oria</a></h3>
      					<span class="position">CHEF</span>
      					<div class="text">
	        				<p>Chef Cordobesa especialista en carnes.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(web/images/person_9.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">Patrick Jacobson</a></h3>
      					<span class="position">CHEF</span>
      					<div class="text">
	        				<p>Cocinero y Sommelier de profesión, lleva más de 10 años trabajando en hoteles y restaurantes.</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        	<div class="col-lg-3 d-flex mb-sm-4 ftco-animate">
        		<div class="staff">
      				<div class="img mb-4" style="background-image: url(web/images/person_10.jpg);"></div>
      				<div class="info text-center">
      					<h3><a href="teacher-single.html">Martina Perez</a></h3>
      					<span class="position">CHEF</span>
      					<div class="text">
	        				<p>Cocinero</p>
	        			</div>
      				</div>
        		</div>
        	</div>
        </div>
      </div>
    </section>
	<section class="ftco-appointment" id="formulario">
	<div class="overlay"></div>
		<div class="container-wrap">
			<div class="row no-gutters d-md-flex align-items-center">
				<div class="col-md-6 appointment ftco-animate">
					<h3 class="mb-3">Trabajá con Nosotros</h3>
					<small class="d-block"><i>Recuerde adjuntar su CV</i></small>
					<form action="#" class="appointment-form">
						<div class="d-md-flex">
							<div class="form-group">
								<input  type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="text" id="txtApellido" name="txtApellido" class="form-control" placeholder="Apellido">
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="text" id="txtDni" name="txtDni" class="form-control" placeholder="Dni">
							</div>
						</div>  
						<div class="d-me-flex">
							<div class="form-group">
								<input type="email" id="txtCorreo" name="txtCorreo" class="form-control" placeholder="Email">
							</div>
						</div>
						<div class="d-me-flex">
							<div class="form-group">
								<input type="tel" id="txtTelefono" name="txtTelefono" class="form-control" placeholder="Teléfono/Whatsapp">
							</div>
						</div>

						<div class="form-group">
							<textarea name="" id="" cols="30" rows="3" class="form-control" placeholder="Datos de Interés"></textarea>
						</div>

						<div class="d-me-flex">
							<div class="form-group">
								<label for="txtDocumento">Archivo adjunto:</label>
								<input type="file" id="archivo" name="archivo" class="form-control-file py-2" accept=".pdf, .doc, .docx">
								<small class="d-block">Archivos admitidos: .pdf, .doc .docx</small>
							</div>		
						</div>


				<div class="form-group">
					<input type="submit" value="Enviar" class="btn btn-primary py-3 px-4">
				</div>
				</form>
				</div>
				<div>
					Aca el QR 
				</div>
			</div>  

			</div>
		</div>
    </section>
@endsection