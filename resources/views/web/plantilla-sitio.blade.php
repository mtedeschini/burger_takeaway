<!DOCTYPE html>
<html lang="es">

<head>
  <title>Burgers SRL</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('web/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/animate.css') }}">

  <link rel="stylesheet" href="{{ asset('web/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{ asset('web/css/aos.css') }}">

  <link rel="stylesheet" href="{{ asset('web/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{ asset('web/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/jquery.timepicker.css') }}">


  <link rel="stylesheet" href="{{asset('web/css/fontawesome/css/solid.css')}}">
  <link rel="stylesheet" href="{{asset('web/css/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('web/css/fontawesome/css/fontawesome.min.css')}}">


  <link rel="stylesheet" href="{{ asset('web/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
  @yield('scripts')
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="/"><span class="fas fa-hamburger mr-1"></span>BURGER<br><small>Delicious</small></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>
      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="/" class="nav-link"><i class="fas fa-home"></i>  Inicio</a></li>
          <li class="nav-item"><a href="/nosotros" class="nav-link"><i class="fas fa-info-circle"></i>  Nosotros</a></li>
          <li class="nav-item"><a href="/takeaway" class="nav-link"><i class="fas fa-shopping-bag"></i>  Takeaway</a></li>
          <li class="nav-item"><a href="/promociones" class="nav-link"><i class="fas fa-percent"></i>  Promociones</a></li>
          <li class="nav-item"><a href="/sponsors" class="nav-link"><i class="fas fa-hands-helping"></i>  Sponsors</a></li>
          <li class="nav-item"><a href="/contacto" class="nav-link"><i class="fas fa-envelope"></i>  Contacto</a></li>

          @if(Session::get('cliente_id') != "")
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true"><i class="fas fa-user-circle"></i>   Mi cuenta</a>
                  <ul class="dropdown-menu" aria-labelledby="dropdown01" data-bs-popper="none">
                    <li><a class="dropdown-item" href="/mi-cuenta"><i class="fas fa-user"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-in-alt"></i> Cerrar sesión</a></li>
                </ul>
              </li>
              @if(isset($productosCarrito))
              <li class="nav-item" >
                  <a href="/carrito" class="nav-link"  >
                  <div class="cart-num">
                    <i class="fas fa-shopping-cart"></i> 
                    {{$productosCarrito}}
                    </div>
                  </a>
              </li>
              @else
              <li class="nav-item"><a href="/carrito" class="nav-link"><i class="fas fa-shopping-cart"></i></a></li>
              @endif
          @else
              <li class="nav-item"><a href="/login" class="nav-link">  <i class="fas fa-user-alt-slash"></i> Ingresar</a></li>
          @endif
      
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  @yield('contenido')

  <footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class='container' >

 <div class="row" id='scrsls'>
      @foreach ($aSucursales as $sucursal)
        <div class="col-lg-3 col-md-6 mb-5 mb-md-5">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2" style="color:orange;">{{$sucursal->nombre}}</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text"> {{$sucursal->direccion}}</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text"> {{$sucursal->telefono}}</span></a></li>
              </ul>
            </div>
          </div>
        </div>

      @endforeach
  </div>
        <div class="col-md-12 text-center">



        <div class="row">
        <div class="col-md-12 text-center">
          <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> - Burgers SRL
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="{{ asset('web/js/jquery.min.js') }}"></script>
  <script src="{{ asset('web/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('web/js/popper.min.js') }}"></script>
  <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('web/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('web/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('web/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('web/js/aos.js') }}"></script>
  <script src="{{ asset('web/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('web/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('web/js/jquery.timepicker.min.js') }}"></script>
  <script src="{{ asset('web/js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('web/js/google-map.js') }}"></script>
  <script src="{{ asset('web/js/main.js') }}"></script>

</body>

</html>
