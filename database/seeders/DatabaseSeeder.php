<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default test student if not exists
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Student',
                'username' => 'teststudent',
                'phone_number' => '+15550199',
                'role' => 'student',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        // Create default test teacher if not exists
        $teacher = User::firstOrCreate(
            ['email' => 'teacher@example.com'],
            [
                'name' => 'Test Teacher',
                'username' => 'testteacher',
                'phone_number' => '+15550188',
                'role' => 'teacher',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        // Create Nibir teacher if not exists
        User::firstOrCreate(
            ['email' => 'nibir@gmail.com'],
            [
                'name' => 'Nibir',
                'username' => 'nibir',
                'role' => 'teacher',
                'password' => \Illuminate\Support\Facades\Hash::make('Nibir49#'),
            ]
        );

        // Course 1
        $cs101 = Course::updateOrCreate(
            ['code' => 'CS101'],
            [
                'title' => 'Introduction to Computer Science',
                'description' => 'Fundamentals of computer science, programming logic, and computational thinking using Python.',
                'instructor' => 'Rafsan Riasat',
                'instructor_id' => $teacher->id,
                'credits' => 3,
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $cs101->id, 'title' => 'Homework 1: Algorithm design'],
            [
                'description' => 'Design a pseudo-code algorithm to solve the traveling salesman problem.',
                'due_date' => now()->addDays(3),
                'points' => 10
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $cs101->id, 'title' => 'Lab 1: Basic Python Syntax'],
            [
                'description' => 'Complete the list-based coding exercises in the Jupyter notebook.',
                'due_date' => now()->addDays(7),
                'points' => 15
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $cs101->id, 'title' => 'Quiz 1: Binary & Hexadecimal'],
            [
                'description' => 'A multiple-choice quiz covering base-2 and base-16 conversions.',
                'due_date' => now()->addDays(10),
                'points' => 20
            ]
        );

        // Course 2
        $swe302 = Course::updateOrCreate(
            ['code' => 'SWE302'],
            [
                'title' => 'Advanced Web Development',
                'description' => 'Building modern scalable web systems, focusing on MVC architectures, REST APIs, and AJAX.',
                'instructor' => 'Mehedi Hasan',
                'instructor_id' => $teacher->id,
                'credits' => 4,
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $swe302->id, 'title' => 'Project: Create REST API'],
            [
                'description' => 'Build a backend RESTful service supporting CRUD operations on a resource, with complete validations.',
                'due_date' => now()->addDays(5),
                'points' => 50
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $swe302->id, 'title' => 'Assignment: Client-Side Routing'],
            [
                'description' => 'Implement a Single Page App (SPA) dashboard using native JavaScript fetch and route monitoring.',
                'due_date' => now()->addDays(12),
                'points' => 20
            ]
        );

        // Course 3
        $db201 = Course::updateOrCreate(
            ['code' => 'DB201'],
            [
                'title' => 'Database Management Systems',
                'description' => 'Concepts of relational database models, SQL language, schema design, and normalization (1NF to BCNF).',
                'instructor' => 'Tahmid Chowdhury',
                'instructor_id' => $teacher->id,
                'credits' => 3,
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $db201->id, 'title' => 'Homework: Normalization Exercises'],
            [
                'description' => 'Decompose a given set of unnormalized relation tables into 3NF.',
                'due_date' => now()->addDays(4),
                'points' => 15
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $db201->id, 'title' => 'Lab: Writing Complex SQL Joins'],
            [
                'description' => 'Query the school enrollment database using LEFT/RIGHT JOIN and sub-queries.',
                'due_date' => now()->addDays(9),
                'points' => 20
            ]
        );

        // Course 4
        $ai401 = Course::updateOrCreate(
            ['code' => 'AI401'],
            [
                'title' => 'Artificial Intelligence & Ethics',
                'description' => 'Overview of search algorithms, model weights, and ethical concerns of algorithmic bias.',
                'instructor' => 'Mynul Hasan',
                'instructor_id' => $teacher->id,
                'credits' => 3,
            ]
        );

        Task::firstOrCreate(
            ['course_id' => $ai401->id, 'title' => 'Essay: Algorithmic Bias in Systems'],
            [
                'description' => 'Write a 1500-word argumentative essay on the societal implications of predictive policing models.',
                'due_date' => now()->addDays(14),
                'points' => 30
            ]
        );
    }
}
