<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Append our custom activity tracking middleware to the web group
        $middleware->web(append: [
            \App\Http\Middleware\TrackUserActivity::class,
        ]);

        // Exclude cookies from Laravel's default encryption so frontend JS can access them
        $middleware->encryptCookies(except: [
            'user_last_active_time',
            'dashboard_theme',
        ]);

        // Exempt logout from CSRF validation
        $middleware->validateCsrfTokens(except: [
            'logout',
        ]);

        // Register route aliases for role protection middlewares
        $middleware->alias([
            'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
            'student' => \App\Http\Middleware\StudentMiddleware::class,
            'course.auth' => \App\Http\Middleware\CourseAuthorization::class,
            'api.keys' => \App\Http\Middleware\EnsureApiKeys::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
