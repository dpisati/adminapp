<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
                <!-- Swiper Portfolio -->
                <link rel="stylesheet" href="path/to/swiper.min.css">
                <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <!-- Styles -->
        <link href="./node_modules/swiper/css/swiper.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
        <link href="/css/main.css" rel="stylesheet">

         <!-- Scripts -->
        <script src="/js/app.js" defer></script>
        

    </head>
    <body>

<header class="main-header">
    <div class="logo">
        <!-- <a href="#">Joinery Scene</a> -->
        <img src="./images/main-pictures/jslogo.jpg" alt="LOGO" class="js-logo">
        {{-- <img src="./images/main-pictures/js-logo-min.png" alt="LOGO" class="js-logo"> --}}
    </div>


    <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="menu-icon__line"></span>
        </label>

        <ul class="nav-links">
            <li class="nav-link"><a href="#">Cabinets</a></li>
            <li class="nav-link"><a href="#">Portfolio</a></li>
            <li class="nav-link"><a href="#">Contact</a></li>
            <!-- <li class="nav-link"><a href="#">Login</a></li> -->
            @if (Route::has('login'))
                @auth
                    <li class="nav-link"><a href="{{ url('/home') }}">Home</a></li>
                @else
                    <li class="nav-link last"><a href="{{ route('login') }}" class="last">Login</a></li>
                <!-- @if (Route::has('register'))
                    <li class="nav-link"><a href="{{ route('register') }}">Register</a></li>
                @endif -->
                @endauth
            @endif            
        </ul>
</header>

<div class="container">
     <div class="landing_picture"></div>
    
    <div class="range">
        <div class="range-left">
            <h3>Kitchen</h3>
            <button>View more</button>
            <div class="range-kitchen"></div>
        </div>
        <div class="range-right">
            <div class="right-top">
                <h3>Laundry</h3>
                <button>View more</button>
                <div class="range-laundry"></div>
            </div>
            <div class="right-bottom">
                <h3>Bathroom</h3>
                <button>View more</button>
                <div class="range-bathroom"></div>
            </div>
        </div>
    </div>

     <!-- Swiper -->
<div class="swiper">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="/images/portfolio/1.jpg" alt="1"></div>
      <div class="swiper-slide"><img src="/images/portfolio/6.jpg" alt="2"></div>
      <div class="swiper-slide"><img src="/images/portfolio/bishop1.jpg" alt="3"></div>
      <div class="swiper-slide"><img src="/images/portfolio/melrose1.jpg" alt="5"></div>
      <div class="swiper-slide"><img src="/images/portfolio/tutton1.jpg" alt="6"></div>
      <div class="swiper-slide"><img src="/images/portfolio/madras1.jpg" alt="7"></div>
      <div class="swiper-slide"><img src="/images/portfolio/10.jpg" alt="8"></div>    
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
  </div>
</div>


</div>



    <!-- <div class="container">
        <nav class="">
            <a class="" href="#">Joinery Sceme App</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ml-5">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cabinets <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Materials</a>
                        </li>
                    </ul>                    
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">Login</a>
                            @if (Route::has('register'))
                                <a class="ml-3" href="{{ route('register') }}">Register</a>
                            @endif
                            @endauth
                        </div>
                        @endif
                </div>
            </nav>
        </div> -->


<!-- 
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="flag"></div>

            <div class="content">

                <div>
                    <a href="{{ route('login') }}">
                        <div class="button">
                            Login
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @auth
<script>
  window.user = @json(auth()->user())
</script>
@endauth -->
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows : false,
        },
        loop: true,
    });
</script>

</body>
</html>
