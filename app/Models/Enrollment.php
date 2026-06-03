<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    protected $fillable = [
        'student_id',
        'course_id',
        'teacher_id',
        'schedule_id',
        'semester',
        'enrollment_date',
        'final_grade',
        'status'
    ]; 

    // Relación: Una matrícula pertenece a un estudiante
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relación con Profesor (NUEVA)
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
