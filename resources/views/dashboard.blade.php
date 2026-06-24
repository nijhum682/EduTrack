<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard - EduTrack</title>

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

        <!-- Custom Style System: Styling (CSS) -->
        <style>
            /* 1. Theme configuration (Read and applied via JS cookie) */
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
            
            /* Space Light Theme Specific Element Overrides */
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
                color: #1e293b !important;
            }
            body.theme-space-light .text-slate-300 {
                color: #334155 !important;
            }
            body.theme-space-light .text-slate-400 {
                color: #475569 !important;
            }
            body.theme-space-light .text-slate-500 {
                color: #64748b !important;
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
            body.theme-space-light select {
                background: rgba(255, 255, 255, 0.75) !important;
                border-color: rgba(15, 23, 42, 0.12) !important;
                color: #0f172a !important;
            }
            body.theme-space-light input::placeholder {
                color: #94a3b8 !important;
            }
            body.theme-space-light .border-slate-800\/80,
            body.theme-space-light .border-slate-800,
            body.theme-space-light .border-slate-700\/50,
            body.theme-space-light .border-slate-700 {
                border-color: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light #theme-toggle,
            body.theme-space-light form button[type="submit"] {
                background: rgba(255, 255, 255, 0.6) !important;
                border-color: rgba(15, 23, 42, 0.1) !important;
                color: #334155 !important;
            }
            body.theme-space-light #theme-toggle:hover,
            body.theme-space-light form button[type="submit"]:hover {
                background: rgba(15, 23, 42, 0.05) !important;
                color: #0f172a !important;
            }
            body.theme-space-light .bg-slate-950\/30 {
                background-color: rgba(255, 255, 255, 0.4) !important;
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
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(168, 85, 247, 0.12) 100%) !important;
                border-color: rgba(99, 102, 241, 0.18) !important;
            }
            body.theme-space-light .welcome-banner h1 {
                color: #1e1b4b !important;
            }
            body.theme-space-light .welcome-banner p {
                color: #4f46e5 !important;
            }
            body.theme-space-light .welcome-banner span.inline-block {
                background-color: #4f46e5 !important;
                color: #ffffff !important;
            }
            body.theme-space-light .middleware-box {
                background: rgba(255, 255, 255, 0.65) !important;
                border-color: rgba(99, 102, 241, 0.18) !important;
                box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03) !important;
            }
            body.theme-space-light .middleware-box span {
                color: #475569 !important;
            }
            body.theme-space-light .middleware-box .text-indigo-400 {
                color: #4f46e5 !important;
            }
            body.theme-space-light .middleware-box #session-activity-time,
            body.theme-space-light .middleware-box #cookie-activity-time {
                color: #0f172a !important;
                font-weight: 700 !important;
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
                border-color: rgba(99, 102, 241, 0.25);
                transform: translateY(-2px);
                box-shadow: 0 12px 20px -10px rgba(0, 0, 0, 0.5);
            }
            
            /* Micro-animations and transitions */
            .transition-all-300 {
                transition: all 0.3s ease-in-out;
            }
            
            /* Customized scrollbar for dashboard lists */
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
                background: rgba(99, 102, 241, 0.4);
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
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">EduTrack</span>
                </a>

                <!-- Theme Switcher & User Details -->
                <div class="flex items-center gap-3">
                    <!-- Theme Switcher Button (Stores cookie 'dashboard_theme') -->
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

        <!-- Main Workspace Container -->
        <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Toast notification messages (Fades out via Javascript) -->
            <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2 max-w-sm w-full">
                @if (session('success'))
                    <div class="toast-item bg-emerald-950/90 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl shadow-2xl flex items-center justify-between gap-3 backdrop-blur-md transition-all duration-500">
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white font-bold">&times;</button>
                    </div>
                @endif
            </div>

            <!-- Welcome card and session/cookie metrics -->
            <div class="welcome-banner bg-gradient-to-r from-indigo-900/30 to-purple-900/30 border border-indigo-500/20 rounded-2xl p-6 mb-8 shadow-xl backdrop-blur-md relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <span class="inline-block bg-indigo-500/20 text-indigo-300 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3">Academic Workspace</span>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Welcome to EduTrack, {{ Auth::user()->name }}!</h1>
                        <p class="text-slate-300 mt-1 leading-relaxed text-sm">
                            Manage your course enrollments, complete your assignments, and view your academic performance metrics in real-time.
                        </p>
                    </div>
                    <!-- Middleware Activity Tracking indicators -->
                    <div class="middleware-box bg-slate-950/40 border border-slate-800/80 rounded-xl p-4 min-w-[240px] text-xs space-y-2 backdrop-blur-sm">
                        <div class="text-indigo-400 font-bold uppercase tracking-wider text-[10px]">Activity Trackers (Middleware)</div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Session Last Activity:</span>
                            <!-- Server-side Session reading -->
                            <span class="text-slate-200 font-mono" id="session-activity-time">{{ \Carbon\Carbon::parse(session('last_activity'))->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between border-t border-slate-800/50 pt-2">
                            <span class="text-slate-400">Cookie Active Time:</span>
                            <!-- Client-side Cookie reading -->
                            <span class="text-slate-200 font-mono" id="cookie-activity-time">Reading cookie...</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-indigo-600/10 rounded-full blur-3xl -z-1"></div>
            </div>

            <!-- Dashboard Statistics Cards (Values populated dynamically via API Controller) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Stat 1: Active Courses -->
                <div class="glass-panel rounded-2xl p-6 shadow-md border border-slate-800/80 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Active Courses</span>
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-white" id="stat-active-courses">-</div>
                    <p class="text-slate-500 text-[10px] mt-1" id="stat-active-courses-sub">Loading stats...</p>
                </div>

                <!-- Stat 2: Total Credits -->
                <div class="glass-panel rounded-2xl p-6 shadow-md border border-slate-800/80 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total Credits</span>
                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-white" id="stat-total-credits">-</div>
                    <p class="text-slate-500 text-[10px] mt-1" id="stat-total-credits-sub">Enrolled hours</p>
                </div>

                <!-- Stat 3: Completed Tasks -->
                <div class="glass-panel rounded-2xl p-6 shadow-md border border-slate-800/80 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Completed Tasks</span>
                        <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-white" id="stat-task-percentage">-%</div>
                    <div class="w-full bg-slate-800 rounded-full h-1.5 mt-2">
                        <div id="stat-task-progress-bar" class="bg-gradient-to-r from-pink-500 to-purple-500 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                    </div>
                    <p class="text-slate-500 text-[10px] mt-2" id="stat-task-count">0 of 0 assignments</p>
                </div>

                <!-- Stat 4: Overall Grade -->
                <div class="glass-panel rounded-2xl p-6 shadow-md border border-slate-800/80 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Overall Grade</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-emerald-400" id="stat-overall-grade">-</div>
                    <p class="text-slate-500 text-[10px] mt-1" id="stat-overall-grade-sub">Based on completed tasks</p>
                </div>
            </div>

            <!-- Search, Filter & Workspace layout grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- LEFT COLUMN: Course Catalog (8 cols) -->
                <section class="lg:col-span-7 space-y-6">
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <!-- Heading -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                            <div>
                                <h2 class="text-lg font-bold text-white">Available Course Catalog</h2>
                                <p class="text-xs text-slate-400">Search and filter courses in real-time (MySQL CRUD Read)</p>
                            </div>
                        </div>

                        <!-- SEARCH AND FILTER CONTROLS (Interact with API Controller using JavaScript) -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <!-- Search query (JavaScript: input event) -->
                            <div class="sm:col-span-2 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="catalog-search" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 pl-9 pr-4 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-indigo-500/80 focus:ring-1 focus:ring-indigo-500/30 transition" placeholder="Search by title or course code...">
                            </div>
                            <!-- Credit filter (JavaScript: change event) -->
                            <div>
                                <select id="catalog-credits" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 focus:outline-none focus:border-indigo-500/80 focus:ring-1 focus:ring-indigo-500/30 transition cursor-pointer">
                                    <option value="">All Credits</option>
                                    <option value="3">3 Credits</option>
                                    <option value="4">4 Credits</option>
                                </select>
                            </div>
                        </div>

                        <!-- Course Catalog List (Asynchronously rendered by Javascript) -->
                        <div id="course-catalog-list" class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                            <!-- Skeleton loader while fetching -->
                            <div class="text-center py-12 text-slate-500 text-sm">
                                Loading course catalog...
                            </div>
                        </div>
                    </div>
                </section>

                <!-- RIGHT COLUMN: Enrolled Courses & Task Board (5 cols) -->
                <section class="lg:col-span-5 space-y-6">
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-white">My Workspace</h2>
                            <p class="text-xs text-slate-400">Track tasks for enrolled courses</p>
                        </div>

                        <!-- Enrolled Tasks & Course Completion Progress (Asynchronously managed by JS) -->
                        <div id="workspace-container" class="space-y-6 max-h-[570px] overflow-y-auto pr-2">
                            <!-- Populated dynamically via JS -->
                            <div class="text-center py-12 text-slate-500 text-sm">
                                Enroll in courses to start tracking tasks!
                            </div>
                        </div>
                    </div>

                    <!-- Live & Scheduled Classes Widget -->
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg mt-6">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-white">Live & Scheduled Classes</h2>
                            <p class="text-xs text-slate-400">Join virtual classes hosted by instructors</p>
                        </div>

                        @php
                            $enrolledCourseIds = Auth::user()->courses->pluck('id');
                            $studentClasses = \App\Models\ScheduledClass::whereIn('course_id', $enrolledCourseIds)
                                ->with('course')
                                ->orderBy('scheduled_at', 'asc')
                                ->get();
                        @endphp

                        <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                            @if($studentClasses->count() === 0)
                                <div class="text-center py-8 text-slate-500 text-xs italic">
                                    No classes scheduled for your enrolled courses.
                                </div>
                            @else
                                @foreach($studentClasses as $class)
                                    <div class="border {{ $class->is_active ? 'border-pink-500/40 bg-pink-950/5' : 'border-slate-800/60 bg-slate-900/10' }} rounded-xl p-3 flex flex-col gap-2 transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[9px] uppercase font-extrabold px-1.5 py-0.5 rounded bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                                {{ $class->course->code }}
                                            </span>
                                            @if($class->is_active)
                                                <span class="inline-flex items-center gap-1 text-[8px] uppercase font-bold text-pink-400 bg-pink-500/10 px-2 py-0.5 rounded-full border border-pink-500/30">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-ping"></span> Live Now
                                                </span>
                                            @else
                                                <span class="text-[9px] text-slate-500">{{ $class->scheduled_at->diffForHumans() }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs text-white">{{ $class->title }}</div>
                                            <div class="text-[9px] text-slate-500 mt-0.5">Instructor: {{ $class->course->instructor }}</div>
                                            <div class="text-[9px] text-slate-500">Platform: <strong>{{ $class->platform }}</strong></div>
                                        </div>
                                        <div class="flex items-center justify-between border-t border-slate-800/40 pt-2 mt-1">
                                            <span class="text-[9px] text-slate-500">{{ $class->scheduled_at->format('M d, H:i') }} &middot; {{ $class->duration_minutes }}m</span>
                                            @if($class->is_active)
                                                @if($class->platform === 'In-App Classroom')
                                                    <a href="{{ route('classroom', $class->id) }}" class="text-[10px] bg-pink-600 hover:bg-pink-500 text-white font-bold py-1 px-2.5 rounded-lg border border-pink-500/20 transition cursor-pointer shadow-md shadow-pink-600/10">
                                                        💻 Join Live Room
                                                    </a>
                                                @elseif($class->meeting_link)
                                                    <a href="{{ $class->meeting_link }}" target="_blank" class="text-[10px] bg-slate-850 hover:bg-slate-800 text-slate-200 font-bold py-1 px-2.5 rounded-lg border border-slate-700/60 transition cursor-pointer">
                                                        🔗 Join Meeting
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-[9px] text-slate-500 italic">Not started yet</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>

            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-950/40 py-6 text-center text-xs text-slate-500">
            <p>&copy; 2026 EduTrack Smart Learning. Handcrafted with modern web architecture (Vite, Laravel, MySQL, AJAX).</p>
        </footer>

        <!-- Javascript AJAX & Frontend Logic: Javascript -->
        <script>
            // Document Ready configuration
            document.addEventListener('DOMContentLoaded', function () {
                
                // 1. COOKIE THEME MANAGEMENT
                const themeToggle = document.getElementById('theme-toggle');
                const themeName = document.getElementById('theme-name');
                
                // Function to retrieve a cookie value by name
                function getCookie(name) {
                    const value = `; ${document.cookie}`;
                    const parts = value.split(`; ${name}=`);
                    if (parts.length === 2) return parts.pop().split(';').shift();
                    return null;
                }

                // Function to set a cookie
                function setCookie(name, value, days) {
                    let expires = "";
                    if (days) {
                        const date = new Date();
                        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                        expires = "; expires=" + date.toUTCString();
                    }
                    document.cookie = `${name}=${value || ""}${expires}; path=/; SameSite=Lax`;
                }

                // Initial load: Apply saved cookie theme preference
                const currentTheme = getCookie('dashboard_theme') || 'theme-space-dark';
                document.body.className = currentTheme;
                themeName.textContent = currentTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';

                // Toggle Theme Handler
                themeToggle.addEventListener('click', function () {
                    const newTheme = document.body.classList.contains('theme-space-dark') 
                        ? 'theme-space-light' 
                        : 'theme-space-dark';
                    
                    document.body.className = newTheme;
                    setCookie('dashboard_theme', newTheme, 30); // Save cookie for 30 days
                    themeName.textContent = newTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';
                });

                // Display cookie value on screen (Unencrypted cookie tracking)
                const cookieActivitySpan = document.getElementById('cookie-activity-time');
                function refreshCookieTimeDisplay() {
                    const cookieVal = getCookie('user_last_active_time');
                    if (cookieVal) {
                        cookieActivitySpan.textContent = cookieVal.split(' ')[1] || cookieVal; // Show HH:MM:SS
                    } else {
                        cookieActivitySpan.textContent = 'None';
                    }
                }
                refreshCookieTimeDisplay();
                // Refresh cookie value check every 10 seconds
                setInterval(refreshCookieTimeDisplay, 10000);


                // 2. TOAST ALERTS SYSTEM
                const toastContainer = document.getElementById('toast-container');
                function showToast(message, type = 'success') {
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

                // Dismiss any pre-rendered toasts on load after 5 seconds
                document.querySelectorAll('.toast-item').forEach(toast => {
                    setTimeout(() => {
                        toast.classList.add('opacity-0', 'translate-y-2');
                        setTimeout(() => toast.remove(), 500);
                    }, 5000);
                });


                // 3. API RETRIEVAL, CRUD AND DYNAMIC UPDATES
                const catalogSearchInput = document.getElementById('catalog-search');
                const catalogCreditsSelect = document.getElementById('catalog-credits');
                const courseCatalogList = document.getElementById('course-catalog-list');
                const workspaceContainer = document.getElementById('workspace-container');

                // Cache elements for stats
                const statActiveCourses = document.getElementById('stat-active-courses');
                const statActiveCoursesSub = document.getElementById('stat-active-courses-sub');
                const statTotalCredits = document.getElementById('stat-total-credits');
                const statTaskPercentage = document.getElementById('stat-task-percentage');
                const statTaskProgressBar = document.getElementById('stat-task-progress-bar');
                const statTaskCount = document.getElementById('stat-task-count');
                const statOverallGrade = document.getElementById('stat-overall-grade');

                // Get CSRF Token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Asynchronous Function: Fetch and update Stats
                async function loadStats() {
                    try {
                        const response = await fetch('/api/user/stats');
                        const data = await response.json();
                        if (data.success) {
                            const stats = data.stats;
                            
                            // Update statistics values
                            statActiveCourses.textContent = stats.active_courses;
                            statActiveCoursesSub.textContent = stats.active_courses > 0 
                                ? `${stats.active_courses} active program(s)`
                                : 'No courses joined yet';
                            
                            statTotalCredits.textContent = stats.total_credits;
                            
                            statTaskPercentage.textContent = `${stats.completion_percentage}%`;
                            statTaskProgressBar.style.width = `${stats.completion_percentage}%`;
                            statTaskCount.textContent = `${stats.completed_tasks_count} of ${stats.total_tasks_count} completed`;

                            statOverallGrade.textContent = stats.overall_grade;
                            if (stats.overall_grade === 'N/A') {
                                statOverallGrade.className = 'text-3xl font-extrabold text-slate-500';
                            } else if (stats.overall_grade === 'A+' || stats.overall_grade === 'A') {
                                statOverallGrade.className = 'text-3xl font-extrabold text-emerald-400';
                            } else {
                                statOverallGrade.className = 'text-3xl font-extrabold text-indigo-400';
                            }
                        }
                    } catch (error) {
                        console.error('Failed to load user stats:', error);
                    }
                }

                // Asynchronous Function: Load Course Catalog & Workspace Courses
                async function loadCoursesData() {
                    const query = catalogSearchInput.value;
                    const credits = catalogCreditsSelect.value;
                    
                    try {
                        // Retrieve filtered list from API
                        const response = await fetch(`/api/courses?q=${encodeURIComponent(query)}&credits=${encodeURIComponent(credits)}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            renderCatalog(data.courses);
                            renderWorkspace(data.courses.filter(c => c.is_enrolled));
                        }
                    } catch (error) {
                        console.error('Error fetching courses:', error);
                        courseCatalogList.innerHTML = `<div class="text-center py-6 text-red-400 text-sm">Failed to connect to API server.</div>`;
                    }
                }

                // Helper: Render Course Catalog List (Left Column)
                function renderCatalog(courses) {
                    if (courses.length === 0) {
                        courseCatalogList.innerHTML = `
                            <div class="text-center py-12 text-slate-500 text-sm border border-dashed border-slate-800 rounded-xl">
                                No courses matching your filters.
                            </div>
                        `;
                        return;
                    }

                    let html = '';
                    courses.forEach(course => {
                        const btnClass = course.is_enrolled 
                            ? 'bg-rose-500/10 hover:bg-rose-500/25 text-rose-400 border border-rose-500/25' 
                            : 'bg-indigo-600 hover:bg-indigo-500 text-white shadow-md shadow-indigo-600/20';
                        const btnText = course.is_enrolled ? 'Unenroll' : 'Enroll Now';
                        const action = course.is_enrolled ? 'unenroll' : 'enroll';

                        html += `
                            <div class="glass-card rounded-xl p-5 border border-slate-800/80 transition-all duration-300">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <div class="flex items-center gap-2 mb-1.5">
                                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-slate-800 text-indigo-400 border border-indigo-500/15">${course.code}</span>
                                            <span class="text-xs text-slate-400 font-medium">${course.credits} Credits</span>
                                        </div>
                                        <h3 class="text-md font-semibold text-white mb-1">${course.title}</h3>
                                        <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed mb-3">${course.description || 'No description available.'}</p>
                                        <div class="text-[11px] text-slate-500">Instructor: <span class="text-slate-300 font-medium">${course.instructor}</span></div>
                                    </div>
                                    <button data-course-id="${course.id}" data-action="${action}" class="enroll-action-btn px-4 py-2 rounded-lg text-xs font-bold tracking-wide transition cursor-pointer flex-shrink-0 ${btnClass}">
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

                // Helper: Render My Enrolled Workspace & Task Completion Lists (Right Column)
                function renderWorkspace(enrolledCourses) {
                    if (enrolledCourses.length === 0) {
                        workspaceContainer.innerHTML = `
                            <div class="text-center py-12 text-slate-500 text-sm border border-dashed border-slate-800 rounded-2xl bg-slate-900/10">
                                <svg class="w-8 h-8 mx-auto mb-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Enroll in classes on the left to display workspace assignments!
                            </div>
                        `;
                        return;
                    }

                    let html = '';
                    enrolledCourses.forEach(course => {
                        html += `
                            <div class="border border-slate-800/80 rounded-xl bg-slate-900/20 p-4 space-y-4">
                                <div class="flex items-center justify-between pb-2 border-b border-slate-800/60">
                                    <h3 class="text-xs font-extrabold uppercase tracking-wide text-indigo-400">${course.code} &middot; ${course.title}</h3>
                                    <span class="text-[10px] text-slate-500">${course.tasks.length} Assignments</span>
                                </div>
                                <div class="space-y-3">
                        `;

                        if (course.tasks.length === 0) {
                            html += `<p class="text-xs text-slate-500 italic py-1">No tasks created for this course.</p>`;
                        } else {
                            course.tasks.forEach(task => {
                                // Locate if task is completed
                                const userSub = task.submissions && task.submissions[0];
                                const isCompleted = userSub && userSub.is_completed;
                                const checkAttr = isCompleted ? 'checked' : '';
                                const lineStrike = isCompleted ? 'line-through text-slate-500' : 'text-slate-200';
                                
                                const isGraded = userSub && userSub.score !== null && userSub.score !== undefined;
                                let gradeBadge = '';
                                if (isGraded) {
                                    gradeBadge = `
                                        <div class="mt-1 flex flex-wrap gap-2 items-center">
                                            <span class="bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 px-1.5 py-0.5 rounded text-[9px] font-bold">
                                                Grade: ${userSub.score} / ${task.points} pts
                                            </span>
                                            ${userSub.feedback ? `<span class="text-[9px] text-slate-400 italic">"${userSub.feedback}"</span>` : ''}
                                        </div>
                                    `;
                                }
                                
                                let inputElement = '';
                                let actionBtn = '';
                                if (task.is_test) {
                                    if (isCompleted) {
                                        inputElement = `<span class="mt-0.5 text-xs text-indigo-400">✅</span>`;
                                    } else {
                                        inputElement = `<span class="mt-0.5 text-xs text-amber-500">⏳</span>`;
                                        actionBtn = `
                                            <div class="mt-2">
                                                <a href="/exam/${task.id}" class="bg-indigo-650 hover:bg-indigo-500 text-white font-bold py-1 px-3 rounded text-[10px] shadow shadow-indigo-650/20 active:scale-[0.98] transition cursor-pointer inline-flex items-center gap-1">
                                                    ✍ Start Google-Form Test (${task.duration_minutes} Mins)
                                                </a>
                                            </div>
                                        `;
                                    }
                                } else {
                                    inputElement = `<input type="checkbox" data-task-id="${task.id}" class="task-checkbox mt-0.5 w-4 h-4 rounded text-indigo-600 bg-slate-800 border-slate-700 focus:ring-indigo-500 focus:ring-offset-slate-950 transition cursor-pointer" ${checkAttr}>`;
                                }

                                html += `
                                    <div class="flex items-start gap-3 text-xs group">
                                        ${inputElement}
                                        <div class="flex-grow">
                                            <div class="font-medium tracking-tight task-title-label transition-colors duration-300 ${lineStrike}">
                                                ${task.title}
                                                ${task.is_test ? `<span class="bg-indigo-500/10 text-indigo-300 border border-indigo-500/25 px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase ml-2 tracking-wider">Exam</span>` : ''}
                                            </div>
                                            <p class="text-[10px] text-slate-500 mt-0.5 leading-relaxed">${task.description || 'No description.'}</p>
                                            <div class="flex gap-3 text-[9px] text-slate-500 mt-1">
                                                <span>Weight: <strong class="text-slate-400">${task.points} pts</strong></span>
                                                <span>Due: <strong class="text-slate-400">${new Date(task.due_date).toLocaleDateString()}</strong></span>
                                            </div>
                                            ${actionBtn}
                                            ${gradeBadge}
                                        </div>
                                    </div>
                                `;
                            });
                        }

                        html += `
                                </div>
                            </div>
                        `;
                    });

                    workspaceContainer.innerHTML = html;

                    // Bind change listeners to task checkboxes
                    document.querySelectorAll('.task-checkbox').forEach(box => {
                        box.addEventListener('change', handleTaskCheckboxToggle);
                    });
                }

                // Action Handler: Handle Course Enrollment/Unenrollment (AJAX Post)
                async function handleEnrollAction(e) {
                    const btn = e.currentTarget;
                    const courseId = btn.getAttribute('data-course-id');
                    const action = btn.getAttribute('data-action'); // 'enroll' or 'unenroll'
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
                        
                        if (response.ok && data.success) {
                            showToast(data.message || 'Course updated successfully.');
                        } else {
                            showToast(data.message || 'Action failed.', 'error');
                        }
                    } catch (error) {
                        console.error('Enroll/Unenroll request failed:', error);
                        showToast('Server response error.', 'error');
                    } finally {
                        // Reload statistics and courses data dynamically without refreshing
                        await loadStats();
                        await loadCoursesData();
                    }
                }

                // Action Handler: Toggle Task completion status checkbox (AJAX Post)
                async function handleTaskCheckboxToggle(e) {
                    const checkbox = e.currentTarget;
                    const taskId = checkbox.getAttribute('data-task-id');
                    const label = checkbox.nextElementSibling.querySelector('.task-title-label');
                    
                    checkbox.disabled = true;

                    try {
                        const response = await fetch(`/api/tasks/${taskId}/toggle`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });

                        const data = await response.json();
                        
                        if (response.ok && data.success) {
                            // Apply visual line strike dynamic changes on completion status
                            if (data.is_completed) {
                                label.classList.add('line-through', 'text-slate-500');
                                label.classList.remove('text-slate-200');
                                showToast('Task marked as completed.');
                            } else {
                                label.classList.remove('line-through', 'text-slate-500');
                                label.classList.add('text-slate-200');
                                showToast('Task marked as pending.');
                            }
                        } else {
                            checkbox.checked = !checkbox.checked; // Revert checkbox state
                            showToast(data.message || 'Action failed.', 'error');
                        }
                    } catch (error) {
                        console.error('Task toggle request failed:', error);
                        checkbox.checked = !checkbox.checked; // Revert checkbox state
                        showToast('Server connection error.', 'error');
                    } finally {
                        checkbox.disabled = false;
                        // Refresh stats dynamically to update Completed Tasks progress bars
                        await loadStats();
                    }
                }

                // Search Debounce implementation
                let searchTimeout = null;
                catalogSearchInput.addEventListener('input', () => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        loadCoursesData();
                    }, 300); // Wait 300ms after user stops typing
                });

                // Credit Select Change Event
                catalogCreditsSelect.addEventListener('change', loadCoursesData);


                // 4. BOOTSTRAP INITIAL DATA
                loadStats();
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
        <div id="notifications-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm">
            <div class="glass-panel w-full max-w-lg rounded-2xl p-6 shadow-2xl border border-slate-700/50 flex flex-col max-h-[85vh]">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-4 mb-4">
                    <h3 class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent flex items-center gap-2">
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
                            <div class="p-3.5 rounded-xl bg-slate-900/40 border border-slate-800/80 hover:border-indigo-500/30 transition flex flex-col gap-1">
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
        <div id="profile-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm">
            <div class="glass-panel w-full max-w-lg rounded-2xl p-6 shadow-2xl border border-slate-700/50 flex flex-col max-h-[90vh]">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-700/50 pb-4 mb-4">
                    <h3 class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent flex items-center gap-2">
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
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition">
                    </div>

                    <!-- Username Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition">
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition">
                    </div>

                    <!-- Phone Number Field -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-4 py-2 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition" placeholder="e.g. +8801700000000">
                    </div>

                    <!-- Password Fields (Optional) -->
                    <div class="border-t border-slate-800/80 pt-3">
                        <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">Change Password (Optional)</label>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">New Password</label>
                                <input type="password" name="password" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-3 py-1.5 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition">
                            </div>
                            <div>
                                <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="w-full bg-slate-950/40 border border-slate-800 rounded-xl px-3 py-1.5 text-sm text-white focus:outline-none focus:border-indigo-500/50 transition">
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1">Must be at least 6 characters with an uppercase letter, lowercase letter, number, and special character.</p>
                    </div>

                    <!-- Save Buttons -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-grow bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2.5 px-4 rounded-xl text-sm transition cursor-pointer text-center">
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
