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
        Schema::create('notification_targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->onDelete('cascade');
            $table->foreignId('user_id')->nullable(); // nếu gửi cho user cụ thể
            $table->string('class_id', 20)->nullable(); // nếu gửi cho lớp
            $table->string('course_id', 20)->nullable(); // nếu gửi cho khoá học
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_targets');
    }
};
