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
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('mcq_negative_marking')->default(false);
            $table->string('mcq_negative_marking_mode')->default('per_wrong');
            $table->decimal('mcq_negative_marking_value', 8, 2)->default(0.00);
            $table->integer('mcq_negative_marking_threshold_count')->default(2);
        });

        Schema::table('task_questions', function (Blueprint $table) {
            $table->string('correct_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_questions', function (Blueprint $table) {
            $table->dropColumn('correct_answer');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'mcq_negative_marking',
                'mcq_negative_marking_mode',
                'mcq_negative_marking_value',
                'mcq_negative_marking_threshold_count'
            ]);
        });
    }
};
