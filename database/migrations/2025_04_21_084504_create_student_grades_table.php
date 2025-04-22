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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('class_id', 20);
        
            $table->decimal('grade_1', 5, 2)->nullable(); // điểm lần 1
            $table->decimal('grade_2', 5, 2)->nullable(); // điểm lần 2
            $table->decimal('grade_3', 5, 2)->nullable(); // điểm lần 3
        
            $table->text('note')->nullable();
            $table->timestamps();
        
            $table->unique(['student_id', 'class_id']); // Mỗi học viên chỉ có 1 bản ghi/1 lớp
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};
