<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                
</head>
<body>

<header class="main-header">
    <div class="logo">
        <!-- <a href="#">Joinery Scene</a> -->
        <a href="/">
            <img src="./images/main-pictures/jslogo.jpg" alt="LOGO" class="js-logo">
        </a>
    </div>

    <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="menu-icon__line"></span>
        </label>

        <ul class="nav-links">
            <li class="nav-link"><a href="/shop">Shop</a></li>
            <li class="nav-link"><a href="/#portfolio">Portfolio</a></li>
            <li class="nav-link"><a href="/#contact">Contact</a></li>
            @if (Route::has('login'))
                @auth
                    <li class="nav-link"><a href="{{ url('/home') }}">Home</a></li>
                @else
                    <li class="nav-link last"><a href="{{ route('login') }}" class="last">Login</a></li>
                @endauth
            @endif            
        </ul>
</header>

<div id="app">
<div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
<!-- <div class="container">
    @yield('content')
</div> -->
</div>

</body>
</html>
