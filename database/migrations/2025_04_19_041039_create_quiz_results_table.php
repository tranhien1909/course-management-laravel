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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            
            // 1. Quan hệ với các bảng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            
            // 2. Thông điểm số chi tiết
            $table->decimal('score', 5, 2)->comment('Điểm số thực tế');
            $table->decimal('max_score', 5, 2)->comment('Điểm tối đa có thể đạt');
            $table->decimal('percentage', 5, 2)->comment('Phần trăm đạt được');
            
            // 3. Thông tin thời gian
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_spent')->comment('Thời gian làm bài (giây)');
            
            // 4. Trạng thái và dữ liệu
            $table->enum('status', [
                'in_progress', 
                'completed', 
                'graded', 
                'passed', 
                'failed'
            ])->default('in_progress');
            
            $table->json('answers')->nullable()->comment('Cấu trúc: {
                "question_id": 1,
                "selected_option": [1, 3], // Mảng cho câu hỏi multi-select
                "is_correct": true,
                "points_earned": 1.5
            }');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
