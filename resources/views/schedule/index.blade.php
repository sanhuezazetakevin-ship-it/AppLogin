<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Horarios</title>
    
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
    <h2>Panel de Horarios</h2>
    <div class="header-actions">
        <form action="{{ route('schedules.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por curso o aula..." 
                    value="{{ request('search') }}" 
                    class="search-input"
                    required
                >
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            
            @if(request('search'))
                <a href="{{ route('schedules.index') }}" class="btn btn-primary" style="margin-left: 5px; text-decoration: none;">Limpiar</a>
            @endif
        </form>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-calendar-plus"></i> Registrar Horario
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
                            <th>Curso</th>
                            <th>Día de la Semana</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Aula</th>
                            <th>F. Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td><span class="id-badge">#{{ $schedule->id }}</span></td>
                                
                                <td class="user-name">{{ $schedule->course->name ?? 'Curso no asignado' }}</td>
                                
                                <td>{{ $schedule->day_of_week }}</td>
                                
                                <td>{{ $schedule->start_time }}</td>
                                
                                <td>{{ $schedule->end_time }}</td>
                                
                                <td class="font-mono">{{ $schedule->number_of_classroom }}</td>
                                
                                <td class="text-muted">{{ $schedule->created_at ? $schedule->created_at->format('d/m/Y H:i') : '-' }}</td>
                                
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar este horario?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center empty-cell">No hay horarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>