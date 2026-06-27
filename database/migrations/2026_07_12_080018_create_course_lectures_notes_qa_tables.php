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
        // 1. Lectures Table (Uploaded by Teachers)
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('lecture_number');
            $table->string('name');
            $table->text('details')->nullable();
            $table->timestamps();
        });

        // 2. Course Notes Table (Shared by Students)
        Schema::create('course_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('file_path');
            $table->timestamps();
        });

        // 3. Course Questions Table (Q&A asked by Students)
        Schema::create('course_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('question_text');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        // 4. Course Answers Table (Q&A replied by Teachers/others)
        Schema::create('course_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_question_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('answer_text');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_answers');
        Schema::dropIfExists('course_questions');
        Schema::dropIfExists('course_notes');
        Schema::dropIfExists('lectures');
    }
};

