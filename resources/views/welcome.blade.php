<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Swiper Portfolio -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

        <!-- Maps -->
        < <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>

        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mr+De+Haviland&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">      

         <!-- Scripts -->
        <script src="/js/app.js" defer></script>
        <script src="/js/maps.js" defer></script>
                
</head>
<body>

<header class="main-header">
    <div class="logo">
        <a href="#top">
            <!-- <img src="./images/main-pictures/js-logo-min.png" alt="LOGO" class="js-logo"> -->
            <img src="./images/main-pictures/jslogo.jpg" alt="LOGO" class="js-logo">
        </a>
    </div>

    <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="menu-icon__line"></span>
        </label>

        <ul class="nav-links">
            <li class="nav-link"><a href="/shop">Shop</a></li>
            <li class="nav-link"><a href="#portfolio">Portfolio</a></li>
            <li class="nav-link"><a href="#contact">Contact</a></li>
            
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
    <a id="top"></a>
    <!-- Mobile landing img -->
    <div class="main-gallery">
            <figure class="gallery__item gallery__item--1">
                <img src="./images/portfolio/horizontal/4a.jpg" class="gallery__img" alt="Image 1">
            </figure>
            <figure class="gallery__item gallery__item--2">
                <img src="./images/portfolio/horizontal/11c.jpg" class="gallery__img" alt="Image 2">
            </figure>
            <figure class="gallery__item gallery__item--3">
                <img src="./images/portfolio/horizontal/2e.jpg" class="gallery__img" alt="Image 3">
            </figure>
            <figure class="gallery__item gallery__item--4">
                <img src="./images/portfolio/horizontal/1a.jpg" class="gallery__img" alt="Image 4">
            </figure>
    </div>
    <!-- Desktop landing img -->
    <div class="landing_picture"></div>
    <div class="scroll-down">
        <div class="arrow arrow-first"></div>
        <div class="arrow arrow-second"></div>
    </div>

    <div class="range">
        <div class="range-left">
            <h3>Kitchen</h3>
                <a href="#portfolio">
                    <button>View more</button>
                </a>
            <div class="range-kitchen"></div>
        </div>
        <div class="range-right">
            <div class="right-top">
                <h3>Laundry</h3>
                    <a href="#portfolio">
                        <button>View more</button>
                    </a>
                <div class="range-laundry"></div>
            </div>
            <div class="right-bottom">
                <h3>Bathroom</h3>
                <a href="#portfolio">
                        <button>View more</button>
                    </a>
                <div class="range-bathroom"></div>
            </div>
        </div>
    </div>

     <!-- Swiper -->
     <div id="portfolio"></div>
    <div class="swiper">
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/1a.jpg" alt="1a"></div>     
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/1b.jpg" alt="1b"></div>    
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/1c.jpg" alt="1c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/1d.jpg" alt="1d"></div>    
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2a.jpg" alt="2a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2b.jpg" alt="2b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2c.jpg" alt="2c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2d.jpg" alt="2d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2e.jpg" alt="2e"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2f.jpg" alt="2f"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2g.jpg" alt="2g"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2h.jpg" alt="2h"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/2i.jpg" alt="2i"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/3a.jpg" alt="3a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/3b.jpg" alt="3b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/3c.jpg" alt="3c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/3d.jpg" alt="3d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/3e.jpg" alt="3e"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/4a.jpg" alt="4a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/4b.jpg" alt="4b"></div>
            <!-- <div class="swiper-slide"><img src="/images/portfolio/horizontal/4c.jpg" alt="4c"></div> -->
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/4d.jpg" alt="4d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/5a.jpg" alt="5a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/5b.jpg" alt="5b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/5c.jpg" alt="5c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/5d.jpg" alt="5d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/5e.jpg" alt="5e"></div>
            <!-- <div class="swiper-slide"><img src="/images/portfolio/horizontal/6a.jpg" alt="6a"></div> -->
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6b.jpg" alt="6b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6c.jpg" alt="6c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6d.jpg" alt="6d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6e.jpg" alt="6e"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6f.jpg" alt="6f"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/6g.jpg" alt="6g"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/7b.jpg" alt="7b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/7c.jpg" alt="7c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/7d.jpg" alt="7d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/8a.jpg" alt="8a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/8b.jpg" alt="8b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/8c.jpg" alt="8c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/9a.jpg" alt="9a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/9b.jpg" alt="9b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/10a.jpg" alt="10a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/10b.jpg" alt="10b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/10c.jpg" alt="10c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/11a.jpg" alt="11a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/11b.jpg" alt="11b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/11c.jpg" alt="11c"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/11d.jpg" alt="11d"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/12a.jpg" alt="12a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/12b.jpg" alt="12b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/13a.jpg" alt="13a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/13b.jpg" alt="13b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/14.jpg" alt="14"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/15.jpg" alt="15"></div>
            <!-- <div class="swiper-slide"><img src="/images/portfolio/horizontal/16.jpg" alt="16"></div> -->
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/17.jpg" alt="17"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/18.jpg" alt="18"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/19.jpg" alt="19"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/20a.jpg" alt="20a"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/20b.jpg" alt="20b"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/21.jpg" alt="21"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/22.jpg" alt="22"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/23.jpg" alt="23"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/24.jpg" alt="24"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/25.jpg" alt="25"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/26.jpg" alt="26"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/27.jpg" alt="27"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/28.jpg" alt="28"></div>
            <div class="swiper-slide"><img src="/images/portfolio/horizontal/29.jpg" alt="29"></div>
        </div>
            <div class="swipe">
                <span class="x-swipe-indicator">
                    <svg class="x-hand" xmlns="http://www.w3.org/2000/svg" width="44" height="39" viewBox="0 0 44 39"><path d="M27 6h10v2.826a1 1 0 0 0 1.65.759l4.464-3.826a1 1 0 0 0 0-1.518L38.651.415a1 1 0 0 0-1.651.76V4H27a1 1 0 1 0 0 2zM15 6a1 1 0 1 0 0-2H7V1.174A1 1 0 0 0 5.35.415L.885 4.241a1 1 0 0 0 0 1.518l4.463 3.826A1 1 0 0 0 7 8.825V6h8z"/><path d="M35.114 17.223L24 15V3a3 3 0 1 0-6 0v20a1 1 0 0 1-2 0v-4h-2a2 2 0 0 0-2 2v8c0 3.5 5 6.063 5 10h18l3.258-17.107a4 4 0 0 0-3.144-4.67z"/></svg>
                </span>
            </div>
        </div>
    </div>

    
    <div class="customers">
        <div class="customers-title">
            <hr>
            <h3>Premium Customers</h3>
            <hr>
        </div>
        <div class="customer-logos">
            <a href="https://www.markprosserbuilders.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/customers/prosser.png" alt="prosser"></div></a>
            <a href="https://www.silverstardevelopments.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/customers/silverstar.png" alt="silverstar"></div></a>
            <a href="https://www.couplands.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/customers/couplands.png" alt="couplands"></div></a>
            <a href="https://www.a1homes.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/customers/a1homes.png" alt="a1homes"></div></a>
            <a href="https://www.versatile.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/customers/versitile.png" alt="versitile"></div></a>
        </div>
        <div class="customers-title">
            <hr>
            <h3>Partners</h3>
            <hr>
        </div>
        <div class="customer-logos">
            <a href="https://www.primepanels.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/partners/prime.png" alt="prosser"></div></a>
            <a href="https://www.bestwood.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/partners/bestwood.png" alt="silverstar"></div></a>
            <a href="https://www.melteca.net/" target="_blank"><div class="customer-logo"><img src="/images/partners/melteca.png" alt="couplands"></div></a>
            <a href="https://www.hafele.co.nz/en/" target="_blank"><div class="customer-logo"><img src="/images/partners/hafele.png" alt="a1homes"></div></a>
            <a href="https://archant.co.nz/" target="_blank"><div class="customer-logo"><img src="/images/partners/archant.png" alt="versitile"></div></a>
        </div>


    
    </div>
    
    <div id="contact"></div>
    <div class="contact">
        <div class="form">
            <form action="/contact-form" method="POST">
            @csrf
                <h2>Contact Us</h2>
                @if(session()->has('message'))
                <div class="contact-success">
                    <strong>Success!</strong> {{ session()->get('message') }}
                </div>
                @endif
                
                <input type="text" name="name" id="name" placeholder="Name" autocomplete="none" value="{{ old('name')}}">
                    <div class="contact-feedback">{{ $errors->first('name') }}</div>
                <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="none" value="{{ old('email')}}">
                    <div class="contact-feedback">{{ $errors->first('email') }}</div>
                <input type="phone" name="phone" id="phone" placeholder="Phone" autocomplete="none" value="{{ old('phone')}}">
                    <div class="contact-feedback">{{ $errors->first('phone') }}</div>
                <textarea name="message" class="contact-input" placeholder="Message..." rows="3" autocomplete="none" value="{{ old('message')}}"></textarea>
                    <div class="contact-feedback">{{ $errors->first('message') }}</div>
                <button type="submit">Send</button>
                
            </form>
        </div>

        <div class="contact-right">
            <div class="map">
                <div id="mapid"></div>
            </div>
            <div class="address">
                <div class="address-title">
                    <h3>Joinery Scene</h3>
                </div>
                <div class="address-left">
                    <p><a href="https://goo.gl/maps/7FUATDXZsPnKWfVK6" target="_blank">5 Newtown Street, Bromley</a></p>
                    <p><a href="https://goo.gl/maps/7FUATDXZsPnKWfVK6" target="_blank">Christchurch - 8062</a></p>
                </div>
                <div class="address-right">
                    <p>03 384 3547</p>
                    <p><a href="mailto:admin@joineryscene.co.nz">admin@joineryscene.co.nz</a></p>
                </div>
            </div>
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

</body>
<!-- <script src="https://unpkg.com/swiper/js/swiper.min.js"></script> -->
<script src="https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js"></script>
<!-- <script src="/js/swiper.js"></script> -->
<script type="module">
  import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'
  var swiper = new Swiper(".swiper-container", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 20,
        stretch: 0,
        depth: 300,
        modifier: 1,
        slideShadows: false
    },
    loop: true
});
</script>
</html>
