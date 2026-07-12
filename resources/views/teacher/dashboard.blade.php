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
            body.theme-space-light .bg-slate-900\/40 {
                background-color: rgba(241, 245, 249, 0.95) !important;
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
                background: rgba(23, 31, 52, 0.75);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.12);
            }
            .glass-card {
                background: rgba(30, 41, 59, 0.6);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.08);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Dark mode text and input readability improvements */
            body.theme-space-dark input,
            body.theme-space-dark textarea,
            body.theme-space-dark select {
                background-color: rgba(15, 23, 42, 0.7) !important;
                border-color: rgba(255, 255, 255, 0.15) !important;
                color: #ffffff !important;
            }
            body.theme-space-dark input::placeholder,
            body.theme-space-dark textarea::placeholder {
                color: #94a3b8 !important;
            }
            body.theme-space-dark label {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .text-slate-400 {
                color: #cbd5e1 !important;
            }

            /* Force all full-width inputs, selects, and textareas to respect border-box width */
            input.w-full,
            select.w-full,
            textarea.w-full {
                width: 100% !important;
                box-sizing: border-box !important;
                max-width: 100% !important;
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
    <body class="theme-space-light min-h-screen text-slate-100 flex flex-col transition-colors duration-500">
        
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

                    <!-- Notifications Button -->
                    <button onclick="toggleNotificationsModal()" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer flex items-center gap-1.5" title="View Activity Notifications">
                        🔔 Notifications
                        @php
                            $notifCount = Auth::user()->activities()->where('is_read', false)->count();
                        @endphp
                        <span id="notification-badge" class="bg-indigo-500 text-white rounded-full px-1.5 py-0.5 text-[10px] font-bold @if($notifCount === 0) hidden @endif">{{ $notifCount }}</span>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
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

            <!-- Courses & Tasks (Main Content) -->
            <div class="space-y-6">
                <!-- Create Course Form (Full Width) -->
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
                                    <option value="Class 11">Class 11</option>
                                    <option value="Class 12">Class 12</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">Course Cover Image</label>
                                <input type="file" name="course_image" accept="image/*" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 outline-none focus:border-purple-500 transition cursor-pointer file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-500/10 file:text-purple-400 hover:file:bg-purple-500/20">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">Subject</label>
                                <input type="text" name="subject" required placeholder="e.g. Science, Mathematics, English" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-purple-500 transition">
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

                <!-- Course Catalog & Workspace Layout Wrapper -->
                <div class="space-y-8 mt-8">
                    
                    <!-- Full-Width Available Courses -->
                    <section>
                        <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                            <!-- Heading & Search/Filter Controls -->
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                                <div>
                                    <h2 class="text-xl font-extrabold text-white tracking-tight">Available Courses</h2>
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
                                            <option value="Class 11">Class 11</option>
                                            <option value="Class 12">Class 12</option>
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
                    </section>

                    <!-- User-Specific Courses (Offered Courses for Teachers) -->
                    <section id="user-courses-section" class="hidden">
                        <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                            <div class="mb-6">
                                <h2 id="user-courses-title" class="text-xl font-extrabold text-white tracking-tight">Offered Courses</h2>
                                <p id="user-courses-subtitle" class="text-xs text-slate-400 mt-1">Courses you are currently instructing</p>
                            </div>
                            <div id="user-courses-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                <!-- Populated dynamically via JS -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </main>



        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-950/40 py-6 text-center text-xs text-slate-500">
            <p>&copy; 2026 EduTrack</p>
        </footer>

        <!-- Scripts -->
        <script>



            document.addEventListener('DOMContentLoaded', function () {

                // 1. COOKIE THEME MANAGEMENT (Removed)

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

                    // Mark activities as read
                    fetch("{{ route('activities.read') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    }).then(res => res.json())
                      .then(data => {
                          if (data.success) {
                              const badge = document.getElementById('notification-badge');
                              if (badge) {
                                  badge.classList.add('hidden');
                                  badge.textContent = '0';
                              }
                          }
                      }).catch(err => console.error(err));
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
        <div id="notifications-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md">
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
        <div id="profile-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md">
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
