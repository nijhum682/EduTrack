<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/features', function () {
    return view('features');
})->name('features');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/courses', function () {
    $courses = \App\Models\Course::all();
    $courses->each(function ($course) {
        $avgRating = $course->notes()->whereNotNull('rating')->avg('rating');
        if ($avgRating) {
            $course->average_rating = (float) round($avgRating, 1);
        } else {
            $hash = crc32($course->code);
            $course->average_rating = (float) (4.2 + (abs($hash) % 8) / 10);
        }
    });
    return view('courses', compact('courses'));
})->name('courses');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/api/activities/read', [App\Http\Controllers\ProfileController::class, 'markActivitiesAsRead'])->name('activities.read');

    // Shared API endpoints for courses catalog
    Route::get('/api/courses', [App\Http\Controllers\CourseApiController::class, 'index']);
    Route::post('/api/courses/{course}/enroll', [App\Http\Controllers\CourseApiController::class, 'enroll']);
    Route::post('/api/courses/{course}/unenroll', [App\Http\Controllers\CourseApiController::class, 'unenroll']);

    // Student Routes
    Route::middleware(['student'])->group(function () {
        Route::get('/dashboard', function () {
            if (Auth::user()->isTeacher()) {
                return redirect()->route('teacher.dashboard');
            }
            return view('dashboard');
        })->name('dashboard');

        // Student Exam Arena Routes
        Route::get('/exam/{task}', [App\Http\Controllers\StudentExamController::class, 'startExam'])->name('student.exam')->middleware('course.auth');
        Route::post('/exam/{task}/submit', [App\Http\Controllers\StudentExamController::class, 'submitExam'])->name('student.exam.submit')->middleware('course.auth');

        // Course Payment Flow
        Route::get('/course/{course}/payment', [App\Http\Controllers\CourseApiController::class, 'showPaymentPage'])->name('course.payment')->middleware('course.auth');
        Route::post('/course/{course}/payment/complete', [App\Http\Controllers\CourseApiController::class, 'completePayment'])->name('course.payment.complete')->middleware('course.auth');

        // API endpoints for AJAX operations
        Route::post('/api/tasks/{task}/toggle', [App\Http\Controllers\CourseApiController::class, 'toggleTask']);
        Route::get('/api/user/stats', [App\Http\Controllers\CourseApiController::class, 'getStats']);
    });

    // Shared Course Workspace Routes (enrolled students & teachers)
    Route::middleware(['course.auth'])->group(function () {
        Route::get('/course/{course}', [App\Http\Controllers\CourseApiController::class, 'showCourseDetails'])->name('course.show');
        Route::post('/course/{course}/notes', [App\Http\Controllers\CourseApiController::class, 'uploadNote'])->name('course.notes.upload')->middleware('student');
        Route::post('/course/{course}/notes/{note}/comment', [App\Http\Controllers\CourseApiController::class, 'commentNote'])->name('course.notes.comment');
        Route::post('/course/{course}/lectures/{lecture}/comment', [App\Http\Controllers\CourseApiController::class, 'commentLecture'])->name('course.lectures.comment');
        Route::post('/course/{course}/lectures/{lecture}/comments/{comment}/delete', [App\Http\Controllers\CourseApiController::class, 'deleteLectureComment'])->name('course.lectures.comment.delete');
        Route::post('/course/{course}/lectures/{lecture}/like', [App\Http\Controllers\CourseApiController::class, 'likeLecture'])->name('course.lectures.like');
        Route::post('/course/{course}/questions', [App\Http\Controllers\CourseApiController::class, 'askQuestion'])->name('course.questions.ask');
        Route::post('/course/{course}/questions/{question}/answers', [App\Http\Controllers\CourseApiController::class, 'replyQuestion'])->name('course.questions.reply');
        Route::post('/course/{course}/lectures', [App\Http\Controllers\TeacherDashboardController::class, 'createLecture'])->name('teacher.lectures.create');
        
        // Student assignment submissions
        Route::post('/course/{course}/tasks/{task}/submit', [App\Http\Controllers\CourseApiController::class, 'submitAssignment'])->name('course.tasks.submit')->middleware('student');
        Route::post('/course/{course}/submissions/{submission}/review', [App\Http\Controllers\CourseApiController::class, 'submitReviewRequest'])->name('course.submissions.review')->middleware('student');

        // Teacher editing operations scoped to a course
        Route::middleware(['teacher'])->group(function () {
            Route::post('/course/{course}/update', [App\Http\Controllers\TeacherDashboardController::class, 'updateCourseDetails'])->name('teacher.courses.update');
            Route::post('/course/{course}/lectures/{lecture}/update', [App\Http\Controllers\TeacherDashboardController::class, 'updateLecture'])->name('teacher.lectures.update');
            Route::post('/course/{course}/lectures/{lecture}/delete', [App\Http\Controllers\TeacherDashboardController::class, 'deleteLecture'])->name('teacher.lectures.delete');
            Route::post('/course/{course}/notes/{note}/evaluate', [App\Http\Controllers\TeacherDashboardController::class, 'evaluateNote'])->name('teacher.notes.evaluate');
            Route::post('/course/{course}/notes/{note}/delete', [App\Http\Controllers\TeacherDashboardController::class, 'deleteNote'])->name('teacher.notes.delete');
            Route::post('/course/{course}/questions/{question}/delete', [App\Http\Controllers\CourseApiController::class, 'deleteQuestion'])->name('course.questions.delete');
            Route::post('/course/{course}/questions/{question}/answers/{answer}/delete', [App\Http\Controllers\CourseApiController::class, 'deleteAnswer'])->name('course.answers.delete');
        });
    });

    // Teacher Routes
    Route::middleware(['teacher'])->group(function () {
        Route::get('/teacher/dashboard', [App\Http\Controllers\TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
        Route::post('/teacher/courses', [App\Http\Controllers\TeacherDashboardController::class, 'createCourse'])->name('teacher.courses.create');
        Route::post('/teacher/tasks', [App\Http\Controllers\TeacherDashboardController::class, 'createTask'])->name('teacher.tasks.create');
        Route::post('/teacher/tasks/{task}/update', [App\Http\Controllers\TeacherDashboardController::class, 'updateTask'])->name('teacher.tasks.update');
        Route::post('/teacher/submissions/{submission}/evaluate', [App\Http\Controllers\TeacherDashboardController::class, 'evaluateSubmission'])->name('teacher.submissions.evaluate')->middleware('course.auth');
        Route::post('/teacher/classes', [App\Http\Controllers\TeacherDashboardController::class, 'scheduleClass'])->name('teacher.classes.create');
        Route::post('/teacher/classes/{class}/toggle-active', [App\Http\Controllers\TeacherDashboardController::class, 'toggleClassActive'])->name('teacher.classes.toggle-active');
    });
    
    // Shared virtual classroom route
    Route::get('/classroom/{class}', [App\Http\Controllers\TeacherDashboardController::class, 'classroom'])->name('classroom')->middleware('course.auth');
    Route::post('/classroom/{class}/comment', [App\Http\Controllers\TeacherDashboardController::class, 'commentClass'])->name('classroom.comment')->middleware('course.auth');

    Route::match(['get', 'post'], '/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

