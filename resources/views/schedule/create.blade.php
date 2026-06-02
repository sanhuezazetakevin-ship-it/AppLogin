<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Horario</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('schedules.index') }}" class="btn-back">← Volver</a>
            <h2>Nuevo Horario</h2>
        </div>

        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Curso</label>
                <select name="course_id" required>
                    <option value="">-- Seleccione un Curso --</option>
                    @foreach($courses as $course)
                         <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Día de la Semana</label>
                <select name="day_of_week" required>
                    <option value="">-- Seleccione un Día --</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miércoles">Miércoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>

            <div class="form-group">
                <label>Hora de Inicio</label>
                <input type="time" name="start_time" required>
            </div>

            <div class="form-group">
                <label>Hora de Fin</label>
                <input type="time" name="end_time" required>
            </div>

            <div class="form-group">
                <label>Número de Aula</label>
                <input type="text" name="number_classroom" placeholder="Ej. Aula 302 o Lab B" required>
            </div>

            <button type="submit" class="btn-submit">Guardar Horario</button>
        </form>

    </div>

</body>
</html>