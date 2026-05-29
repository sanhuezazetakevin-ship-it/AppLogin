<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    @vite(['resources/css/create-student.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('students.index') }}" class="btn-back">← Volver</a>
            <h2>Editar Estudiante</h2>
        </div>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf 
            @method('PUT') <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" value="{{ $student->first_name }}" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" value="{{ $student->last_name }}" required>
            </div>

            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" value="{{ $student->dni }}" maxlength="8" required>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
            </div>

            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" value="{{ $student->email }}" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone_number" value="{{ $student->phone_number }}">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" value="{{ $student->address }}">
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="is_enrolled" required>
                    <option value="1" {{ $student->is_enrolled == 1 ? 'selected' : '' }}>Matriculado</option>
                    <option value="0" {{ $student->is_enrolled == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>