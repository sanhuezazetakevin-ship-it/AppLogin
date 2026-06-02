<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Curso</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('courses.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Curso</h2>
        </div>

        <form action="" method="">
            @csrf 
            
            <div class="form-group">
                <label>Nombre del Curso</label>
                <input type="text" name="name" placeholder="Ej. Desarrollo Web Avanzado" required>
            </div>

            <div class="form-group">
                <label>Código del Curso</label>
                <input type="text" name="code" placeholder="Ej. INF-302" required>
            </div>

            <div class="form-group">
                <label>Créditos</label>
                <input type="number" name="credits" min="1" max="10" placeholder="Ej. 4" required>
            </div>

            <div class="form-group">
                <label>Descripción (Opcional)</label>
                <textarea name="description" rows="4" placeholder="Escribe una breve descripción del curso..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Guardar Curso</button>
        </form>

    </div>

</body>
</html>