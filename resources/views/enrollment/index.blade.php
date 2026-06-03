<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Matrículas</title>
    
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
    <h2>Panel de Matrículas</h2>
    <div class="header-actions">
        <form action="{{ route('enrollments.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Buscar por curso..." 
                    value="{{ request('search') }}" 
                    class="search-input"
                    required
                >
            </div>
            <button type="submit" class="search-submit-btn">Buscar</button>
            @if(request('search'))
                <a href="{{ route('enrollments.index') }}" class="btn btn-primary" style="margin-left: 5px; text-decoration: none;">Limpiar</a>
            @endif
        </form>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-book-medical"></i> Registrar Matrícula
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
                            <th>ID Matrícula</th>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Profesor</th>
                            <th>Semestre</th>
                            <th>F. Matrícula</th>
                            <th>Nota Final</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                            <tr>
                                <td><span class="id-badge">#{{ $enrollment->id }}</span></td>
                                
                                {{-- Celda del Estudiante: ID + Nombre --}}
                                <td>
                                    @if($enrollment->student)
                                        <span style="color: #a0aec0; font-size: 0.85rem; font-family: monospace; margin-right: 4px;">
                                            [{{ $enrollment->student->id }}]
                                        </span>
                                        <strong>{{ $enrollment->student->first_name}} {{ $enrollment->student->last_name}}</strong>
                                    @else
                                        <span class="text-muted">No asignado</span>
                                    @endif
                                </td>
                                
                                {{-- Celda de Curso --}}
                                <td>
                                    @if($enrollment->course)
                                    [{{ $enrollment->course->id }}] <strong>{{ $enrollment->course->name }} ({{$enrollment->course->code}})</strong> {{-- O ->nombre si está en español --}}
                                        @else
                                    <span class="text-muted">#{{ $enrollment->course_id }}</span>
                                        @endif
                                </td>

                                {{-- Celda de Profesor --}}
                                <td>
                                    @if($enrollment->teacher)
                                        [{{ $enrollment->teacher->id }}]<strong>  {{ $enrollment->teacher->first_name}} {{ $enrollment->teacher->last_name}}</strong>{{-- O ->nombre si está en español --}}
                                    @else
                                    
                                        <span class="text-muted">#{{ $enrollment->teacher_id }}</span>
                                    @endif
                                </td>
                                
                                <td class="font-mono"><strong>{{ $enrollment->semester }}</strong></td>
                                
                                <td class="text-muted">
                                    {{ $enrollment->enrollment_date ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') : '-' }}
                                </td>
                                
                                <td>
                                    {{ !is_null($enrollment->final_grade) ? number_format($enrollment->final_grade, 2) : '-' }}
                                </td>
                                
                                <td>
                                    <span class="status-badge status-{{ $enrollment->status }}">
                                        {{ ucfirst($enrollment->status) }}
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar esta matrícula?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center empty-cell">No hay matrículas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>