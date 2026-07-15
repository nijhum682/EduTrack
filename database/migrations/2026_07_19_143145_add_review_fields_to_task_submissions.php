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
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->boolean('review_requested')->default(false)->after('uploaded_file');
            $table->text('review_reason')->nullable()->after('review_requested');
            $table->string('review_status')->default('none')->after('review_reason'); // none, pending, reviewed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_submissions', function (Blueprint $table) {
            $table->dropColumn(['review_requested', 'review_reason', 'review_status']);
        });
    }
};
