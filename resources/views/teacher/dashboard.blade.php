<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Teacher Dashboard - EduTrack</title>

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
                    linear-gradient(rgba(8, 12, 20, 0.82), rgba(8, 12, 20, 0.82)),
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
            body.theme-space-light .text-slate-100 {
                color: #0f172a !important;
            }
            body.theme-space-light .text-slate-200 {
                color: #0f172a !important;
            }
            body.theme-space-light .text-slate-300 {
                color: #1e293b !important;
            }
            body.theme-space-light .text-slate-400 {
                color: #334155 !important;
            }
            body.theme-space-light .text-slate-500 {
                color: #475569 !important;
            }
            body.theme-space-light .glass-panel {
                background: rgba(255, 255, 255, 0.55) !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border: 1px solid rgba(15, 23, 42, 0.08) !important;
                box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04) !important;
            }
            body.theme-space-light .glass-card {
                background: rgba(255, 255, 255, 0.6) !important;
                backdrop-filter: blur(8px) !important;
                -webkit-backdrop-filter: blur(8px) !important;
                border: 1px solid rgba(15, 23, 42, 0.06) !important;
            }
            body.theme-space-light input,
            body.theme-space-light select,
            body.theme-space-light textarea {
                background: rgba(255, 255, 255, 0.75) !important;
                border-color: rgba(15, 23, 42, 0.12) !important;
                color: #0f172a !important;
            }
            body.theme-space-light input::placeholder,
            body.theme-space-light textarea::placeholder {
                color: #64748b !important;
            }
            body.theme-space-light .border-slate-800\/80,
            body.theme-space-light .border-slate-800,
            body.theme-space-light .border-slate-700\/50,
            body.theme-space-light .border-slate-700 {
                border-color: rgba(15, 23, 42, 0.08) !important;
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
            body.theme-space-light .bg-slate-950\/30 {
                background-color: rgba(255, 255, 255, 0.4) !important;
            }
            body.theme-space-light .bg-slate-950\/40 {
                background-color: rgba(15, 23, 42, 0.05) !important;
            }
            body.theme-space-light .bg-slate-900\/50 {
                background-color: rgba(255, 255, 255, 0.5) !important;
            }
            body.theme-space-light .bg-slate-800\/50 {
                background-color: rgba(255, 255, 255, 0.45) !important;
            }
            body.theme-space-light .bg-slate-950 {
                background-color: rgba(255, 255, 255, 0.7) !important;
            }
            body.theme-space-light .bg-slate-900 {
                background-color: rgba(255, 255, 255, 0.6) !important;
            }
            body.theme-space-light .bg-slate-800 {
                background-color: rgba(15, 23, 42, 0.06) !important;
            }
            body.theme-space-light header {
                background-color: rgba(255, 255, 255, 0.45) !important;
                border-color: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light .welcome-banner {
                background: linear-gradient(135deg, rgba(139, 92, 246, 0.12) 0%, rgba(236, 72, 153, 0.12) 100%) !important;
                border-color: rgba(139, 92, 246, 0.18) !important;
            }
            body.theme-space-light .welcome-banner h1 {
                color: #3b0764 !important;
            }
            body.theme-space-light .welcome-banner p {
                color: #4c1d95 !important;
            }
            body.theme-space-light .welcome-banner span.inline-block {
                background-color: #6d28d9 !important;
                color: #ffffff !important;
            }
            body.theme-space-light .tab-btn.active {
                background-color: rgba(109, 40, 217, 0.12) !important;
                color: #6d28d9 !important;
                border-color: rgba(109, 40, 217, 0.3) !important;
            }
            body.theme-space-light .text-purple-300 {
                color: #6d28d9 !important;
            }
            body.theme-space-light .text-purple-400 {
                color: #5b21b6 !important;
            }
            body.theme-space-light .bg-purple-500\/10 {
                background-color: rgba(109, 40, 217, 0.1) !important;
            }
            body.theme-space-light .border-purple-500\/20 {
                border-color: rgba(109, 40, 217, 0.2) !important;
            }
            
            /* Glassmorphism styling variables */
            .glass-panel {
                background: rgba(15, 23, 42, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.06);
            }
            .glass-card {
                background: rgba(30, 41, 59, 0.4);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.05);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glass-card:hover {
                background: rgba(30, 41, 59, 0.55);
                border-color: rgba(139, 92, 246, 0.25);
                transform: translateY(-2px);
                box-shadow: 0 12px 20px -10px rgba(0, 0, 0, 0.5);
            }
            
            /* Customized scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }
            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.1);
            }
            ::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: rgba(139, 92, 246, 0.4);
            }

            .tab-btn.active {
                background-color: rgba(139, 92, 246, 0.2);
                color: #c084fc;
                border-color: rgba(139, 92, 246, 0.4);
            }
        </style>
    </head>
    <body class="theme-space-dark min-h-screen text-slate-100 flex flex-col transition-colors duration-500">
        
        <!-- Header Navigation Bar -->
        <header class="border-b border-slate-800/80 bg-slate-900/40 backdrop-blur-xl sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <!-- Branding -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-8 h-8">
                        <svg class="w-full h-full" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M50 85C35 80 20 85 20 85V25C20 25 35 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M50 85C65 80 80 85 80 85V25C80 25 65 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                            <g>
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
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">EduTrack <span class="text-xs uppercase bg-purple-500/20 text-purple-300 px-2 py-0.5 rounded-full ml-1 border border-purple-500/30">Teacher</span></span>
                </a>

                <!-- Theme Switcher & User Details -->
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer" title="Toggle Dashboard Theme">
                        ðŸŽ¨ Theme: <span id="theme-name">Space Dark</span>
                    </button>
                    
                    <a href="{{ route('logout') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition cursor-pointer border border-slate-700/50 flex items-center justify-center">
                        Log Out
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Container -->
        <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Toast notification messages -->
            <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2 max-w-sm w-full">
                @if (session('success'))
                    <div class="toast-item bg-emerald-950/90 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl shadow-2xl flex items-center justify-between gap-3 backdrop-blur-md transition-all duration-500">
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white font-bold">&times;</button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="toast-item bg-red-950/90 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl shadow-2xl flex items-center justify-between gap-3 backdrop-blur-md transition-all duration-500">
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-white font-bold">&times;</button>
                    </div>
                @endif
            </div>

            <!-- Welcome banner -->
            <div class="welcome-banner bg-gradient-to-r from-purple-900/30 to-pink-900/30 border border-purple-500/20 rounded-2xl p-6 mb-8 shadow-xl backdrop-blur-md relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <span class="inline-block bg-purple-500/20 text-purple-300 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3">Faculty Workspace</span>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Welcome, {{ Auth::user()->name }}!</h1>
                        <p class="text-slate-300 mt-1 leading-relaxed text-sm">
                            Manage your curriculum, design quiz questions, grade assignment papers, and broadcast live classroom simulations.
                        </p>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-purple-600/10 rounded-full blur-3xl -z-1"></div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">My Courses</span>
                    <span class="text-3xl font-extrabold text-white">{{ $courses->count() }}</span>
                </div>
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">Students Enrolled</span>
                    <span class="text-3xl font-extrabold text-white">{{ $courses->sum('enrolled_users_count') }}</span>
                </div>
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">Total Tasks Created</span>
                    <span class="text-3xl font-extrabold text-white">{{ $tasks->count() }}</span>
                </div>
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">Pending Evaluations</span>
                    <span class="text-3xl font-extrabold text-amber-400">{{ $submissions->whereNull('score')->count() }}</span>
                </div>
            </div>

            <!-- Dashboard Modules (Tabs) -->
            <div class="flex gap-2 border-b border-slate-800/80 mb-6 overflow-x-auto pb-1">
                <button onclick="switchTab('courses-tab')" id="courses-tab-btn" class="tab-btn active px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer">
                    ðŸ“š Courses & Tasks
                </button>
                <button onclick="switchTab('evaluations-tab')" id="evaluations-tab-btn" class="tab-btn px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer flex items-center gap-1.5">
                    ðŸ“ Evaluate Submissions 
                    @if($submissions->whereNull('score')->count() > 0)
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    @endif
                </button>
                <button onclick="switchTab('classes-tab')" id="classes-tab-btn" class="tab-btn px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer">
                    ðŸŽ¥ Schedule & Start Classes
                </button>
            </div>

            <!-- TAB 1: Courses & Tasks -->
            <div id="courses-tab" class="tab-content space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left: Create Course and Task Forms -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Create Course Form -->
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-purple-500/10 text-purple-400 flex items-center justify-center text-xs">ï¼‹</span>
                                Add New Course
                            </h2>
                            <form action="{{ route('teacher.courses.create') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Course Title</label>
                                    <input type="text" name="title" required placeholder="e.g. Operating Systems" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Course Code</label>
                                        <input type="text" name="code" required placeholder="e.g. CS302" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Credits</label>
                                        <select name="credits" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-purple-500 transition cursor-pointer">
                                            <option value="3">3 Credits</option>
                                            <option value="4">4 Credits</option>
                                            <option value="2">2 Credits</option>
                                            <option value="1">1 Credit</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Description</label>
                                    <textarea name="description" placeholder="Brief details about the syllabus..." rows="2" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-semibold text-xs rounded-xl py-3 shadow-lg shadow-purple-600/20 active:scale-[0.98] transition cursor-pointer">
                                    Create Course
                                </button>
                            </form>
                        </div>

                        <!-- Create Tasks & Exams Widget -->
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg space-y-4">
                            <h2 class="text-base font-bold text-white mb-2 flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xs">ï¼‹</span>
                                Create Tasks & Exams
                            </h2>
                            <p class="text-xs text-slate-400 leading-relaxed">Design custom coursework assignments or launch Google-Form style examinations with distinct marks distribution.</p>
                            
                            @if($courses->count() === 0)
                                <div class="bg-amber-500/10 border border-amber-500/20 rounded-xl p-3 text-[11px] text-amber-400 flex items-start gap-2 leading-relaxed">
                                    <span>âš ï¸</span>
                                    <div>
                                        <strong>No Courses Active:</strong> Please create a course first using the form on the left to activate task and exam creations.
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3 pt-1">
                                <!-- Button 1: Create Standard Assignment -->
                                <button onclick="openStandardTaskModal()" @disabled($courses->count() === 0) class="w-full bg-slate-900 hover:bg-slate-850/80 border border-slate-700/60 text-slate-200 hover:text-white font-semibold text-xs rounded-xl py-3.5 shadow-md flex items-center justify-center gap-2 transition cursor-pointer disabled:opacity-40 disabled:bg-slate-950 disabled:text-slate-600 disabled:border-slate-900 disabled:cursor-not-allowed disabled:shadow-none">
                                    ðŸ“ Create Standard Assignment
                                </button>
                                
                                <!-- Button 2: Create Google-Form Test -->
                                <button onclick="openTestBuilderModal()" @disabled($courses->count() === 0) class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold text-xs rounded-xl py-3.5 shadow-lg shadow-indigo-600/20 active:scale-[0.98] flex items-center justify-center gap-2 transition cursor-pointer disabled:opacity-40 disabled:from-slate-800 disabled:to-slate-850 disabled:text-slate-600 disabled:cursor-not-allowed disabled:shadow-none">
                                    âš¡ Create Google-Form Style Test
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Courses & Tasks List -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                            <h2 class="text-base font-bold text-white mb-4">My Courses & Syllabus Tasks</h2>
                            @if($courses->count() === 0)
                                <div class="text-center py-12 text-slate-500 text-sm">
                                    You are not currently teaching any courses. Create a new course on the left to start!
                                </div>
                            @else
                                <div class="space-y-6 max-h-[600px] overflow-y-auto pr-2">
                                    @foreach($courses as $course)
                                        <div class="border border-slate-800/85 rounded-xl bg-slate-900/20 p-5 space-y-4">
                                            <div class="flex items-center justify-between pb-2 border-b border-slate-800/60">
                                                <div>
                                                    <h3 class="text-sm font-bold text-purple-400">{{ $course->code }} &middot; {{ $course->title }}</h3>
                                                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $course->credits }} Credits &middot; {{ $course->description ?: 'No syllabus description provided.' }}</p>
                                                </div>
                                                <span class="text-xs bg-purple-500/10 text-purple-300 font-semibold py-1 px-3 rounded-full border border-purple-500/20">
                                                    {{ $course->enrolled_users_count }} Enrolled
                                                </span>
                                            </div>

                                            <div class="space-y-3">
                                                <h4 class="text-xs font-semibold text-slate-300">Active Course Assignments:</h4>
                                                @if($course->tasks->count() === 0)
                                                    <p class="text-xs text-slate-500 italic">No tasks created yet. Create a task on the left!</p>
                                                @else
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                        @foreach($course->tasks as $task)
                                                            <div class="bg-slate-950/40 border border-slate-800/60 rounded-xl p-3 space-y-1.5">
                                                                <div class="font-bold text-xs text-slate-200">{{ $task->title }}</div>
                                                                <p class="text-[10px] text-slate-500 leading-relaxed">{{ Str::limit($task->description, 100) }}</p>
                                                                <div class="flex justify-between items-center text-[9px] text-slate-400 border-t border-slate-800/40 pt-2 mt-2">
                                                                    <span>Max: <strong class="text-purple-400">{{ $task->points }} pts</strong></span>
                                                                    <span>Due: <strong>{{ $task->due_date->format('M d, Y H:i') }}</strong></span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Evaluations -->
            <div id="evaluations-tab" class="tab-content hidden space-y-6">
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <div class="mb-6">
                        <h2 class="text-base font-bold text-white">Student Submission Evaluation Console</h2>
                        <p class="text-xs text-slate-400">Review student task completions and assign grades/feedback</p>
                    </div>

                    @if($submissions->count() === 0)
                        <div class="text-center py-16 text-slate-500 text-sm">
                            No student submissions found. Active student task completions will appear here.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider text-[10px]">
                                        <th class="py-3 px-4">Student</th>
                                        <th class="py-3 px-4">Course</th>
                                        <th class="py-3 px-4">Task/Question</th>
                                        <th class="py-3 px-4">Completed On</th>
                                        <th class="py-3 px-4">Score</th>
                                        <th class="py-3 px-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-850">
                                    @foreach($submissions as $sub)
                                        <tr class="hover:bg-slate-900/20 transition-colors">
                                            <!-- Student Info -->
                                            <td class="py-4 px-4">
                                                <div class="font-bold text-slate-200">{{ $sub->user->name }}</div>
                                                <div class="text-[10px] text-slate-500">{{ $sub->user->email }}</div>
                                            </td>
                                            <!-- Course -->
                                            <td class="py-4 px-4 text-slate-300">
                                                <span class="bg-purple-950/40 text-purple-300 border border-purple-900/50 px-2 py-0.5 rounded text-[10px]">
                                                    {{ $sub->task->course->code }}
                                                </span>
                                            </td>
                                            <!-- Task -->
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-slate-200">{{ $sub->task->title }}</div>
                                                <div class="text-[9px] text-slate-500">Max Weight: {{ $sub->task->points }} pts</div>
                                            </td>
                                            <!-- Date -->
                                            <td class="py-4 px-4 text-slate-400">
                                                {{ $sub->updated_at->format('M d, Y - H:i') }}
                                            </td>
                                            <!-- Score/Status -->
                                            <td class="py-4 px-4">
                                                @if(is_null($sub->score))
                                                    <span class="text-amber-400 font-semibold bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-500/20 text-[10px]">
                                                        â³ Pending Evaluation
                                                    </span>
                                                @else
                                                    <div class="font-bold text-emerald-400 text-sm">
                                                        {{ $sub->score }} <span class="text-[10px] text-slate-500">/ {{ $sub->task->points }}</span>
                                                    </div>
                                                    <div class="text-[10px] text-slate-500 italic mt-0.5">Feedback: "{{ Str::limit($sub->feedback ?: 'No remarks', 30) }}"</div>
                                                @endif
                                            </td>
                                            <!-- Actions -->
                                            <td class="py-4 px-4 text-right">
                                                <button 
                                                    class="grading-btn bg-indigo-600/10 hover:bg-indigo-600/25 text-indigo-400 font-bold py-1.5 px-3 rounded-lg border border-indigo-500/20 transition cursor-pointer text-[11px]"
                                                    data-id="{{ $sub->id }}"
                                                    data-student="{{ $sub->user->name }}"
                                                    data-task-title="{{ $sub->task->title }}"
                                                    data-max-points="{{ $sub->task->points }}"
                                                    data-score="{{ $sub->score }}"
                                                    data-feedback="{{ $sub->feedback }}"
                                                    data-is-test="{{ $sub->task->is_test ? 1 : 0 }}"
                                                    data-questions="{{ json_encode($sub->task->questions) }}"
                                                    data-answers="{{ json_encode($sub->answers) }}"
                                                    data-file="{{ $sub->uploaded_file ? asset($sub->uploaded_file) : '' }}"
                                                    onclick="handleGradingButtonClick(this)">
                                                    {{ is_null($sub->score) ? 'Grade Submission' : 'Re-Evaluate' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <!-- TAB 3: Schedule & Take Classes -->
            <div id="classes-tab" class="tab-content hidden space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left: Schedule Class Form -->
                    <div class="lg:col-span-1">
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-pink-500/10 text-pink-400 flex items-center justify-center text-xs">ðŸŽ¥</span>
                                Schedule Virtual Class
                            </h2>
                            <form action="{{ route('teacher.classes.create') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Target Course</label>
                                    <select name="course_id" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-pink-500 transition cursor-pointer">
                                        @if($courses->count() === 0)
                                            <option value="">-- Create a Course First --</option>
                                        @else
                                            @foreach($courses as $c)
                                                <option value="{{ $c->id }}">{{ $c->code }} &middot; {{ $c->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Class Topic / Title</label>
                                    <input type="text" name="title" required placeholder="e.g. Chapter 4: Database Normalization" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Start Time</label>
                                    <input type="datetime-local" name="scheduled_at" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-pink-500 transition">
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Duration (Mins)</label>
                                        <input type="number" name="duration_minutes" required value="60" min="15" max="180" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Platform</label>
                                        <select name="platform" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-pink-500 transition cursor-pointer">
                                            <option value="In-App Classroom">In-App Virtual Room</option>
                                            <option value="Zoom">Zoom Meeting</option>
                                            <option value="Google Meet">Google Meet</option>
                                            <option value="Microsoft Teams">Microsoft Teams</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Meeting Link (Optional)</label>
                                    <input type="url" name="meeting_link" placeholder="https://zoom.us/j/..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
                                </div>
                                <button type="submit" @disabled($courses->count() === 0) class="w-full bg-pink-600 hover:bg-pink-500 text-white font-semibold text-xs rounded-xl py-3 shadow-lg shadow-pink-600/20 active:scale-[0.98] transition cursor-pointer disabled:opacity-50">
                                    Schedule Class Session
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right: Scheduled Classes list -->
                    <div class="lg:col-span-2">
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                            <h2 class="text-base font-bold text-white mb-4">Class Schedule & Host Console</h2>
                            
                            @if($scheduledClasses->count() === 0)
                                <div class="text-center py-16 text-slate-500 text-sm">
                                    No classes scheduled yet. Create one using the scheduling form on the left.
                                </div>
                            @else
                                <div class="space-y-4 max-h-[550px] overflow-y-auto pr-2">
                                    @foreach($scheduledClasses as $class)
                                        <div class="border {{ $class->is_active ? 'border-pink-500/40 bg-pink-950/5' : 'border-slate-800/80 bg-slate-900/20' }} rounded-xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 transition-all duration-300">
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] uppercase font-extrabold px-2 py-0.5 rounded bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                                        {{ $class->course->code }}
                                                    </span>
                                                    <span class="text-xs text-slate-400">Duration: {{ $class->duration_minutes }} Mins</span>
                                                    @if($class->is_active)
                                                        <span class="inline-flex items-center gap-1.5 text-[9px] uppercase font-bold text-pink-400 bg-pink-500/10 px-2 py-0.5 rounded-full border border-pink-500/30">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-ping"></span> Live Now
                                                        </span>
                                                    @endif
                                                </div>
                                                <h3 class="text-sm font-bold text-white">{{ $class->title }}</h3>
                                                <p class="text-[10px] text-slate-500">
                                                    Scheduled: {{ $class->scheduled_at->format('M d, Y - H:i') }} ({{ $class->scheduled_at->diffForHumans() }})
                                                </p>
                                                <p class="text-[10px] text-slate-500">Platform: <strong>{{ $class->platform }}</strong></p>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <!-- Start / End Toggle Button -->
                                                <form action="{{ route('teacher.classes.toggle-active', $class->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs px-3.5 py-2 font-bold rounded-lg transition border cursor-pointer {{ $class->is_active ? 'bg-slate-800 hover:bg-slate-700 text-slate-200 border-slate-700/60' : 'bg-pink-600 hover:bg-pink-500 text-white border-pink-500/20 shadow-md shadow-pink-600/10' }}">
                                                        {{ $class->is_active ? 'â¹ End Session' : 'â–¶ Start Class' }}
                                                    </button>
                                                </form>

                                                <!-- Enter Classroom Simulation -->
                                                @if($class->platform === 'In-App Classroom')
                                                    <a href="{{ route('classroom', $class->id) }}" class="text-xs bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-3.5 rounded-lg border border-purple-500/20 transition cursor-pointer shadow-md shadow-purple-600/10">
                                                        ðŸ’» Launch Classroom
                                                    </a>
                                                @elseif($class->meeting_link)
                                                    <a href="{{ $class->meeting_link }}" target="_blank" class="text-xs bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold py-2 px-3.5 rounded-lg border border-slate-700/60 transition cursor-pointer">
                                                        ðŸ”— External Link
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
