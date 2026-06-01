<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Profesor</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('teachers.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Profesor</h2>
        </div>

        <form action="{{ route('teachers.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" placeholder="Ej. Carlos Alejandro" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" placeholder="Ej. Mendoza Alva" required>
            </div>

            <div class="form-group">
                <label>Especialidad</label>
                <input type="text" name="specialty" placeholder="Ej. Matemática, Desarrollo de Software" required>
            </div>

            <button type="submit" class="btn-submit">Guardar Profesor</button>
        </form>

    </div>

</body>
</html>