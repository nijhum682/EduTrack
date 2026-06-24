<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Student Routes
    Route::middleware(['student'])->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->isTeacher()) {
                return redirect()->route('teacher.dashboard');
            }
            return view('dashboard');
        })->name('dashboard');

        // Student Exam Arena Routes
        Route::get('/exam/{task}', [App\Http\Controllers\StudentExamController::class, 'startExam'])->name('student.exam');
        Route::post('/exam/{task}/submit', [App\Http\Controllers\StudentExamController::class, 'submitExam'])->name('student.exam.submit');

        // Course Payment Flow
        Route::get('/course/{course}/payment', [App\Http\Controllers\CourseApiController::class, 'showPaymentPage'])->name('course.payment')->middleware('course.auth');
        Route::post('/course/{course}/payment/complete', [App\Http\Controllers\CourseApiController::class, 'completePayment'])->name('course.payment.complete')->middleware('course.auth');

        // API endpoints for AJAX operations
        Route::get('/api/courses', [App\Http\Controllers\CourseApiController::class, 'index']);
        Route::post('/api/courses/{course}/enroll', [App\Http\Controllers\CourseApiController::class, 'enroll']);
        Route::post('/api/courses/{course}/unenroll', [App\Http\Controllers\CourseApiController::class, 'unenroll']);
        Route::post('/api/tasks/{task}/toggle', [App\Http\Controllers\CourseApiController::class, 'toggleTask']);
        Route::get('/api/user/stats', [App\Http\Controllers\CourseApiController::class, 'getStats']);
    });

    // Teacher Routes
    Route::middleware(['teacher'])->group(function () {
        Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
        Route::post('/teacher/courses', [App\Http\Controllers\TeacherDashboardController::class, 'createCourse'])->name('teacher.courses.create');
        Route::post('/teacher/tasks', [App\Http\Controllers\TeacherDashboardController::class, 'createTask'])->name('teacher.tasks.create');
        Route::post('/teacher/submissions/{submission}/evaluate', [App\Http\Controllers\TeacherDashboardController::class, 'evaluateSubmission'])->name('teacher.submissions.evaluate');
        Route::post('/teacher/classes', [App\Http\Controllers\TeacherDashboardController::class, 'scheduleClass'])->name('teacher.classes.create');
        Route::post('/teacher/classes/{class}/toggle-active', [App\Http\Controllers\TeacherDashboardController::class, 'toggleClassActive'])->name('teacher.classes.toggle-active');
    });
    
    // Shared virtual classroom route
    Route::get('/classroom/{class}', [App\Http\Controllers\TeacherDashboardController::class, 'classroom'])->name('classroom');

    Route::match(['get', 'post'], '/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

