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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('course_interested')->nullable()->comment('Khóa học quan tâm');
            $table->text('message')->nullable();
            $table->string('status')->default('pending')->comment('pending/contacted/completed');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null')->comment('Nhân viên phụ trách');
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
