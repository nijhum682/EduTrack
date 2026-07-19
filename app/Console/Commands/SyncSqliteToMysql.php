<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SyncSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:sync-sqlite-to-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all data from SQLite database to MySQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database sync from SQLite to MySQL...');

        // Override sqlite database config to point to the actual sqlite file path
        config(['database.connections.sqlite.database' => database_path('database.sqlite')]);

        $tables = [
            'users',
            'courses',
            'enrollments',
            'tasks',
            'task_questions',
            'task_submissions',
            'lectures',
            'lecture_comments',
            'lecture_likes',
            'scheduled_classes',
            'scheduled_class_comments',
            'course_notes',
            'course_note_comments',
            'course_note_likes',
            'course_questions',
            'course_answers',
            'activities',
        ];

        // Disable foreign key checks for truncation and insertion
        Schema::disableForeignKeyConstraints();

        foreach ($tables as $table) {
            // Check if table exists in sqlite
            if (!Schema::connection('sqlite')->hasTable($table)) {
                $this->warn("Table {$table} does not exist in SQLite database. Skipping...");
                continue;
            }

            // Fetch all records from SQLite
            $records = DB::connection('sqlite')->table($table)->get();

            // Clear target MySQL table
            DB::connection('mysql')->table($table)->truncate();

            // Convert to array format
            $insertData = [];
            foreach ($records as $record) {
                $insertData[] = (array)$record;
            }

            // Insert into MySQL
            if (!empty($insertData)) {
                $chunks = array_chunk($insertData, 100);
                foreach ($chunks as $chunk) {
                    DB::connection('mysql')->table($table)->insert($chunk);
                }
            }

            $count = count($insertData);
            $this->info("Successfully copied {$count} rows for table: {$table}");
        }

        Schema::enableForeignKeyConstraints();

        $this->info('Database sync completed successfully!');
    }
}
