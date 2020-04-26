<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Joinery Scene App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <!-- Styles -->
        <style>
            html, body {
                /* background-color: #fff; */
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url("/images/main-background.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                position: absolute;
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                display: none;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .flag {
                position: absolute;
                top: 25%;
                left: 0px;
                height: 50%;
                width: 100vw;
                background-color: white;
                opacity: 0.6;                
            }
            .button {
                margin-left: auto;
                margin-right: auto;
                text-decoration: none;
                background-color: gray;
                color: white;
                width: 120px;
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: all 0.6s ease;
            }
            .button:hover {
                background-color: #565c61;     
            }
            a {
                text-decoration: none;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
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
                <div class="title m-b-md">
                    Joinery Scene App                    
                </div>
                <div>
                    <a href="{{ route('login') }}">
                        <div class="button">
                            Login
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
