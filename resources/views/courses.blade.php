<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Courses - EduTrack</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            // Tailwind Configuration
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Plus Jakarta Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <!-- Custom Style System -->
        <style>
            /* Theme configuration */
            body.theme-space-dark {
                background-color: #080c14;
                background-image: 
                    linear-gradient(rgba(8, 12, 20, 0.88), rgba(8, 12, 20, 0.88)),
                    url('{{ asset('images/header-image.png') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
            body.theme-space-light {
                background-color: #f8fafc;
                background-image: 
                    linear-gradient(135deg, rgba(255, 255, 255, 0.84) 0%, rgba(237, 244, 254, 0.84) 65%, rgba(218, 231, 252, 0.84) 100%),
                    url('{{ asset('images/header-image.png') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
            
            /* Space Light Theme overrides */
            body.theme-space-light {
                color: #0f172a !important;
            }
            body.theme-space-light .text-white,
            body.theme-space-light h1,
            body.theme-space-light h2,
            body.theme-space-light h3,
            body.theme-space-light h4,
            body.theme-space-light strong.text-white {
                color: #0f172a !important;
            }
            body.theme-space-light .text-slate-200 {
                color: #1e293b !important;
            }
            body.theme-space-light .text-slate-400 {
                color: #475569 !important;
            }
            body.theme-space-light .glass-card {
                background: #edf1f7 !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border: 1px solid #cbd5e1 !important;
                box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04) !important;
            }
            body.theme-space-light header {
                background-color: #e2e8f0 !important;
                border-color: #cbd5e1 !important;
            }
            body.theme-space-light #theme-toggle {
                background: rgba(255, 255, 255, 0.6) !important;
                border-color: rgba(15, 23, 42, 0.1) !important;
                color: #334155 !important;
            }
            body.theme-space-light #theme-toggle:hover {
                background: rgba(15, 23, 42, 0.05) !important;
                color: #0f172a !important;
            }
            body.theme-space-light .bg-sky-500,
            body.theme-space-light a.bg-sky-500 {
                background-color: #38bdf8 !important;
                color: #ffffff !important;
            }
            body.theme-space-light .bg-sky-500:hover,
            body.theme-space-light a.bg-sky-500:hover {
                background-color: #0ea5e9 !important;
                color: #ffffff !important;
            }

            /* Dark theme overrides */
            body.theme-space-dark .glass-card {
                background: rgba(15, 23, 42, 0.35);
                border-color: rgba(255, 255, 255, 0.04);
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.25);
            }
            body.theme-space-dark header {
                background-color: rgba(8, 12, 20, 0.85);
                border-color: rgba(255, 255, 255, 0.08);
            }
            body.theme-space-dark #theme-toggle {
                background: rgba(255, 255, 255, 0.05);
                color: #f8fafc;
                border-color: rgba(255, 255, 255, 0.1);
            }
            body.theme-space-dark #theme-toggle:hover {
                transform: scale(1.05);
            }

            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
            }
        </style>
    </head>
    <body class="theme-space-light min-h-screen text-slate-100 flex flex-col transition-colors duration-500">
        
        <!-- Navigation Header -->
        <header class="border-b sticky top-0 z-50 backdrop-blur-xl">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Unique Animated Logo & Brand Name -->
                <a href="/" class="flex items-center gap-3 font-extrabold text-xl tracking-tight text-white">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M50 85C35 80 20 85 20 85V25C20 25 35 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M50 85C65 80 80 85 80 85V25C80 25 65 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <g id="logo-pen">
                                <path d="M55 21 H60 V28 H55" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <path d="M45 70 L50 84 L55 70 Z" fill="#e2e8f0" stroke="#475569" stroke-width="1.5" stroke-linejoin="round" />
                                <rect x="45" y="32" width="10" height="38" fill="url(#logo-grad-alt)" rx="1" />
                                <path d="M45 18 C45 14, 55 14, 55 18 V32 H45 Z" fill="#4f46e5" />
                                <circle cx="50" cy="14" r="2" fill="#8b5cf6" />
                            </g>
                            <defs>
                                <linearGradient id="logo-grad" x1="20" y1="25" x2="80" y2="85" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#4f46e5" />
                                    <stop offset="100%" stop-color="#8b5cf6" />
                                </linearGradient>
                                <linearGradient id="logo-grad-alt" x1="50" y1="25" x2="50" y2="85" gradientUnits="userSpaceOnUse">
                                    <stop offset="0%" stop-color="#8b5cf6" />
                                    <stop offset="100%" stop-color="#ec4899" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <span class="bg-gradient-to-r from-indigo-500 to-purple-500 bg-clip-text text-transparent logo-text">EduTrack</span>
                </a>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                    <a href="{{ route('features') }}" class="text-slate-400 hover:text-white transition">Features</a>
                    <a href="{{ route('about') }}" class="text-slate-400 hover:text-white transition">About</a>
                    <a href="{{ route('courses') }}" class="text-indigo-400 font-bold transition">Courses</a>
                </nav>

                <!-- Authentication Routes -->
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:scale-[1.02] text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-slate-400 hover:text-white text-sm font-semibold transition px-3">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:scale-[1.02] text-white text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg transition">Sign Up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Courses Container -->
        <main class="flex-grow max-w-7xl mx-auto px-6 py-12 w-full animate-fade-in-up">
            
            <!-- Header Block -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h1 class="text-4xl font-extrabold tracking-tight text-white mb-4">
                    Explore Our <span class="bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">Course Catalog</span>
                </h1>
                <p class="text-slate-400 text-base leading-relaxed">
                    Browse all available learning paths offered by our leading instructors. Connect to interactive workspaces, live sessions, and active peer collaboration forums.
                </p>
            </div>

            <!-- Course Catalog Grid -->
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($courses as $course)
                        <div class="glass-card rounded-[2rem] p-4 border transition-all duration-300 hover:scale-[1.02] hover:shadow-xl flex flex-col justify-between h-full group">
                            <div>
                                <!-- Course Image Box -->
                                <div class="relative overflow-hidden rounded-2xl aspect-[1.5] mb-4 bg-slate-950">
                                    <img src="{{ $course->image_path ? asset($course->image_path) : asset('images/bg' . (($loop->index % 5) + 1) . '.jpg') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $course->title }}">
                                    @if($course->class)
                                        <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-600/90 text-white backdrop-blur-sm border border-indigo-400/20 uppercase tracking-wider">
                                            {{ $course->class }}
                                        </span>
                                    @endif
                                    @if($course->subject)
                                        <span class="absolute top-3 right-3 px-2 py-0.5 rounded text-[9px] font-bold bg-purple-600/90 text-white backdrop-blur-sm border border-purple-400/20 uppercase tracking-wider">
                                            {{ $course->subject }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Provider / Instructor info -->
                                <div class="flex items-center gap-1.5 mb-2">
                                    <div class="w-4 h-4 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center border border-slate-700/50">
                                        <span class="text-[9px] font-bold uppercase">{{ substr($course->instructor, 0, 1) }}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-medium truncate">{{ $course->instructor }}</span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-sm font-bold text-white mb-2 leading-snug line-clamp-2 min-h-[40px] group-hover:text-indigo-400 transition-colors">
                                    {{ $course->title }}
                                </h3>
                            </div>

                            <!-- Footer details -->
                            <div class="mt-4 pt-3 border-t border-slate-800/40">
                                <div class="flex items-center justify-between mb-4">
                                    <!-- Price -->
                                    <span class="text-xs text-slate-200 font-extrabold">
                                        {{ $course->enrollment_fee == 0 ? 'Free' : '৳' . $course->enrollment_fee }}
                                    </span>
                                    <!-- Rating -->
                                    <div class="flex items-center gap-1 text-xs font-bold text-amber-400">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span>{{ $course->average_rating }}</span>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                @auth
                                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition justify-center bg-indigo-600 hover:bg-indigo-500 text-white shadow-md shadow-indigo-600/20 w-full">
                                        Go to Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition justify-center bg-sky-500 hover:bg-sky-400 text-white shadow-md shadow-sky-500/20 w-full">
                                        Enroll Now
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-slate-900/10 border border-dashed border-slate-800 rounded-3xl max-w-lg mx-auto">
                    <span class="text-4xl mb-4 block">📚</span>
                    <h3 class="text-lg font-bold text-white mb-1">No Courses Available</h3>
                    <p class="text-slate-500 text-sm">Please check back later for newly published programs.</p>
                </div>
            @endif

        </main>
    </body>
</html>
