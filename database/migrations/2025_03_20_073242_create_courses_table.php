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
        Schema::create('courses', function (Blueprint $table) {
            $table->string('id', 20)->primary(); // Mã khóa học do admin nhập
            $table->string('course_name', 255);
            $table->text('description')->nullable();
            $table->enum('level', ['A1', 'A2', 'B1', 'B2', 'C1', 'C2']);
            $table->decimal('price', 10, 2);
            $table->integer('lessons');
            $table->enum('status', ['Active', 'Inactive'])->default('Active'); // Trạng thái
            $table->string('image', 255)->nullable();
            $table->timestamps(); // Tạo created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
