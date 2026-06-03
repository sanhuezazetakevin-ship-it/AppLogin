<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Estudiante</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('students.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Estudiante</h2>
        </div>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf <div class="form-group">
                <label>Nombres</label>
                <input type="text" name="first_name" placeholder="Ej. Alejandro" required>
            </div>

            <div class="form-group">
                <label>Apellidos</label>
                <input type="text" name="last_name" placeholder="Ej. Alva" required>
            </div>

            <div class="form-group">
                <label>DNI</label>
                <input type="text" name="dni" placeholder="8 dígitos" maxlength="8" required>
            </div>

            <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="date_of_birth" required>
            </div>

            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="ejemplo@senati.pe" required>
            </div>

            <div class="form-group">
                <label>Teléfono</label>
                <input type="tel" name="phone_number" placeholder="Ej. 987654321">
            </div>

            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" placeholder="Ej. Av. Alfredo Mendiola 3520">
            </div>

            <button type="submit" class="btn-submit">Guardar Estudiante</button>
            @if ($errors->any())
                <div class="alert-danger" style="color: red; margin-bottom: 15px;">
                    <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
                    </ul>
                </div>
            @endif
        </form>

    </div>

</body>
</html>