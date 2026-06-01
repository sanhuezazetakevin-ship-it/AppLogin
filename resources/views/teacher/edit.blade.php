<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('teachers.index') }}" class="btn-back">← Volver</a>
            <h2>--- Editar información del Profesor ---</h2>
        </div>

        <form action="{{ route('teachers.edit', $teacher->id) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" value="{{ $teacher->first_name }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $teacher->last_name }}" required>
            </div>

            <div class="form-group">
                <label>Especialidad</label>
                <input type="text" name="specialty" value="{{ $teacher->specialty }}" required>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>