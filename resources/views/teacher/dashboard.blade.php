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
                <div class="flex items-center gap-3">
                    <button id="theme-toggle" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer" title="Toggle Dashboard Theme">
                        🎨 Theme: <span id="theme-name">Space Dark</span>
                    </button>

                    <!-- Notifications Button -->
                    <button onclick="toggleNotificationsModal()" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer flex items-center gap-1.5" title="View Activity Notifications">
                        🔔 Notifications
                        @php
                            $notifCount = Auth::user()->activities()->count();
                        @endphp
                        @if($notifCount > 0)
                            <span class="bg-indigo-500 text-white rounded-full px-1.5 py-0.5 text-[10px] font-bold">{{ $notifCount }}</span>
                        @endif
                    </button>

                    <!-- Profile Button -->
                    <button onclick="toggleProfileModal()" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer flex items-center gap-1" title="Manage Profile">
                        👤 Profile
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 max-w-3xl mx-auto">
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">My Courses</span>
                    <span class="text-3xl font-extrabold text-white">{{ $courses->count() }}</span>
                </div>
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">Students Enrolled</span>
                    <span class="text-3xl font-extrabold text-white">{{ $courses->sum('enrolled_users_count') }}</span>
                </div>
                <div class="glass-panel rounded-2xl p-5 shadow-md border border-slate-800/80">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block mb-1">Pending Evaluations</span>
                    <span class="text-3xl font-extrabold text-amber-400">{{ $submissions->whereNull('score')->count() }}</span>
                </div>
            </div>

            <!-- Dashboard Modules (Tabs) -->
            <div class="flex gap-2 border-b border-slate-800/80 mb-6 overflow-x-auto pb-px max-w-3xl mx-auto">
                <button onclick="switchTab('courses-tab')" id="courses-tab-btn" class="tab-btn active px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer">
                    📚 Courses & Tasks
                </button>
                <button onclick="switchTab('evaluations-tab')" id="evaluations-tab-btn" class="tab-btn px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer flex items-center gap-1.5">
                    📝 Evaluate Submissions 
                    @if($submissions->whereNull('score')->count() > 0)
                        <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    @endif
                </button>
                <button onclick="switchTab('classes-tab')" id="classes-tab-btn" class="tab-btn px-4 py-2 border border-transparent rounded-xl text-sm font-semibold transition whitespace-nowrap cursor-pointer">
                    📅 Schedule & Start Classes
                </button>
            </div>

            <!-- TAB 1: Courses & Tasks -->
            <div id="courses-tab" class="tab-content space-y-6">
                <!-- Center aligned elegant Course Creator -->
                <div class="max-w-3xl mx-auto">
                    <!-- Create Course Form -->
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-purple-500/10 text-purple-400 flex items-center justify-center text-xs">+</span>
                            Add New Course
                        </h2>
                        <form action="{{ route('teacher.courses.create') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">Course Title</label>
                                <input type="text" name="title" required placeholder="e.g. Operating Systems" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
                            </div>
                            <div class="grid grid-cols-3 gap-3">
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Course Code</label>
                                    <input type="text" name="code" required placeholder="e.g. CS302" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Course Fee (৳)</label>
                                    <input type="number" name="enrollment_fee" required min="0" value="0" placeholder="e.g. 500" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Class</label>
                                    <select name="class" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-purple-500 transition cursor-pointer">
                                        <option value="Class 8">Class 8</option>
                                        <option value="Class 9">Class 9</option>
                                        <option value="Class 10">Class 10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Cover Image upload segment -->
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Course Cover Image</label>
                                    <input type="file" name="course_image" accept="image/*" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-purple-500 transition cursor-pointer file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20">
                                </div>
                                <!-- Subject input segment -->
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Subject</label>
                                    <input type="text" name="subject" required placeholder="e.g. Science, Mathematics, English" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
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
                </div>

                <!-- Course Catalog & Workspace Layout Wrapper -->
                <div class="space-y-8 mt-8">
                    
                    <!-- Full-Width Available Course Catalog -->
                    <section>
                        <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                            <!-- Heading & Search/Filter Controls -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                                <div>
                                    <h2 class="text-xl font-extrabold text-white tracking-tight">Available Course Catalog</h2>
                                    <p class="text-xs text-slate-400 mt-1">Search and filter courses in real-time (MySQL CRUD Read)</p>
                                </div>
                                
                                <!-- Search and Filter inputs inline -->
                                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                                    <div class="relative w-full sm:w-64">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="catalog-search" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 pl-9 pr-4 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition" placeholder="Search by title or course code...">
                                    </div>
                                    <div class="w-full sm:w-44">
                                        <select id="catalog-class" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-purple-500 transition cursor-pointer">
                                            <option value="">All Classes</option>
                                            <option value="Class 8">Class 8</option>
                                            <option value="Class 9">Class 9</option>
                                            <option value="Class 10">Class 10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Catalog List (Asynchronously rendered by Javascript) -->
                            <div id="course-catalog-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                <!-- Skeleton loader while fetching -->
                                <div class="text-center py-12 text-slate-500 text-sm col-span-full">
                                    Loading course catalog...
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
                    </section>
                </div>
            </div>

            <!-- TAB 2: Evaluations -->
            <div id="evaluations-tab" class="tab-content hidden space-y-6 max-w-3xl mx-auto">
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
                                                        ⏳ Pending Evaluation
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
                <!-- Top: Schedule Class Form (Standard Width) -->
                <div class="max-w-3xl mx-auto">
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-pink-500/10 text-pink-400 flex items-center justify-center text-xs">🎥</span>
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
                                <input type="text" name="title" required placeholder="e.g. Chapter 4: Respiration" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
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

                <!-- Bottom: Live Class Schedule (Standard Width) -->
                <div class="max-w-3xl mx-auto">
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <h2 class="text-base font-bold text-white mb-4">Live Class Schedule</h2>
                        
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
                                         <div class="flex items-center gap-2">
                                            <!-- Start / End Toggle Button -->
                                            <form action="{{ route('teacher.classes.toggle-active', $class->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs px-3.5 py-2 font-bold rounded-lg transition border cursor-pointer {{ $class->is_active ? 'bg-slate-800 hover:bg-slate-700 text-slate-200 border-slate-700/60' : 'bg-pink-600 hover:bg-pink-500 text-white border-pink-500/20 shadow-md shadow-pink-600/10' }}">
                                                    {{ $class->is_active ? '⏹ End Session' : '▶ Start Class' }}
                                                </button>
                                            </form>

                                            <!-- Enter Classroom Simulation -->
                                            @if($class->platform === 'In-App Classroom')
                                                <a href="{{ route('classroom', $class->id) }}" class="text-xs bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-3.5 rounded-lg border border-purple-500/20 transition cursor-pointer shadow-md shadow-purple-600/10">
                                                    💻 Launch Classroom
                                                </a>
                                            @elseif($class->meeting_link)
                                                <a href="{{ $class->meeting_link }}" target="_blank" class="text-xs bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold py-2 px-3.5 rounded-lg border border-slate-700/60 transition cursor-pointer">
                                                    🔗 External Link
                                                </a>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </main>

        <!-- Standard Task Modal -->
        <div id="standard-task-modal" class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm hidden items-center justify-center p-4">
            <div class="glass-panel w-full max-w-md rounded-2xl border border-slate-800 p-6 shadow-2xl relative">
                <button onclick="closeStandardTaskModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white font-bold text-lg cursor-pointer">&times;</button>
                <h3 class="text-lg font-bold text-white mb-4">Create Standard Assignment</h3>
                <form action="{{ route('teacher.tasks.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs text-slate-400 font-semibold mb-1">Target Course</label>
                        <select name="course_id" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-indigo-500 transition cursor-pointer">
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}">{{ $c->code }} &middot; {{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 font-semibold mb-1">Assignment Title</label>
                        <input type="text" name="title" required placeholder="e.g. Lab 2: File IO Operations" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Max Points</label>
                            <input type="number" name="points" required value="10" min="1" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition">
                        </div>
                        <div>
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Due Date</label>
                            <input type="datetime-local" name="due_date" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-indigo-500 transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-slate-400 font-semibold mb-1">Requirements / Guidelines</label>
                        <textarea name="description" placeholder="Write out the task instructions for students..." rows="3" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl py-3.5 shadow-lg shadow-indigo-650/20 active:scale-[0.98] transition cursor-pointer">
                        Create Assignment
                    </button>
                </form>
            </div>
        </div>

        <!-- Test Builder Modal (Google Forms style) -->
        <div id="test-builder-modal" class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm hidden items-center justify-center p-4 overflow-y-auto">
            <div class="glass-panel w-full max-w-3xl rounded-2xl border border-slate-800 p-6 shadow-2xl relative my-8 max-h-[90vh] flex flex-col">
                <button onclick="closeTestBuilderModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white font-bold text-lg cursor-pointer z-10">&times;</button>
                
                <div class="pb-4 border-b border-slate-800 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-white">Google-Form Style Test Builder</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Design exam papers with dynamic question distribution</p>
                    </div>
                    <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl px-4 py-2 text-right">
                        <span class="text-[9px] uppercase font-bold text-indigo-400 block">Total Marks</span>
                        <span class="text-base font-extrabold text-white" id="builder-total-marks">0</span>
                    </div>
                </div>

                <form action="{{ route('teacher.tasks.create') }}" method="POST" class="space-y-5 overflow-y-auto flex-grow pr-2 pt-4">
                    @csrf
                    <input type="hidden" name="is_test" value="1">

                    <!-- Test Meta Details -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-4">
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Target Course</label>
                            <select name="course_id" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2.5 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition cursor-pointer">
                                @foreach($courses as $c)
                                    <option value="{{ $c->id }}">{{ $c->code }} &middot; {{ $c->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-5">
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Test Title</label>
                            <input type="text" name="title" required placeholder="e.g. Midterm: Respiration" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Duration (Minutes)</label>
                            <input type="number" name="duration_minutes" required value="60" min="5" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition text-center">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-8">
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Instructions / Description</label>
                            <input type="text" name="description" placeholder="Instructions: Answer all questions. For files, upload your clear khata photo." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition">
                        </div>
                        <div class="md:col-span-4">
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Due Date</label>
                            <input type="datetime-local" name="due_date" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition">
                        </div>
                    </div>

                    <!-- Dynamic Questions Container -->
                    <div class="border-t border-slate-800/80 pt-4 space-y-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Questions List</h4>
                            <button type="button" onclick="addQuestion()" class="bg-indigo-600 hover:bg-indigo-500 text-white text-[11px] font-bold py-1.5 px-3.5 rounded-lg transition cursor-pointer flex items-center gap-1 shadow-md shadow-indigo-600/10">
                                + Add Question
                            </button>
                        </div>

                        <!-- Question card elements go here -->
                        <div id="test-questions-list" class="space-y-4">
                            <!-- JS templates insert here -->
                        </div>
                    </div>

                    <!-- Submit Footer -->
                    <div class="border-t border-slate-800 pt-4 flex justify-end gap-3 flex-shrink-0">
                        <button type="button" onclick="closeTestBuilderModal()" class="bg-slate-900 border border-slate-700/60 text-slate-300 hover:text-white text-xs font-semibold py-2.5 px-5 rounded-xl transition cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-2.5 px-6 rounded-xl transition cursor-pointer shadow-lg shadow-indigo-650/20 active:scale-[0.98]">
                            Save & Publish Test
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Evaluation / Grading Modal -->
        <div id="grading-modal" class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm hidden items-center justify-center p-4 overflow-y-auto">
            <div class="glass-panel w-full max-w-2xl rounded-2xl border border-slate-800 p-6 shadow-2xl relative my-8 max-h-[90vh] flex flex-col">
                <button onclick="closeGradingModal()" class="absolute top-4 right-4 text-slate-400 hover:text-white font-bold text-lg cursor-pointer z-10">&times;</button>
                
                <div class="pb-3 border-b border-slate-850 flex-shrink-0">
                    <h3 class="text-base font-bold text-white mb-0.5">Evaluate Assignment Submission</h3>
                    <p class="text-xs text-slate-400">Review student response from <strong id="grading-student" class="text-white"></strong></p>
                </div>
                
                <div class="bg-slate-950/40 border border-slate-800/80 rounded-xl p-3 my-4 flex justify-between items-center flex-shrink-0">
                    <div>
                        <span class="text-[9px] uppercase font-bold text-slate-500 block mb-0.5">Task Title</span>
                        <span class="text-xs font-semibold text-slate-300" id="grading-task-title"></span>
                    </div>
                    <div class="text-right">
                        <span class="text-[9px] uppercase font-bold text-slate-500 block mb-0.5">Max Marks</span>
                        <span class="text-xs font-bold text-slate-300" id="grading-max-points">0</span>
                    </div>
                </div>

                <form id="grading-form" method="POST" class="space-y-4 overflow-y-auto flex-grow pr-2">
                    @csrf
                    
                    <!-- CASE A: Standard Single Grade Block -->
                    <div id="grading-standard-block" class="space-y-4">
                        <div>
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Assign Score</label>
                            <div class="flex items-center gap-3">
                                <input type="number" id="grading-score" name="score" min="0" class="w-24 bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition text-center font-bold text-base">
                                <span class="text-slate-400 font-bold">/ <span id="grading-max-points-label" class="text-white">10</span> Points</span>
                            </div>
                        </div>
                    </div>

                    <!-- CASE B: Google Form Question-by-Question Grading Block -->
                    <div id="grading-test-questions-block" class="hidden space-y-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-purple-400">Question Grading Console</h4>
                        
                        <!-- Question Answers and Grading Inputs List -->
                        <div id="grading-questions-list" class="space-y-4 divide-y divide-slate-850">
                            <!-- Populated dynamically via JS -->
                        </div>
                        
                        <!-- Calculated Total Grade Display -->
                        <div class="bg-purple-950/20 border border-purple-900/40 rounded-xl p-4 flex items-center justify-between">
                            <span class="text-xs font-bold text-purple-300">Summed Total Grade:</span>
                            <span class="text-base font-extrabold text-white"><span id="grading-calculated-total">0</span> / <span id="grading-test-max-marks">0</span> pts</span>
                        </div>
                    </div>

                    <!-- Uploaded Khata Preview Block -->
                    <div id="grading-khata-block" class="hidden border-t border-slate-800/80 pt-4 space-y-2">
                        <span class="text-xs font-bold text-slate-400 block">Uploaded Khata (Answer Sheet)</span>
                        <div class="border border-slate-800 rounded-xl bg-slate-900/40 p-2 text-center overflow-hidden">
                            <a id="grading-khata-link" href="#" target="_blank" title="Click to view full size">
                                <img id="grading-khata-img" src="" alt="Khata answer sheet" class="max-h-72 mx-auto rounded-lg border border-slate-800 hover:scale-[1.01] transition-transform duration-300 cursor-zoom-in">
                            </a>
                        </div>
                    </div>

                    <!-- Feedback block -->
                    <div class="border-t border-slate-800/80 pt-4">
                        <label class="block text-xs text-slate-400 font-semibold mb-1">Teacher Feedback / Remarks</label>
                        <textarea id="grading-feedback" name="feedback" rows="3" placeholder="Add guidance, positive remarks, or corrections..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition"></textarea>
                    </div>

                    <!-- Submit footer -->
                    <div class="border-t border-slate-850 pt-4 flex justify-end gap-3 flex-shrink-0">
                        <button type="button" onclick="closeGradingModal()" class="bg-slate-900 border border-slate-700/60 text-slate-300 hover:text-white text-xs font-semibold py-2 px-5 rounded-xl transition cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" class="bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold py-2 px-6 rounded-xl transition cursor-pointer shadow-lg shadow-purple-650/20 active:scale-[0.98]">
                            Submit Grades
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-950/40 py-6 text-center text-xs text-slate-500">
            <p>&copy; 2026 EduTrack</p>
        </footer>

        <!-- Scripts -->
        <script>
            // TAB SWITCHING
            function switchTab(tabId) {
                const tabEl = document.getElementById(tabId);
                const btnEl = document.getElementById(tabId + '-btn');
                
                if (!tabEl || !btnEl) {
                    if (tabId !== 'courses-tab') {
                        switchTab('courses-tab');
                    }
                    return;
                }

                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.add('hidden');
                });
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                tabEl.classList.remove('hidden');
                btnEl.classList.add('active');
                
                // Save active tab preference
                localStorage.setItem('teacher_active_tab', tabId);
            }

            // Standard Task Modals
            function openStandardTaskModal(courseId = null) {
                const modal = document.getElementById('standard-task-modal');
                if (courseId) {
                    const select = modal.querySelector('select[name="course_id"]');
                    if (select) select.value = courseId;
                }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
            function closeStandardTaskModal() {
                const modal = document.getElementById('standard-task-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Test Builder Modals
            function openTestBuilderModal(courseId = null) {
                const modal = document.getElementById('test-builder-modal');
                if (courseId) {
                    const select = modal.querySelector('select[name="course_id"]');
                    if (select) select.value = courseId;
                }
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                
                const list = document.getElementById('test-questions-list');
                if (list.children.length === 0) {
                    addQuestion();
                }
            }
            function closeTestBuilderModal() {
                const modal = document.getElementById('test-builder-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Dynamic Question Builder JS
            let questionCount = 0;
            function addQuestion() {
                const list = document.getElementById('test-questions-list');
                const index = questionCount++;
                
                const qBlock = document.createElement('div');
                qBlock.id = `q-block-${index}`;
                qBlock.className = 'bg-slate-950/40 border border-slate-800/80 rounded-xl p-4 space-y-4 relative shadow-md';
                qBlock.innerHTML = `
                    <button type="button" onclick="removeQuestion(${index})" class="absolute top-4 right-4 text-xs text-red-400 hover:text-red-300 font-semibold cursor-pointer">🗑️ Delete</button>
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-7">
                            <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Question ${index + 1} Text</label>
                            <input type="text" name="questions[${index}][text]" required placeholder="e.g. Write a brief history of Turing Machines." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Question Type</label>
                            <select name="questions[${index}][type]" onchange="handleTypeChange(this, ${index})" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-400 outline-none focus:border-indigo-500 transition cursor-pointer">
                                <option value="written">Written Text Response</option>
                                <option value="mcq">Multiple Choice (MCQ)</option>
                                <option value="file">File Upload (Notebook / Khata)</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Marks</label>
                            <input type="number" name="questions[${index}][points]" required value="5" min="1" oninput="updateTotalPoints()" class="points-input w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition text-center font-bold">
                        </div>
                    </div>

                    <!-- MCQ Options block (Hidden by default) -->
                    <div id="options-block-${index}" class="hidden pl-4 border-l-2 border-indigo-500/20 space-y-2">
                        <label class="block text-[10px] text-slate-500 font-bold uppercase">MCQ Choice Options</label>
                        <div id="options-container-${index}" class="space-y-2">
                            <div class="flex items-center gap-2 option-row">
                                <span class="text-xs text-slate-500 font-mono">1.</span>
                                <input type="text" name="questions[${index}][options][]" value="Option A" class="bg-slate-900/60 border border-slate-850 rounded-xl py-1 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition flex-grow">
                                <button type="button" onclick="removeOption(this)" class="text-slate-500 hover:text-red-400 font-bold text-xs cursor-pointer">&times;</button>
                            </div>
                            <div class="flex items-center gap-2 option-row">
                                <span class="text-xs text-slate-500 font-mono">2.</span>
                                <input type="text" name="questions[${index}][options][]" value="Option B" class="bg-slate-900/60 border border-slate-850 rounded-xl py-1 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition flex-grow">
                                <button type="button" onclick="removeOption(this)" class="text-slate-500 hover:text-red-400 font-bold text-xs cursor-pointer">&times;</button>
                            </div>
                        </div>
                        <button type="button" onclick="addOption(${index})" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold cursor-pointer">+ Add Choice Option</button>
                    </div>
                `;
                
                list.appendChild(qBlock);
                updateTotalPoints();
            }

            function removeQuestion(index) {
                const block = document.getElementById(`q-block-${index}`);
                if (block) {
                    block.remove();
                }
                updateTotalPoints();
            }

            function handleTypeChange(select, index) {
                const optionsBlock = document.getElementById(`options-block-${index}`);
                if (select.value === 'mcq') {
                    optionsBlock.classList.remove('hidden');
                    optionsBlock.querySelectorAll('input').forEach(i => i.required = true);
                } else {
                    optionsBlock.classList.add('hidden');
                    optionsBlock.querySelectorAll('input').forEach(i => i.required = false);
                }
            }

            function addOption(qIndex) {
                const container = document.getElementById(`options-container-${qIndex}`);
                const rowsCount = container.children.length;
                const row = document.createElement('div');
                row.className = 'flex items-center gap-2 option-row';
                row.innerHTML = `
                    <span class="text-xs text-slate-500 font-mono">${rowsCount + 1}.</span>
                    <input type="text" name="questions[${qIndex}][options][]" required placeholder="Option Choice" class="bg-slate-900/60 border border-slate-850 rounded-xl py-1 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition flex-grow">
                    <button type="button" onclick="removeOption(this)" class="text-slate-500 hover:text-red-400 font-bold text-xs cursor-pointer">&times;</button>
                `;
                container.appendChild(row);
            }

            function removeOption(btn) {
                const row = btn.parentElement;
                const container = row.parentElement;
                if (container.children.length > 1) {
                    row.remove();
                    Array.from(container.children).forEach((child, idx) => {
                        child.querySelector('span').textContent = `${idx + 1}.`;
                    });
                }
            }

            function updateTotalPoints() {
                let sum = 0;
                document.querySelectorAll('.points-input').forEach(input => {
                    sum += parseInt(input.value || 0);
                });
                document.getElementById('builder-total-marks').textContent = sum;
            }

            // Grading Modal Actions
            function handleGradingButtonClick(btn) {
                const modal = document.getElementById('grading-modal');
                const form = document.getElementById('grading-form');
                
                const submissionId = btn.getAttribute('data-id');
                const studentName = btn.getAttribute('data-student');
                const taskTitle = btn.getAttribute('data-task-title');
                const maxPoints = btn.getAttribute('data-max-points');
                const currentScore = btn.getAttribute('data-score');
                const currentFeedback = btn.getAttribute('data-feedback');
                const isTest = parseInt(btn.getAttribute('data-is-test'));
                const questions = JSON.parse(btn.getAttribute('data-questions') || '[]');
                const answers = JSON.parse(btn.getAttribute('data-answers') || '{}');
                const uploadedFile = btn.getAttribute('data-file');

                form.action = `/teacher/submissions/${submissionId}/evaluate`;
                
                document.getElementById('grading-student').textContent = studentName;
                document.getElementById('grading-task-title').textContent = taskTitle;
                document.getElementById('grading-max-points').textContent = maxPoints;
                document.getElementById('grading-feedback').value = currentFeedback;

                // Handle Khata Image file block
                const khataBlock = document.getElementById('grading-khata-block');
                const khataImg = document.getElementById('grading-khata-img');
                const khataLink = document.getElementById('grading-khata-link');
                if (uploadedFile) {
                    khataImg.src = uploadedFile;
                    khataLink.href = uploadedFile;
                    khataBlock.classList.remove('hidden');
                } else {
                    khataImg.src = '';
                    khataLink.href = '#';
                    khataBlock.classList.add('hidden');
                }

                const standardBlock = document.getElementById('grading-standard-block');
                const testBlock = document.getElementById('grading-test-questions-block');
                
                if (isTest) {
                    standardBlock.classList.add('hidden');
                    testBlock.classList.remove('hidden');
                    document.getElementById('grading-score').required = false;

                    document.getElementById('grading-test-max-marks').textContent = maxPoints;
                    
                    const qListContainer = document.getElementById('grading-questions-list');
                    qListContainer.innerHTML = '';
                    
                    const questionGrades = answers.question_grades || {};
                    
                    questions.forEach((q, idx) => {
                        const questionId = q.id;
                        const studentAnswer = answers[questionId] || 'No Answer.';
                        const scoreVal = questionGrades[questionId] !== undefined ? questionGrades[questionId] : '';
                        
                        const qRow = document.createElement('div');
                        qRow.className = 'py-3 space-y-2';
                        
                        let answerSnippet = '';
                        if (q.type === 'mcq') {
                            answerSnippet = `
                                <div class="text-[10px] text-slate-400 bg-slate-900/50 rounded px-2.5 py-1 inline-block border border-slate-800">
                                    Student Answer: <strong class="text-indigo-400">${studentAnswer}</strong>
                                </div>
                            `;
                        } else if (q.type === 'written') {
                            answerSnippet = `
                                <div class="bg-slate-950/30 border border-slate-900 p-2.5 rounded-xl text-[11px] text-slate-300 leading-relaxed font-mono">
                                    ${studentAnswer}
                                </div>
                            `;
                        } else if (q.type === 'file') {
                            answerSnippet = `
                                <div class="text-[10px] text-slate-400 italic">
                                    Answers submitted via Khata file. (Check the Khata preview panel below)
                                </div>
                            `;
                        }

                        qRow.innerHTML = `
                            <div class="flex justify-between items-start">
                                <div class="max-w-[85%]">
                                    <span class="text-[10px] uppercase font-bold text-slate-500">Q${idx + 1} (${q.type.toUpperCase()})</span>
                                    <div class="text-xs font-bold text-slate-200 mt-0.5">${q.question_text}</div>
                                </div>
                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    <input type="number" name="question_scores[${questionId}]" value="${scoreVal}" required min="0" max="${q.points}" oninput="calculateGradingTotal()" class="question-grade-input w-16 bg-slate-900/60 border border-slate-800 rounded-xl py-1 px-2 text-xs font-bold text-slate-200 text-center outline-none focus:border-purple-500 transition">
                                    <span class="text-[10px] text-slate-500">/ ${q.points}</span>
                                </div>
                            </div>
                            <div class="pt-1">
                                ${answerSnippet}
                            </div>
                        `;
                        qListContainer.appendChild(qRow);
                    });
                    
                    calculateGradingTotal();
                } else {
                    standardBlock.classList.remove('hidden');
                    testBlock.classList.add('hidden');
                    
                    const scoreInput = document.getElementById('grading-score');
                    scoreInput.required = true;
                    scoreInput.value = currentScore;
                    scoreInput.max = maxPoints;
                    
                    document.getElementById('grading-max-points-label').textContent = maxPoints;
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function calculateGradingTotal() {
                let total = 0;
                document.querySelectorAll('.question-grade-input').forEach(input => {
                    total += parseInt(input.value || 0);
                });
                document.getElementById('grading-calculated-total').textContent = total;
            }

            function closeGradingModal() {
                const modal = document.getElementById('grading-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            document.addEventListener('DOMContentLoaded', function () {
                // Initialize default tab from localStorage
                const activeTab = localStorage.getItem('teacher_active_tab') || 'courses-tab';
                switchTab(activeTab);

                // 1. COOKIE THEME MANAGEMENT
                const themeToggle = document.getElementById('theme-toggle');
                const themeName = document.getElementById('theme-name');
                
                function getCookie(name) {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                    return null;
                }

                function setCookie(name, value, days) {
                    let expires = "";
                    if (days) {
                        const date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = `${name}=${value || ""}${expires}; path=/; SameSite=Lax`;
                }

                const currentTheme = getCookie('dashboard_theme') || 'theme-space-dark';
                document.body.className = currentTheme;
                themeName.textContent = currentTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';

                themeToggle.addEventListener('click', function () {
                    const newTheme = document.body.classList.contains('theme-space-dark') 
                        ? 'theme-space-light' 
                        : 'theme-space-dark';
                    
                    document.body.classList.remove('theme-space-dark', 'theme-space-light');
                    document.body.classList.add(newTheme);
                    setCookie('dashboard_theme', newTheme, 30);
                    themeName.textContent = newTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';
                // Automatically dismiss toasts after 5 seconds
                document.querySelectorAll('.toast-item').forEach(toast => {
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-y-2');
                        setTimeout(() => toast.remove(), 500);
                    }, 5000);
                });

                // --- COURSE CATALOG DYNAMIC FETCHING & RENDERING ---
                
                // Global role configuration
                const isStudent = {{ Auth::user()->isStudent() ? 'true' : 'false' }};
                const currentUserId = {{ Auth::id() }};
                const currentUserName = @json(Auth::user()->name);

                const catalogSearchInput = document.getElementById('catalog-search');
                const catalogClassSelect = document.getElementById('catalog-class');
                const courseCatalogList = document.getElementById('course-catalog-list');

                // User specific course section selectors
                const userCoursesSection = document.getElementById('user-courses-section');
                const userCoursesTitle = document.getElementById('user-courses-title');
                const userCoursesSubtitle = document.getElementById('user-courses-subtitle');
                const userCoursesList = document.getElementById('user-courses-list');
                
                // Get CSRF Token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const toastContainer = document.getElementById('toast-container');

                // Dynamic Toast System for Teacher Dashboard
                function showToast(message, type = 'success') {
                    if (!toastContainer) return;
                    const toast = document.createElement('div');
                    toast.className = `toast-item ${type === 'success' ? 'bg-emerald-950/90 border border-emerald-500/30 text-emerald-400' : 'bg-rose-950/90 border border-rose-500/30 text-rose-400'} px-4 py-3 rounded-xl shadow-2xl flex items-center justify-between gap-3 backdrop-blur-md transition-all duration-500 opacity-0 transform translate-y-2`;
                    toast.innerHTML = `
                        <span class="text-sm font-medium">${message}</span>
                        <button onclick="this.parentElement.remove()" class="hover:text-white font-bold">&times;</button>
                    `;
                    toastContainer.appendChild(toast);
                    
                    // Trigger reflow & transition animate-in
                    setTimeout(() => {
                        toast.classList.remove('opacity-0', 'translate-y-2');
                    }, 50);
                    
                    // Automatically dismiss after 5 seconds
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-y-2');
                        setTimeout(() => toast.remove(), 500);
                    }, 5000);
                }

                // Asynchronous Function: Load Course Catalog
                async function loadCoursesData() {
                    const query = catalogSearchInput.value;
                    const classVal = catalogClassSelect.value;
                    
                    try {
                        const response = await fetch(`/api/courses?q=${encodeURIComponent(query)}&class=${encodeURIComponent(classVal)}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            renderCatalog(data.courses);
                            renderUserCourses(data.courses);
                        }
                    } catch (error) {
                        console.error('Error fetching courses:', error);
                        courseCatalogList.innerHTML = `<div class="text-center py-6 text-red-400 text-sm">Failed to connect to API server.</div>`;
                    }
                }

                // Helper: Render Course Catalog List (Full-Width Card Grid)
                function renderCatalog(courses) {
                    if (courses.length === 0) {
                        courseCatalogList.innerHTML = `
                            <div class="text-center py-12 text-slate-500 text-sm border border-dashed border-slate-800 rounded-xl col-span-full w-full">
                                No courses matching your filters.
                            </div>
                        `;
                        return;
                    }

                    let html = '';
                    courses.forEach((course, index) => {
                        let btnClass = '';
                        let btnText = '';
                        let action = '';
                        let isDisabled = '';

                        if (course.is_enrolled) {
                            if (isStudent) {
                                btnClass = 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/25 w-full justify-center cursor-not-allowed';
                                btnText = 'Enrolled';
                                action = 'none';
                                isDisabled = 'disabled';
                            } else {
                                btnClass = 'bg-rose-500/10 hover:bg-rose-500/25 text-rose-400 border border-rose-500/25 w-full justify-center';
                                btnText = 'Unenroll';
                                action = 'unenroll';
                            }
                        } else {
                            btnClass = 'bg-indigo-600 hover:bg-indigo-500 text-white shadow-md shadow-indigo-600/20 w-full justify-center';
                            btnText = 'Enroll Now';
                            action = 'enroll';
                        }

                        // Dynamic background image index (bg1 for 1st course, bg2 for 2nd...)
                        const bgIndex = (index % 5) + 1;
                        const bgUrl = course.image_path ? `/${course.image_path}` : `/images/bg${bgIndex}.jpg`;

                        // Rating calculation
                        const ratingValue = course.average_rating ? course.average_rating.toFixed(1) : '4.5';

                        html += `
                            <div class="glass-card rounded-[2rem] p-4 border border-slate-800/80 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl flex flex-col justify-between h-full group">
                                <div>
                                    <!-- Course Image Box -->
                                    <div class="relative overflow-hidden rounded-2xl aspect-[1.5] mb-4 bg-slate-955">
                                        <img src="${bgUrl}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="${course.title}">
                                        ${course.class ? `
                                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-600/90 text-white backdrop-blur-sm border border-indigo-400/20 uppercase tracking-wider">
                                                ${course.class}
                                            </span>
                                        ` : ''}
                                        ${course.subject ? `
                                            <span class="absolute top-3 right-3 px-2 py-0.5 rounded text-[9px] font-bold bg-purple-600/90 text-white backdrop-blur-sm border border-purple-400/20 uppercase tracking-wider">
                                                ${course.subject}
                                            </span>
                                        ` : ''}
                                    </div>

                                    <!-- Provider / Instructor info -->
                                    <div class="flex items-center gap-1.5 mb-2">
                                        <div class="w-4 h-4 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center border border-slate-700/50">
                                            <span class="text-[9px] font-bold uppercase">${course.instructor.charAt(0)}</span>
                                        </div>
                                        <span class="text-[10px] text-slate-400 font-medium truncate">${course.instructor}</span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-sm font-bold text-white mb-2 leading-snug line-clamp-2 min-h-[40px] group-hover:text-indigo-400 transition-colors">
                                        ${course.title}
                                    </h3>
                                </div>

                                <!-- Footer details -->
                                <div class="mt-4 pt-3 border-t border-slate-800/40">
                                    <div class="flex items-center justify-between mb-4">
                                        <!-- Price -->
                                        <span class="text-xs text-slate-200 font-extrabold">
                                            ${course.enrollment_fee == 0 ? 'Free' : '৳' + course.enrollment_fee}
                                        </span>
                                        <!-- Rating -->
                                        <div class="flex items-center gap-1 text-xs font-bold text-amber-400">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span>${ratingValue}</span>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <button data-course-id="${course.id}" data-action="${action}" data-enrollment-fee="${course.enrollment_fee || 0}" ${isDisabled} class="enroll-action-btn flex items-center px-4 py-2 rounded-xl text-xs font-bold tracking-wide transition cursor-pointer ${btnClass}">
                                        ${btnText}
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                    
                    courseCatalogList.innerHTML = html;

                    // Bind action listeners to newly created catalog buttons
                    document.querySelectorAll('.enroll-action-btn').forEach(btn => {
                        btn.addEventListener('click', handleEnrollAction);
                    });
                }

                // Helper: Render User-Specific Courses Grid (Offered/Enrolled)
                function renderUserCourses(courses) {
                    let filtered = [];
                    if (isStudent) {
                        filtered = courses.filter(c => c.is_enrolled);
                        userCoursesTitle.textContent = 'Enrolled Courses';
                        userCoursesSubtitle.textContent = 'Courses you are currently participating in';
                    } else {
                        filtered = courses.filter(c => c.instructor_id == currentUserId || c.instructor === currentUserName);
                        userCoursesTitle.textContent = 'Offered Courses';
                        userCoursesSubtitle.textContent = 'Courses you are currently instructing';
                    }

                    if (filtered.length === 0) {
                        userCoursesSection.classList.add('hidden');
                        return;
                    }

                    userCoursesSection.classList.remove('hidden');

                    let html = '';
                    filtered.forEach((course, index) => {
                        const bgIndex = (index % 5) + 1;
                        const bgUrl = course.image_path ? `/${course.image_path}` : `/images/bg${bgIndex}.jpg`;

                        const ratingValue = course.average_rating ? course.average_rating.toFixed(1) : '4.5';

                        const btnText = isStudent ? 'Go to Workspace ↗' : 'Manage Course ↗';
                        const btnLink = `/course/${course.id}`;
                        const btnClass = 'bg-indigo-500/10 hover:bg-indigo-500/25 text-indigo-400 border border-indigo-500/25 w-full justify-center py-2 rounded-xl text-xs font-bold transition flex items-center cursor-pointer';

                        html += `
                            <div class="glass-card rounded-[2rem] p-4 border border-slate-800/80 transition-all duration-300 hover:scale-[1.02] hover:shadow-xl flex flex-col justify-between h-full group">
                                <div>
                                    <!-- Course Image Box -->
                                    <div class="relative overflow-hidden rounded-2xl aspect-[1.5] mb-4 bg-slate-955">
                                        <img src="${bgUrl}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="${course.title}">
                                        ${course.class ? `
                                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-600/90 text-white backdrop-blur-sm border border-indigo-400/20 uppercase tracking-wider">
                                                ${course.class}
                                            </span>
                                        ` : ''}
                                        ${course.subject ? `
                                            <span class="absolute top-3 right-3 px-2 py-0.5 rounded text-[9px] font-bold bg-purple-600/90 text-white backdrop-blur-sm border border-purple-400/20 uppercase tracking-wider">
                                                ${course.subject}
                                            </span>
                                        ` : ''}
                                    </div>

                                    <!-- Provider / Instructor info -->
                                    <div class="flex items-center gap-1.5 mb-2">
                                        <div class="w-4 h-4 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center border border-slate-700/50">
                                            <span class="text-[9px] font-bold uppercase">${course.instructor.charAt(0)}</span>
                                        </div>
                                        <span class="text-[10px] text-slate-400 font-medium truncate">${course.instructor}</span>
                                    </div>

                                    <!-- Title -->
                                    <h3 class="text-sm font-bold text-white mb-2 leading-snug line-clamp-2 min-h-[40px] group-hover:text-indigo-400 transition-colors">
                                        ${course.title}
                                    </h3>
                                </div>

                                <!-- Footer details -->
                                <div class="mt-4 pt-3 border-t border-slate-800/40">
                                    <div class="flex items-center justify-between mb-4">
                                        <!-- Price -->
                                        <span class="text-xs text-slate-200 font-extrabold">
                                            ${course.enrollment_fee == 0 ? 'Free' : '৳' + course.enrollment_fee}
                                        </span>
                                        <!-- Rating -->
                                        <div class="flex items-center gap-1 text-xs font-bold text-amber-400">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span>${ratingValue}</span>
                                        </div>
                                    </div>

                                    <!-- Link Button -->
                                    <a href="${btnLink}" class="${btnClass}">
                                        ${btnText}
                                    </a>
                                </div>
                            </div>
                        `;
                    });

                    userCoursesList.innerHTML = html;
                }

                // Action Handler: Handle Course Enrollment/Unenrollment (AJAX Post)
                async function handleEnrollAction(e) {
                    const btn = e.currentTarget;
                    const courseId = btn.getAttribute('data-course-id');
                    const action = btn.getAttribute('data-action');
                    const fee = parseInt(btn.getAttribute('data-enrollment-fee') || '0');
                    
                    if (action === 'enroll' && fee > 0) {
                        window.location.href = `/course/${courseId}/payment`;
                        return;
                    }
                    
                    btn.disabled = true;
                    btn.textContent = action === 'enroll' ? 'Enrolling...' : 'Unenrolling...';

                    try {
                        const response = await fetch(`/api/courses/${courseId}/${action}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });

                        const data = await response.json();
                        
                        const msg = data.message || 'Course updated successfully.';
                        showToast(msg, response.ok && data.success ? 'success' : 'error');
                    } catch (error) {
                        console.error('Enroll/Unenroll request failed:', error);
                    } finally {
                        await loadCoursesData();
                    }
                }

                // Search Debounce implementation
                let searchTimeout = null;
                catalogSearchInput.addEventListener('input', () => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        loadCoursesData();
                    }, 300);
                });

                // Class Select Change Event
                catalogClassSelect.addEventListener('change', loadCoursesData);

                // Initial fetch
                loadCoursesData();
            });

            // Modal Toggling Functions
            function toggleNotificationsModal() {
                const modal = document.getElementById('notifications-modal');
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                } else {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }

            function toggleProfileModal() {
                const modal = document.getElementById('profile-modal');
                if (modal.classList.contains('hidden')) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                } else {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            }

            // Open Profile modal automatically if validation errors exist
            @if ($errors->any())
                toggleProfileModal();
            @endif
        </script>

        <!-- Notifications Modal (Glassmorphic) -->
        <div id="notifications-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/30 backdrop-blur-sm">
            <div class="glass-panel w-full max-w-lg rounded-2xl p-6 shadow-2xl border border-slate-700/50 flex flex-col max-h-[85vh]">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-4 mb-4">
                    <h3 class="text-xl font-bold tracking-tight bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent flex items-center gap-2">
                        🔔 Activity Notifications
                    </h3>
                    <button onclick="toggleNotificationsModal()" class="text-slate-400 hover:text-white text-2xl font-bold transition cursor-pointer">&times;</button>
                </div>
                
                <!-- Modal Body (Scrollable) -->
                <div class="flex-grow overflow-y-auto space-y-3 pr-2 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
                    @php
                        $userActivities = Auth::user()->activities;
                    @endphp
                    @if(!$userActivities || $userActivities->isEmpty())
                        <div class="text-center py-12 text-slate-400">
                            <span class="text-4xl block mb-2">📭</span>
                            <p class="text-sm font-medium">No recent activities found.</p>
                            <p class="text-xs text-slate-500 mt-1">Your actions will be logged here.</p>
                        </div>
                    @else
                        @foreach($userActivities as $act)
                            <div class="p-3.5 rounded-xl bg-slate-900/40 border border-slate-800/80 hover:border-purple-500/30 transition flex flex-col gap-1">
                                <p class="text-sm font-medium text-slate-200 leading-relaxed">{{ $act->description }}</p>
                                <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1">
                                    <span class="font-semibold px-2 py-0.5 rounded-full bg-slate-800 text-slate-300 uppercase tracking-wider text-[9px]">{{ str_replace('_', ' ', $act->type) }}</span>
                                    <span>{{ $act->created_at->setTimezone('Asia/Dhaka')->format('M d, Y h:i A') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Modal (Glassmorphic) -->
        <div id="profile-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/30 backdrop-blur-sm">
            <div class="glass-panel w-full max-w-lg rounded-2xl p-6 shadow-2xl border border-slate-700/50 flex flex-col max-h-[90vh]">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-4 mb-4">
                    <h3 class="text-xl font-bold tracking-tight bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent flex items-center gap-2">
                        👤 My Profile Info
                    </h3>
                    <button onclick="toggleProfileModal()" class="text-slate-400 hover:text-white text-2xl font-bold transition cursor-pointer">&times;</button>
                </div>
                
                <!-- Modal Body (Form) -->
                <form action="{{ route('profile.update') }}" method="POST" class="flex-grow overflow-y-auto space-y-4 pr-1">
                    @csrf
                    
                    <!-- Display Errors inside modal if validation fails -->
                    @if($errors->any())
                        <div class="bg-rose-950/60 border border-rose-500/40 text-rose-300 p-3 rounded-xl text-xs space-y-1">
                            <strong>Validation failed:</strong>
                            <ul class="list-disc pl-4 space-y-0.5">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Name Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-purple-500/50 transition">
                    </div>

                    <!-- Username Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-purple-500/50 transition">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-purple-500/50 transition">
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-purple-500/50 transition" placeholder="e.g. +8801700000000">
                    </div>

                    <!-- Password Fields (Optional) -->
                    <div class="border-t border-slate-800/80 pt-3">
                        <label class="block text-xs font-bold text-purple-400 uppercase tracking-wider mb-2">Change Password (Optional)</label>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">New Password</label>
                                <input type="password" name="password" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-3 py-1.5 text-sm text-white focus:outline-none focus:border-purple-500/50 transition">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-3 py-1.5 text-sm text-white focus:outline-none focus:border-purple-500/50 transition">
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Must be at least 6 characters with an uppercase letter, lowercase letter, number, and special character.</p>
                    </div>

                    <!-- Save Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-grow bg-purple-600 hover:bg-purple-500 text-white font-bold py-2.5 px-4 rounded-xl text-sm transition cursor-pointer text-center">
                            Save Changes
                        </button>
                        <button type="button" onclick="toggleProfileModal()" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2.5 px-4 rounded-xl text-sm transition cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
