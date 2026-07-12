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
        Schema::table('lectures', function (Blueprint $table) {
            $table->string('video_path')->nullable();
            $table->string('runtime')->nullable();
        });

        Schema::table('course_notes', function (Blueprint $table) {
            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_notes', function (Blueprint $table) {
            $table->dropColumn(['rating', 'comment']);
        });

        Schema::table('lectures', function (Blueprint $table) {
            $table->dropColumn(['video_path', 'runtime']);
        });
    }
};
