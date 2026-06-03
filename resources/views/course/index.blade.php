<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cursos</title>
    
    @vite(['resources/css/students.css'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="container-full">
<div class="btn-exit">
    <a href="{{ route('home') }}" class="btn btn-primary">
        Volver
    </a>
</div>

<div class="table-header">
    <h2>Panel de Cursos</h2>
    <div class="header-actions">
        <form action="{{ route('courses.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por nombre o código..." 
                    value="{{ request('search') }}" 
                    class="search-input"
                    required
                >
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            
            @if(request('search'))
                <a href="{{ route('courses.index') }}" class="btn btn-primary" style="margin-left: 5px; text-decoration: none;">Limpiar</a>
            @endif
        </form>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-book-medical"></i> Registrar Curso
        </a>
    </div>
</div>

</div>

    <div class="container-full">
        
        <div class="table-card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Curso</th>
                            <th>Código</th>
                            <th>Créditos</th>
                            <th>Descripción</th>
                            <th>F. Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td><span class="id-badge">#{{ $course->id }}</span></td>
                                
                                <td class="user-name">{{ $course->name }}</td>
                                
                                <td class="font-mono"><strong>{{ $course->code }}</strong></td>
                                
                                <td>{{ $course->credits }}</td>
                                
                                <td class="text-muted" title="{{ $course->description }}">
                                    {{ $course->description ?? '-' }}
                                </td>
                                
                                <td class="text-muted">{{ $course->created_at ? $course->created_at->format('d/m/Y H:i') : '-' }}</td>
                                
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('courses.edit', $course->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar este curso?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center empty-cell">No hay cursos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>