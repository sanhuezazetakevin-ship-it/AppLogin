<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: #000000 !important;
            overflow: hidden !important;
            font-family: 'Nunito', sans-serif;
        }

        .super-login-block {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 9999 !important;
        }

        .navbar-custom {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            background-color: rgba(16, 16, 16, 0.6) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            z-index: 10000 !important;
        }
        
        .login-bg-full {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background-image: url("{{ asset('img/imagensenati1.jpg') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            filter: brightness(0.4) !important;
            z-index: 1 !important;
        }

        .login-content {
            position: relative !important;
            z-index: 10 !important;
            width: 100% !important;
            margin-top: 60px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand navbar-dark navbar-custom py-2">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-dark border-secondary" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="super-login-block">
    <div class="login-bg-full"></div>

    <div class="container d-flex align-items-center justify-content-center login-content">
        <div class="row justify-content-center w-100">
            <div class="col-md-10 col-lg-8">
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 15px; background-color: #1e1e1e; border: 1px solid rgba(255, 255, 255, 0.05) !important;">
                    <div class="row g-0">
                        
                        <div class="col-md-5 d-none d-md-flex flex-column align-items-center justify-content-center p-4" style="background-color: #000000 !important;">
                            <div style="width: 220px; height: 220px; display: flex; align-items: center; justify-content: center; overflow: hidden; background-color: #000000 !important;">
                                <dotlottie-wc src="{{ asset('animations/gato.lottie') }}" 
                                              style="width: 100%; height: 100%; background-color: #000000 !important;" 
                                              speed="0.6" autoplay loop></dotlottie-wc>
                            </div>
                            <h5 class="text-white mt-3 fw-bold text-center">¡Bienvenido de vuelta!</h5>
                            <p class="text-muted small text-center px-2">Ingresa tus credenciales para acceder al centro de estudios.</p>
                        </div>

                        <div class="col-md-7 p-4 p-sm-5" style="background-color: rgba(30, 30, 30, 0.95);">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3 class="text-white fw-bold m-0">{{ __('Inicio de sesión') }}</h3>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label text-light small fw-semibold">{{ __('Correo Electrónico') }}</label>
                                    <input id="email" type="email" class="form-control bg-dark border-secondary text-white py-2" name="email" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label text-light small fw-semibold">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control bg-dark border-secondary text-white py-2" name="password" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 fw-semibold py-2 shadow-sm mb-4">
                                    {{ __('Iniciar sesión') }}
                                </button>
                            </form>

                            <div class="d-flex align-items-center mb-4">
                                <hr class="flex-grow-1 border-secondary m-0">
                                <span class="px-3 text-muted small text-uppercase">O también</span>
                                <hr class="flex-grow-1 border-secondary m-0">
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('auth.google') }}" class="btn w-100 d-flex align-items-center justify-content-center text-white py-1" style="background-color: #1e1e1e; border: 1px solid #2d2d2d;">
                                    <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-top: -5px; margin-bottom: -5px;">
                                        <dotlottie-wc src="{{ asset('animations/google.lottie') }}" style="width: 100%; height: 100%; transform: scale(1.1);" autoplay loop></dotlottie-wc>
                                    </div>
                                    <span class="fw-semibold small">{{ __('Continuar con Google') }}</span>
                                </a>

                                <a href="{{ route('auth.github') }}" class="btn w-100 d-flex align-items-center justify-content-center text-white py-1" style="background-color: #1e1e1e; border: 1px solid #2d2d2d;">
                                    <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-top: -5px; margin-bottom: -5px;">
                                        <dotlottie-wc src="{{ asset('animations/github.lottie') }}" style="width: 100%; height: 100%; transform: scale(0.9);" autoplay loop></dotlottie-wc>
                                    </div>
                                    <span class="fw-semibold small">{{ __('Continuar con GitHub') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.14/dist/dotlottie-wc.js" type="module"></script>
</body>
</html>