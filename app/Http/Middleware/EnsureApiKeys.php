<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApiKeys
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Check Stripe key for payment completions
        if ($request->routeIs('course.payment.complete')) {
            if (empty(config('services.stripe.secret'))) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Stripe API key is missing. Please configure STRIPE_API_KEY in .env'], 500);
                }
                return redirect()->back()->with('error', 'Stripe API key is missing. Please configure STRIPE_API_KEY in .env');
            }
        }

        // 2. Check Google Meet key for scheduling classes
        if ($request->routeIs('teacher.classes.create')) {
            if ($request->input('platform') === 'Google Meet' && empty(config('services.google_meet.key'))) {
                return redirect()->back()->with('error', 'Google Meet API key is missing. Please configure GOOGLE_MEET_API_KEY in .env');
            }
        }

        // 3. Check OpenAI key for creating lectures
        if ($request->routeIs('teacher.lectures.create')) {
            if (empty(config('services.openai.key')) && $request->filled('details')) {
                session()->flash('warning', 'OpenAI API key is missing. Lecture uploaded without AI summary generation.');
            }
        }

        return $next($request);
    }
}
