<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Matrícula</title>
    @vite(['resources/css/students-create.css'])
</head>
<body>

    <div class="form-container">
        
        <div class="form-header">
            <a href="{{ route('enrollments.index') }}" class="btn-back">← Volver</a>
            <h2>Editar información de la Matrícula</h2>
        </div>

        <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="form-group">
                <label>Estudiante</label>
                <select name="student_id" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->first_name }} {{ $student->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Curso</label>
                <select name="course_id" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->name }} ({{ $course->code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Profesor</label>
                <select name="teacher_id" required>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $enrollment->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->first_name }} {{ $teacher->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Horario</label>
                <select name="schedule_id" required>
                    @foreach($schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $enrollment->schedule_id == $schedule->id ? 'selected' : '' }}>
                            {{ $schedule->detail ?? 'Horario #'.$schedule->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Semestre</label>
                <input type="text" name="semester" value="{{ $enrollment->semester }}" required>
            </div>

            <div class="form-group">
                <label>Fecha de Matrícula</label>
                <input type="date" name="enrollment_date" value="{{ $enrollment->enrollment_date }}" required>
            </div>

            <div class="form-group">
                <label>Nota Final (Opcional)</label>
                <input type="number" name="final_grade" step="0.01" min="0" max="20" value="{{ $enrollment->final_grade }}" placeholder="Ej. 15.50">
            </div>

            <div class="form-group">
                <label>Estado</label>
                <select name="status" required>
                    <option value="ongoing" {{ $enrollment->status == 'ongoing' ? 'selected' : '' }}>En curso (Ongoing)</option>
                    <option value="passed" {{ $enrollment->status == 'passed' ? 'selected' : '' }}>Aprobado (Passed)</option>
                    <option value="failed" {{ $enrollment->status == 'failed' ? 'selected' : '' }}>Desaprobado (Failed)</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Actualizar Cambios</button>
        </form>

    </div>

</body>
</html>