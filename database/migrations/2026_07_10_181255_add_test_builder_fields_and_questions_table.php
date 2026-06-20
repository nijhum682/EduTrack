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
        // 1. Add fields to tasks table
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('is_test')->default(false);
            $table->integer('duration_minutes')->default(60);
        });

        // 2. Create task_questions table
        Schema::create('task_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->text('question_text');
            $table->string('type'); // 'mcq', 'written', 'file'
            $table->text('options')->nullable(); // JSON array of options for MCQ
            $table->integer('points')->default(5);
            $table->timestamps();
        });

        // 3. Add fields to task_submissions table
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->text('answers')->nullable(); // JSON response data
            $table->string('uploaded_file')->nullable(); // khata uploaded image file path
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->dropColumn(['answers', 'uploaded_file']);
        });

        Schema::dropIfExists('task_questions');

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['is_test', 'duration_minutes']);
        });
    }
};
