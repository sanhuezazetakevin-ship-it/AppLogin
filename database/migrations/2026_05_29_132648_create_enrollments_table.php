<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('course')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teacher')->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained('schedule')->onDelete('cascade');
            $table->string('semester');
            $table->date('enrollment_date');
            $table->float('final_grade')->nullable();
            $table->enum('status', ['passed', 'failed', 'ongoing'])->default('ongoing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
