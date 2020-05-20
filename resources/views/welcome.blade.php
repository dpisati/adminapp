<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Swiper Portfolio -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

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
        <!-- <a href="#">Joinery Scene</a> -->
        <a href="#top">
            <img src="./images/main-pictures/js-logo-min.png" alt="LOGO" class="js-logo">
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
    <div class="landing_picture"></div>    

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
            <div class="swiper-slide"><img src="/images/portfolio/6.jpg" alt="2"></div>            
            <div class="swiper-slide"><img src="/images/portfolio/10.jpg" alt="8"></div>    
            <div class="swiper-slide"><img src="/images/portfolio/5.jpg" alt="madras"></div>
            <div class="swiper-slide"><img src="/images/portfolio/Bishop 3.jpg" alt="8"></div>    
            <div class="swiper-slide"><img src="/images/portfolio/1.jpg" alt="1"></div>
            <div class="swiper-slide"><img src="/images/portfolio/4.jpg" alt="tutton"></div>
            <div class="swiper-slide"><img src="/images/portfolio/Bishop 6.jpg" alt="8"></div>    
            </div>
        </div>
    </div>

    
    <div class="customers">
        <div class="customers-title">
            <hr>
            <h3>Premium Custumers</h3>
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
            <form action="">
                <h2>Contact Us</h2>
                <input type="text" name="name" id="name" placeholder="Name" autocomplete="none">
                <input type="email" name="email" id="email" placeholder="E-mail" autocomplete="none">
                <input type="phone" name="phone" id="phone" placeholder="Phone" autocomplete="none">
                <textarea name="message" class="contact-input" placeholder="Message..." rows="3" autocomplete="none"></textarea>
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
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script src="/js/swiper.js"></script>
</html>
