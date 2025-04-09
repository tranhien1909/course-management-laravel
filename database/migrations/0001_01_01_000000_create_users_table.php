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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 20)->nullable()->unique(); // Mã học viên 
            $table->string('avatar')->nullable()->default('https://img.myloview.com/stickers/default-avatar-profile-icon-vector-social-media-user-image-700-205124837.jpg');
            $table->string('fullname', 100)->default('user');
            $table->date('birthday')->nullable();
            $table->string('email')->unique(); // Đảm bảo email không trùng lặp
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['Nam', 'Nữ']); // ENUM
            $table->rememberToken();
            $table->enum('role', ['admin', 'teacher', 'student'])->default('student'); // ENUM
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->timestamps(); // Tạo created_at và updated_at tự động
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
