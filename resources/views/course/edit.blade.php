<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('courses.index') }}" class="btn-back">← Volver</a>
            <h2>Editar información del Curso</h2>
        </div>

        <form action="{{ route('courses.update', $course->id) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="form-group">
                <label>Nombre del Curso</label>
                <input type="text" name="name" value="{{ $course->name }}" required>
            </div>

            <div class="form-group">
                <label>Código del Curso</label>
                <input type="text" name="code" value="{{ $course->code }}" required>
            </div>

            <div class="form-group">
                <label>Créditos</label>
                <input type="number" name="credits" min="1" max="10" value="{{ $course->credits }}" required>
            </div>

            <div class="form-group">
                <label>Descripción (Opcional)</label>
                <textarea name="description" rows="4">{{ $course->description }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>
