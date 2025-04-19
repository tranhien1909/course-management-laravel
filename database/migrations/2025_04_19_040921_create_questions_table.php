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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('question_text');
            $table->enum('question_type', [
                'multiple_choice', 
                'true_false', 
                'short_answer',
                'essay'
            ]);
            $table->decimal('points', 5, 2)->default(1.00);
            $table->integer('order')->default(0)->comment('Thứ tự hiển thị');
            $table->text('explanation')->nullable()->comment('Giải thích đáp án');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
