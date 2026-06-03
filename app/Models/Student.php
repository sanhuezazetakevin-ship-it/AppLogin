<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    protected $fillable = [
        'first_name',
        'last_name',
        'dni',
        'date_of_birth',
        'email',
        'phone_number',
        'address'
    ];
}
