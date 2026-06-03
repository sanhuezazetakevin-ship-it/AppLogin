<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    protected $fillable = [
        'course_id',
        'day_of_week',
        'start_time',
        'end_time',
        'number_of_classroom'
    ];

    // Relación: Un horario pertenece a un Curso
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
