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

        <style>
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
            body.theme-space-light .text-slate-100 { color: #0f172a !important; }
            body.theme-space-light .text-slate-200 { color: #1e293b !important; }
            body.theme-space-light .text-slate-300 { color: #334155 !important; }
            body.theme-space-light .text-slate-400 { color: #475569 !important; }
            body.theme-space-light .text-slate-500 { color: #64748b !important; }
            
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
                border: 1px solid rgba(15, 23, 42, 0.06) !important;
            }
            body.theme-space-light header {
                background-color: rgba(255, 255, 255, 0.45) !important;
                border-color: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light .welcome-banner {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(168, 85, 247, 0.12) 100%) !important;
                border-color: rgba(99, 102, 241, 0.18) !important;
            }
            body.theme-space-light .welcome-banner h1 { color: #1e1b4b !important; }
            body.theme-space-light .welcome-banner p { color: #4f46e5 !important; }
            body.theme-space-light .welcome-banner span.inline-block {
                background-color: #4f46e5 !important;
                color: #ffffff !important;
            }
            
            .glass-panel {
                background: rgba(15, 23, 42, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.06);
            }
        </style>
    </head>
    <body class="theme-space-dark min-h-screen text-slate-100 pb-12 transition-colors duration-300">
        <!-- Dashboard Header -->
        <header class="fixed top-0 left-0 w-full bg-slate-950/40 backdrop-blur-md border-b border-slate-800/40 z-50 transition">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="/" class="flex items-center gap-2">
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">EduTrack</span>
                </a>
                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2 rounded-xl text-xs font-semibold border border-slate-700/50 transition cursor-pointer">
                        🎨 Theme: <span id="theme-name">Space Dark</span>
                    </button>
                    <span class="text-sm text-slate-400 hidden sm:inline-block"><strong class="text-white">{{ Auth::user()->username }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition cursor-pointer border border-slate-700/50">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28">
            <!-- Welcome banner -->
            <div class="welcome-banner bg-gradient-to-r from-indigo-900/30 to-purple-900/30 border border-indigo-500/20 rounded-2xl p-6 mb-8 shadow-xl backdrop-blur-md relative overflow-hidden">
                <div class="relative z-10">
                    <span class="inline-block bg-indigo-500/20 text-indigo-300 text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-3">Academic Workspace</span>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Welcome to EduTrack, {{ Auth::user()->name }}!</h1>
                    <p class="text-slate-300 mt-1 leading-relaxed text-sm">
                        Manage your course enrollments, complete your assignments, and view your academic performance metrics in real-time.
                    </p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="glass-panel rounded-2xl p-6 shadow-md">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Active Courses</span>
                    <div class="text-3xl font-extrabold text-white mt-4" id="stat-active-courses">0</div>
                </div>
                <div class="glass-panel rounded-2xl p-6 shadow-md">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total Credits</span>
                    <div class="text-3xl font-extrabold text-white mt-4" id="stat-total-credits">0</div>
                </div>
                <div class="glass-panel rounded-2xl p-6 shadow-md">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Completed Tasks</span>
                    <div class="text-3xl font-extrabold text-white mt-4" id="stat-task-percentage">0%</div>
                </div>
                <div class="glass-panel rounded-2xl p-6 shadow-md">
                    <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Overall Grade</span>
                    <div class="text-3xl font-extrabold text-emerald-400 mt-4" id="stat-overall-grade">N/A</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <section class="lg:col-span-7 space-y-6">
                    <div class="glass-panel rounded-2xl p-6 shadow-lg">
                        <h2 class="text-lg font-bold text-white mb-4">Available Course Catalog</h2>
                        <div id="course-catalog-list" class="space-y-4">
                            <!-- Course placeholders -->
                        </div>
                    </div>
                </section>
                <section class="lg:col-span-5 space-y-6">
                    <div class="glass-panel rounded-2xl p-6 shadow-lg">
                        <h2 class="text-lg font-bold text-white mb-4">My Workspace</h2>
                        <div id="enrolled-courses-workspace" class="space-y-6">
                            <!-- Workspace tasks placeholders -->
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <script>
            // Simple Cookie Theme Loader and Switcher
            const themeToggle = document.getElementById('theme-toggle');
            const themeName = document.getElementById('theme-name');
            
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            }

            const currentTheme = getCookie('dashboard_theme') || 'theme-space-dark';
            document.body.className = currentTheme;
            themeName.textContent = currentTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';

            themeToggle.addEventListener('click', function () {
                const newTheme = document.body.classList.contains('theme-space-dark') ? 'theme-space-light' : 'theme-space-dark';
                document.body.className = newTheme;
                document.cookie = `dashboard_theme=${newTheme}; path=/; SameSite=Lax`;
                themeName.textContent = newTheme === 'theme-space-dark' ? 'Space Dark' : 'Space Light';
            });
        </script>
    </body>
</html>
