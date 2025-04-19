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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('course_id', 20); // Khớp với kiểu dữ liệu của courses.id
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->string('title');
            $table->text('instructions')->nullable();
            $table->integer('time_limit')->default(30)->comment('Phút');
            $table->integer('passing_score')->default(70)->comment('Điểm % để đạt');
            $table->integer('max_attempts')->default(1);
            $table->boolean('is_shuffle_questions')->default(false);
            $table->timestamp('available_from')->nullable();
            $table->timestamp('available_to')->nullable();
            $table->timestamps();
        
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
