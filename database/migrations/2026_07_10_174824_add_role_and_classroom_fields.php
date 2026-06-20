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
        // 1. Add role column to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('student'); // 'student' or 'teacher'
        });

        // 2. Add instructor_id column to courses table to link courses to teachers
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null');
        });

        // 3. Add score and feedback columns to task_submissions table
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->integer('score')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('graded_at')->nullable();
        });

        // 4. Create scheduled_classes table
        Schema::create('scheduled_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->dateTime('scheduled_at');
            $table->integer('duration_minutes')->default(60);
            $table->string('platform')->default('In-App Classroom');
            $table->string('meeting_link')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_classes');

        Schema::table('task_submissions', function (Blueprint $table) {
            $table->dropColumn(['score', 'feedback', 'graded_at']);
        });

        Schema::table('courses', function (Blueprint $table) {
            // Under SQLite, dropping foreign keys might throw error, so we can wrap or just drop columns
            if (DB::getDriverName() !== 'sqlite') {
                $table->dropForeign(['instructor_id']);
            }
            $table->dropColumn(['instructor_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role']);
        });
    }
};
