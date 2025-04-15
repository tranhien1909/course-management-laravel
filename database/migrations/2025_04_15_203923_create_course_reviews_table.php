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
        Schema::create('course_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('course_id', 20);
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned(); // ví dụ: từ 1 đến 5 sao
            $table->text('comment')->nullable();
            $table->timestamps();
        
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->unique(['course_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_reviews');
    }
};
