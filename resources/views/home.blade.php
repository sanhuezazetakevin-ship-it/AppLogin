<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background-color: #0b0f19 !important; 
            color: #f8fafc !important; 
            font-family: sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .dashboard-wrapper { display: flex; width: 100vw; min-height: 100vh; }

        .sidebar {
            width: 260px;
            background-color: #111827 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem 1.5rem;
            flex-shrink: 0;
            
        }

        .main-content {
            flex-grow: 1;
            padding: 3rem;
            background-color: #0b0f19;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .user-nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-custom {
            background-color: #111827 !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            border-radius: 16px !important;
            padding: 2rem !important;
            color: white !important;
        }

        .nav-link-custom {
            color: #9ca3af !important;
            text-decoration: none !important;
            padding: 0.7rem 1rem;
            display: block;
            border-radius: 10px;
            transition: 0.2s;
        }
        .nav-link-custom:hover { background: rgba(255,255,255,0.04); color: #fff !important; }

        .marea-container {
            flex-grow: 1; 
            width: 100%;
            opacity: 0.6;
            pointer-events: none;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            margin-top: -50px; 
        }
    </style>
</head>
<body>

<div class="dashboard-wrapper">
    <aside class="sidebar">
        <h6 class="text-muted text-uppercase mb-4 px-2" style="font-size: 0.7rem; letter-spacing: 1.5px;">Navegación</h6>
        <nav>
            <a href="{{ url('/') }}" class="nav-link-custom">Inicio</a>
            <a href="{{ url('/courses') }}" class="nav-link-custom">Cursos</a>
            <a href="{{ url('/students') }}" class="nav-link-custom">Estudiantes</a>
            <a href="{{ url('/teachers') }}" class="nav-link-custom">Profesores</a>
            <a href="{{ url('/enrollments') }}" class="nav-link-custom">Matriculas</a>
            <a href="{{ url('/schedules') }}" class="nav-link-custom">Horarios</a>
        </nav>
    </aside>

    <main class="main-content">
        <!-- Barra superior de usuario -->
        <div class="user-nav">
            @auth
                <span class="text-white fw-bold">{{ Auth::user()->name }}</span>
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn btn-outline-danger btn-sm">
                   Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-4">
                <div class="card-custom text-center">
                    <div style="width: 140px; height: 140px; margin: 0 auto 1rem;">
                        <dotlottie-wc src="{{ asset('animations/robot1.lottie') }}" style="width: 100%; height: 100%;" autoplay loop></dotlottie-wc>
                    </div>
                    <h5>Panel de Gestión</h5>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card-custom" style="background: linear-gradient(135deg, #1e1b4b, #4c1d95) !important; height: 100%;">
                    <h1 class="fw-bold mb-3">
                        @auth ¡Bienvenido, {{ Auth::user()->name }}! 👋 @else ¡Bienvenido! 👋 @endauth
                    </h1>
                    <p class="text-white opacity-75">Has ingresado correctamente al sistema.</p>
                </div>
            </div>
        </div>

        <h5 class="text-white mt-5 mb-4 fw-bold">Accesos directos</h5>
        <div class="row g-4 mb-5">
            <div class="col-md-4"><div class="card-custom"><h6>Perfil</h6></div></div>
            <div class="col-md-4"><div class="card-custom"><h6>Configuración</h6></div></div>
            <div class="col-md-4"><div class="card-custom"><h6>Estadísticas</h6></div></div>
        </div>

        <div class="marea-container">
            <dotlottie-wc src="{{ asset('animations/marea.lottie') }}" style="width: 100%; height: 100%;" autoplay loop></dotlottie-wc>
        </div>
    </main>
</div>

<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.14/dist/dotlottie-wc.js" type="module"></script>
</body>
</html>