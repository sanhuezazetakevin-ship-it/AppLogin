<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Horario</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('schedules.index') }}" class="btn-back">← Volver</a>
            <h2>--- Editar información del Horario ---</h2>
        </div>

        <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="form-group">
                <label>Curso</label>
                <select name="course_id" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $schedule->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Día de la Semana</label>
                <select name="day_of_week" required>
                    @php 
                        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                    @endphp
                    @foreach($dias as $dia)
                        <option value="{{ $dia }}" {{ $schedule->day_of_week == $dia ? 'selected' : '' }}>
                            {{ $dia }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Hora de Inicio</label>
                <input type="time" name="start_time" value="{{ substr($schedule->start_time, 0, 5) }}" required>
            </div>

            <div class="form-group">
                <label>Hora de Fin</label>
                <input type="time" name="end_time" value="{{ substr($schedule->end_time, 0, 5) }}" required>
            </div>

            <div class="form-group">
                <label>Número de Aula</label>
                <input type="text" name="number_of_classroom" value="{{ $schedule->number_of_classroom }}" required>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>