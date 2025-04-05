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
        Schema::create('classes', function (Blueprint $table) {
            $table->string('id', 20)->primary(); // Mã lớp học do admin nhập
            $table->string('course_id', 20); // Khóa học liên kết
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->bigInteger('number_of_student');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->text('schedule');
            $table->string('room', 50)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Trạng thái
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
