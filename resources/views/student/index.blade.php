<!DOCTYPE html>
<html lang="es">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Completo de Estudiantes</title>
    
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
    <h2>Panel de Estudiantes</h2>
    <div class="header-actions">
    <form action="colocas el controlador" method="ni idea" class="search-form">
        <div class="search-input-wrapper">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-line-cap="round" stroke-line-join="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            
            <input 
                type="text" 
                name="dni" 
                placeholder="Buscar estudiante por DNI..." 
                maxlength="8"
                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                class="search-input"
                required
            >
        </div>
        <button type="submit" class="search-submit-btn">Buscar</button>
    </form>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Registrar Estudiante
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
                            <th>Nombre Completo</th>
                            <th>DNI</th>
                            <th>F. Nacimiento</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                            <th>F. Registro</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td><span class="id-badge">#{{ $student->id }}</span></td>
                                
                                <td class="user-name">{{ $student->first_name }} {{ $student->last_name }}</td>
                                
                                <td class="font-mono">{{ $student->dni }}</td>
                                
                                <td>{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') : '-' }}</td>
                                
                                <td class="text-muted">{{ $student->email }}</td>
                                
                                <td>{{ $student->phone_number ?? '-' }}</td>
                                
                                <td class="text-truncate-dir" title="{{ $student->address }}">{{ $student->address ?? '-' }}</td>
                                
                                <td>
                                    @if($student->is_enrolled == 1)
                                        <span class="status-badge status-active">Matriculado</span>
                                    @else
                                        <span class="status-badge status-inactive">Inactivo</span>
                                    @endif
                                </td>
                                
                                <td class="text-muted">{{ $student->created_at ? $student->created_at->format('d/m/Y H:i') : '-' }}</td>
                                
                                <td class="text-center">
                                    <div class="action-group">
                                        <a href="{{ route('students.edit', $student->id) }}" class="action-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete-btn" title="Eliminar" onclick="return confirm('¿Seguro de que deseas eliminar a este estudiante?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center empty-cell">No hay estudiantes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>