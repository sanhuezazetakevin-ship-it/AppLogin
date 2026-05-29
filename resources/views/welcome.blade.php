<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    background-image:url('{{ asset('img/senatiimagen.png') }}');
    <style>
        :root{
            --charcoal:#1F2D33;
            --coyote:#7A6C5D;
            --silk:#DDC9B4;
            --khaki:#BCAC9B;
            --old-rose:#C17C74;
        }

        *{
            scroll-behavior:smooth;
        }

        body{
            font-family:'Inter',sans-serif;
            background-color:var(--charcoal);
            color:white;
            overflow-x:hidden;
            position:relative;
        }

        /* Fondo institucional */
        body::before{
            content:"";
            position:fixed;
            inset:0;
            background-image:url('/img/senatiimagen.jpg');
            background-size:cover;
            background-position:center;
            opacity:.045;
            z-index:-2;
        }

        /* Overlay profesional */
        body::after{
            content:"";
            position:fixed;
            inset:0;
            background:
                linear-gradient(
                    to bottom,
                    rgba(31,45,51,.94),
                    rgba(31,45,51,.98)
                );
            z-index:-1;
        }

        .glass{
            background:rgba(255,255,255,.03);
            border:1px solid rgba(255,255,255,.06);
        }

        .soft-border{
            border-color:rgba(255,255,255,.08);
        }

        .primary-btn{
            background:var(--silk);
            color:var(--charcoal);
            transition:.25s ease;
        }

        .primary-btn:hover{
            background:white;
            transform:translateY(-1px);
        }

        .secondary-btn{
            background:rgba(255,255,255,.04);
            border:1px solid rgba(255,255,255,.08);
            transition:.25s ease;
        }

        .secondary-btn:hover{
            background:rgba(255,255,255,.07);
        }

        .feature-card{
            background:rgba(255,255,255,.025);
            border:1px solid rgba(255,255,255,.06);
            transition:.3s ease;
        }

        .feature-card:hover{
            border-color:rgba(221,201,180,.16);
            transform:translateY(-2px);
        }

        .muted{
            color:#A89B8F;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="w-full border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <a href="#" class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl glass flex items-center justify-center">
                    <span class="font-bold text-sm tracking-widest text-[#DDC9B4]">
                        S
                    </span>
                </div>

                <div>
                    <h1 class="text-sm font-semibold tracking-wide text-white">
                        {{ config('app.name', 'Laravel') }}
                    </h1>

                    <p class="text-[11px] uppercase tracking-[0.25em] muted mt-1">
                        Plataforma Académica
                    </p>
                </div>
            </a>

            @if (Route::has('login'))
                <nav class="flex items-center gap-3">

                    @auth

                        <a href="{{ url('/dashboard') }}"
                           class="primary-btn px-5 py-2.5 rounded-xl text-sm font-semibold shadow-lg shadow-black/20">
                            Panel de Control
                        </a>

                    @else

                        <a href="{{ route('login') }}"
                           class="text-sm text-[#BCAC9B] hover:text-white transition">
                            Iniciar sesión
                        </a>

                        @if (Route::has('register'))

                            <a href="{{ route('register') }}"
                               class="secondary-btn px-5 py-2.5 rounded-xl text-sm font-medium text-white">
                                Registrarse
                            </a>

                        @endif

                    @endauth

                </nav>
            @endif

        </div>
    </header>

    <!-- HERO -->
    <main class="flex-1 flex items-center">

        <section class="w-full">
            <div class="max-w-7xl mx-auto px-6 py-24">

                <div class="max-w-4xl">

                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass mb-8">

                        <div class="w-2 h-2 rounded-full bg-[#C17C74]"></div>

                        <span class="text-xs font-medium tracking-wide text-[#C17C74]">
                            Plataforma institucional activa
                        </span>

                    </div>

                    <h2 class="text-5xl md:text-6xl font-extrabold leading-tight tracking-tight max-w-4xl">

                        Formación profesional
                        <span class="text-[#DDC9B4]">
                            moderna, accesible y centralizada
                        </span>

                    </h2>

                    <p class="mt-8 text-lg leading-relaxed text-[#BCAC9B] max-w-2xl">

                        Accede a tus cursos, materiales académicos,
                        seguimiento educativo y herramientas institucionales
                        desde una única plataforma segura.

                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mt-10">

                        @if (Route::has('login'))

                            @auth

                                <a href="{{ url('/dashboard') }}"
                                   class="primary-btn px-7 py-4 rounded-2xl font-semibold text-sm text-center shadow-2xl shadow-black/30">
                                    Acceder al sistema
                                </a>

                            @else

                                <a href="{{ route('login') }}"
                                   class="primary-btn px-7 py-4 rounded-2xl font-semibold text-sm text-center shadow-2xl shadow-black/30">
                                    Ingresar a la plataforma
                                </a>

                            @endauth

                        @endif

                        <a href="#servicios"
                           class="secondary-btn px-7 py-4 rounded-2xl font-medium text-sm text-center">
                            Más información
                        </a>

                    </div>

                </div>

                <!-- FEATURES -->
                <div id="servicios"
                     class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-24">

                    <div class="feature-card rounded-3xl p-8">

                        <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mb-6 text-lg">
                            🔐
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-3">
                            Acceso Seguro
                        </h3>

                        <p class="text-sm leading-relaxed muted">
                            Protección institucional con autenticación moderna
                            y control seguro de acceso académico.
                        </p>

                    </div>

                    <div class="feature-card rounded-3xl p-8">

                        <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mb-6 text-lg">
                            📚
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-3">
                            Recursos Académicos
                        </h3>

                        <p class="text-sm leading-relaxed muted">
                            Materiales, contenidos digitales y herramientas
                            educativas centralizadas.
                        </p>

                    </div>

                    <div class="feature-card rounded-3xl p-8">

                        <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center mb-6 text-lg">
                            📈
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-3">
                            Seguimiento Integral
                        </h3>

                        <p class="text-sm leading-relaxed muted">
                            Visualiza calificaciones, asistencia y progreso
                            académico en tiempo real.
                        </p>

                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-white/5">

        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-xs muted">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}.
                Todos los derechos reservados.
            </p>

            <div class="flex items-center gap-4 text-xs muted">

                <span>
                    Infraestructura Virtual
                </span>

                <span class="text-white/10">
                    |
                </span>

                <span>
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                </span>

            </div>

        </div>

    </footer>

</body>
</html>