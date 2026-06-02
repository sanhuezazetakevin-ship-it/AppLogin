<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Matrícula</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('enrollments.index') }}" class="btn-back">← Volver</a>
            <h2>Nueva Matrícula</h2>
        </div>

        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf 
            
            <div class="form-group">
                <label>Estudiante</label>
                <select name="student_id" required>
                    <option value="" disabled selected>Seleccione un estudiante...</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name   }} {{ $student->last_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Curso</label>
                <select name="course_id" required>
                    <option value="" disabled selected>Seleccione un curso...</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }} ({{ $course->code }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Profesor</label>
                <select name="teacher_id" required>
                    <option value="" disabled selected>Seleccione un profesor...</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name   }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Horario</label>
                <select name="schedule_id" required>
                    <option value="" disabled selected>Seleccione un horario...</option>
                    @foreach($schedules as $schedule)
                        {{-- Modifica '$schedule->detail' por el campo real que describa tu horario (ej. 'name', 'day_time', etc.) --}}
                        <option value="{{ $schedule->id }}">{{ $schedule->detail ?? 'Horario #'.$schedule->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Semestre</label>
                <input type="text" name="semester" placeholder="Ej. 2026-I" required>
            </div>

            <div class="form-group">
                <label>Fecha de Matrícula</label>
                <input type="date" name="enrollment_date" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label>Nota Final (Opcional)</label>
                <input type="number" name="final_grade" step="0.01" min="0" max="20" placeholder="Ej. 15.50">
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="status" required>
                    <option value="ongoing" selected>En curso (Ongoing)</option>
                    <option value="passed">Aprobado (Passed)</option>
                    <option value="failed">Desaprobado (Failed)</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Guardar Matrícula</button>
        </form>

    </div>

</body>
</html>