<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene App</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

         <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body>

<header class="main-header">
    <div class="logo">
        <!-- <a href="#">Joinery Scene</a> -->
        <img src="./images/main-pictures/js-logo-min.png" alt="LOGO" class="js-logo">
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
                    <li class="nav-link last"><a href="{{ route('login') }}">Login</a></li>
                <!-- @if (Route::has('register'))
                    <li class="nav-link"><a href="{{ route('register') }}">Register</a></li>
                @endif -->
                @endauth
            @endif            
        </ul>
</header>

<div class="container">
    <div class="landing_picture"></div>
    <div class="landing_picture2"></div>
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
</html>
