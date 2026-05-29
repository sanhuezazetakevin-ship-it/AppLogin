@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Bienvenida --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-primary text-white rounded-4 p-5 shadow">
                <h1 class="fw-bold mb-2">
                    Bienvenido 👋
                </h1>

                <p class="mb-0 fs-5">
                    Has iniciado sesión correctamente en el sistema.
                </p>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('status') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>
        </div>
    @endif

    {{-- Tarjetas --}}
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-person-circle display-4 text-primary"></i>
                    </div>

                    <h5 class="fw-bold">
                        Perfil
                    </h5>

                    <p class="text-muted">
                        Administra tu información personal.
                    </p>

                    <a href="#" class="btn btn-primary rounded-pill px-4">
                        Ver perfil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-gear-fill display-4 text-success"></i>
                    </div>

                    <h5 class="fw-bold">
                        Configuración
                    </h5>

                    <p class="text-muted">
                        Personaliza tu experiencia dentro del sistema.
                    </p>

                    <a href="#" class="btn btn-success rounded-pill px-4">
                        Configurar
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-bar-chart-fill display-4 text-danger"></i>
                    </div>

                    <h5 class="fw-bold">
                        Estadísticas
                    </h5>

                    <p class="text-muted">
                        Revisa el rendimiento y actividad reciente.
                    </p>

                    <a href="#" class="btn btn-danger rounded-pill px-4">
                        Ver datos
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection