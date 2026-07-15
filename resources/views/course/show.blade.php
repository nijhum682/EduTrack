<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $course->code }} Workspace - EduTrack</title>

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
                color: #94a3b8 !important;
            }
            body.theme-space-light .border-slate-800\/80,
            body.theme-space-light .border-slate-800,
            body.theme-space-light .border-slate-700\/50,
            body.theme-space-light .border-slate-700 {
                border-color: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light #theme-toggle {
                background: rgba(15, 23, 42, 0.05) !important;
                color: #0f172a !important;
                border-color: rgba(15, 23, 42, 0.1) !important;
            }
            body.theme-space-light #theme-toggle:hover {
                background: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light .bg-slate-950\/30 {
                background-color: rgba(15, 23, 42, 0.03) !important;
            }
            body.theme-space-light .bg-slate-900\/50 {
                background-color: rgba(15, 23, 42, 0.04) !important;
            }
            body.theme-space-light .bg-slate-800\/50 {
                background-color: rgba(15, 23, 42, 0.05) !important;
            }
            body.theme-space-light .bg-slate-950 {
                background-color: #f1f5f9 !important;
            }
            body.theme-space-light .bg-slate-900 {
                background-color: #e2e8f0 !important;
            }
            body.theme-space-light .bg-slate-800 {
                background-color: #cbd5e1 !important;
            }
            body.theme-space-light header {
                background-color: rgba(255, 255, 255, 0.5) !important;
                border-color: rgba(15, 23, 42, 0.08) !important;
            }
            body.theme-space-light .welcome-banner {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(168, 85, 247, 0.12) 100%) !important;
                border-color: rgba(99, 102, 241, 0.18) !important;
                box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.05) !important;
            }
            body.theme-space-light .welcome-banner h1 {
                color: #1e1b4b !important;
            }
            body.theme-space-light .welcome-banner p.course-desc {
                color: #475569 !important;
            }
            body.theme-space-light .welcome-banner .course-credits {
                color: #4f46e5 !important;
            }
            body.theme-space-light .welcome-banner .course-badge {
                background-color: rgba(79, 70, 229, 0.1) !important;
                color: #4f46e5 !important;
                border-color: rgba(79, 70, 229, 0.2) !important;
            }
            body.theme-space-light .instructor-card {
                background-color: rgba(255, 255, 255, 0.6) !important;
                border-color: rgba(99, 102, 241, 0.15) !important;
            }
            body.theme-space-light .instructor-card .instructor-label {
                color: #64748b !important;
            }
            body.theme-space-light .instructor-card .instructor-name {
                color: #1e1b4b !important;
            }
            body.theme-space-light .instructor-card .instructor-email {
                color: #475569 !important;
            }

            /* Keep white text visible on premium buttons in light theme */
            body.theme-space-light button,
            body.theme-space-light input[type="submit"],
            body.theme-space-light .btn-text-white,
            body.theme-space-light .status-badge,
            body.theme-space-light a.bg-indigo-600,
            body.theme-space-light a.bg-indigo-650 {
                color: #ffffff !important;
            }

            /* Tab Buttons Light mode styles */
            body.theme-space-light .tab-btn {
                color: #475569 !important;
            }
            body.theme-space-light .tab-btn:hover {
                color: #0f172a !important;
                border-color: rgba(15, 23, 42, 0.1) !important;
            }
            body.theme-space-light .tab-btn.active {
                color: #8b5cf6 !important;
                border-color: #8b5cf6 !important;
                background-color: rgba(139, 92, 246, 0.1) !important;
            }

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

            .tab-btn {
                color: #94a3b8;
                border: 1px solid transparent;
                flex-shrink: 0 !important;
                white-space: nowrap !important;
            }
            .scrollbar-none::-webkit-scrollbar {
                display: none;
            }
            .scrollbar-none {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .tab-btn:hover {
                color: #f1f5f9;
                border-color: rgba(255, 255, 255, 0.08);
            }
            .tab-btn.active {
                border-color: #8b5cf6 !important;
                color: #8b5cf6 !important;
                background-color: rgba(139, 92, 246, 0.1) !important;
            }

            /* Light theme comment overrides */
            body.theme-space-light .lecture-comment-card {
                background-color: #ffffff !important;
                border-color: #cbd5e1 !important;
                color: #0f172a !important;
            }
            body.theme-space-light .lecture-comment-card strong {
                color: #0f172a !important;
            }
            body.theme-space-light .lecture-comment-card p {
                color: #0f172a !important;
            }
            body.theme-space-light .lecture-reply-card {
                background-color: #f8fafc !important;
                border-color: #cbd5e1 !important;
                color: #334155 !important;
            }
            body.theme-space-light .lecture-reply-card strong {
                color: #1e293b !important;
            }
            body.theme-space-light .lecture-reply-card p {
                color: #334155 !important;
            }
            body.theme-space-light .lecture-comment-btn {
                color: #475569 !important;
            }
            body.theme-space-light .lecture-comment-btn:hover {
                color: #0f172a !important;
            }
            body.theme-space-light .lecture-comment-meta {
                color: #475569 !important;
            }

            /* Dark theme comment overrides */
            body.theme-space-dark .lecture-comment-card {
                background-color: #0f172a !important;
                border-color: #1e293b !important;
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .lecture-comment-card strong {
                color: #f1f5f9 !important;
            }
            body.theme-space-dark .lecture-comment-card p {
                color: #f8fafc !important;
            }
            body.theme-space-dark .lecture-reply-card {
                background-color: rgba(15, 23, 42, 0.4) !important;
                border-color: #1e293b !important;
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .lecture-reply-card strong {
                color: #f1f5f9 !important;
            }
            body.theme-space-dark .lecture-reply-card p {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .lecture-comment-btn {
                color: #94a3b8 !important;
            }
            body.theme-space-dark .lecture-comment-btn:hover {
                color: #f1f5f9 !important;
            }
            body.theme-space-dark .lecture-comment-meta {
                color: #94a3b8 !important;
            }

            /* Light theme action buttons */
            body.theme-space-light .lecture-action-btn {
                color: #475569 !important;
            }
            body.theme-space-light .lecture-action-btn:hover {
                color: #4f46e5 !important;
            }
            body.theme-space-light .lecture-action-btn.liked-active {
                color: #4f46e5 !important;
            }
            body.theme-space-light .lecture-action-btn .action-count {
                background-color: #cbd5e1 !important;
                color: #0f172a !important;
            }
            
            /* Dark theme action buttons */
            body.theme-space-dark .lecture-action-btn {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .lecture-action-btn:hover {
                color: #818cf8 !important;
            }
            body.theme-space-dark .lecture-action-btn.liked-active {
                color: #818cf8 !important;
            }
            body.theme-space-dark .lecture-action-btn .action-count {
                background-color: #1e293b !important;
                color: #f1f5f9 !important;
            }

            /* Live Class Card Text Overrides */
            body.theme-space-light .completed-live-class-card h3 {
                color: #0f172a !important;
            }
            body.theme-space-light .completed-live-class-card p,
            body.theme-space-light .completed-live-class-card p strong {
                color: #334155 !important;
            }
            body.theme-space-light .completed-live-class-card span {
                color: #475569 !important;
            }
            body.theme-space-dark .completed-live-class-card h3 {
                color: #ffffff !important;
            }
            body.theme-space-dark .completed-live-class-card p,
            body.theme-space-dark .completed-live-class-card p strong {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .completed-live-class-card span {
                color: #94a3b8 !important;
            }

            /* Recorded Lecture Card Text Overrides */
            body.theme-space-light .lecture-card h3 {
                color: #0f172a !important;
            }
            body.theme-space-light .lecture-card p {
                color: #334155 !important;
            }
            body.theme-space-light .lecture-card span {
                color: #475569 !important;
            }
            body.theme-space-dark .lecture-card h3 {
                color: #ffffff !important;
            }
            body.theme-space-dark .lecture-card p {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .lecture-card span {
                color: #94a3b8 !important;
            }

            /* Force white text on status badges regardless of theme overrides */
            body.theme-space-light span.status-badge,
            body.theme-space-dark span.status-badge,
            body.theme-space-light .completed-live-class-card span.status-badge,
            body.theme-space-light .lecture-card span.status-badge,
            span.status-badge {
                color: #ffffff !important;
            }

            /* Student Workspace Assignment and Results Overrides */
            body.theme-space-light .workspace-task-card {
                background: rgba(255, 255, 255, 0.6) !important;
                border-color: rgba(15, 23, 42, 0.08) !important;
                box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.02) !important;
            }
            body.theme-space-light .workspace-task-card h4,
            body.theme-space-light .workspace-task-card .text-slate-200,
            body.theme-space-light .workspace-task-card .text-base {
                color: #0f172a !important;
                opacity: 1 !important;
            }
            body.theme-space-light .workspace-task-card .text-slate-500,
            body.theme-space-light .workspace-task-card .text-[10px],
            body.theme-space-light .workspace-task-card span {
                color: #475569 !important;
                opacity: 0.95 !important;
            }
            body.theme-space-light .workspace-task-card .text-slate-300,
            body.theme-space-light .workspace-task-card .text-slate-400,
            body.theme-space-light .workspace-task-card strong {
                color: #334155 !important;
                opacity: 0.95 !important;
            }
            body.theme-space-light .task-feedback-box {
                background: rgba(15, 23, 42, 0.03) !important;
                border-color: rgba(15, 23, 42, 0.06) !important;
            }
            body.theme-space-light .task-feedback-box p.text-slate-300 {
                color: #1e293b !important;
                opacity: 1 !important;
            }
            body.theme-space-light .task-review-textarea {
                background: rgba(255, 255, 255, 0.9) !important;
                border-color: rgba(15, 23, 42, 0.12) !important;
                color: #0f172a !important;
            }
            body.theme-space-light .task-review-textarea::placeholder {
                color: #94a3b8 !important;
                opacity: 0.8 !important;
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
                    <span class="text-xl font-bold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">EduTrack</span>
                </a>

                <!-- Theme Switcher & User Details -->
                <div class="flex items-center gap-3">
                    <a href="{{ Auth::user()->isTeacher() ? route('teacher.dashboard') : route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-sm font-semibold transition cursor-pointer shadow-md shadow-indigo-600/20">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Workspace Container -->
        <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Toast notification messages -->
            @if(session('success'))
                <div id="toast-success" class="mb-6 p-4 rounded-xl border border-emerald-500/20 bg-emerald-500/10 text-emerald-400 text-sm flex items-center justify-between transition-all duration-300">
                    <span class="flex items-center gap-2">🟢 {{ session('success') }}</span>
                    <button onclick="document.getElementById('toast-success').remove()" class="text-emerald-400 hover:text-emerald-200 text-md font-bold">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div id="toast-error" class="mb-6 p-4 rounded-xl border border-rose-500/20 bg-rose-500/10 text-rose-400 text-sm flex items-center justify-between transition-all duration-300">
                    <span class="flex items-center gap-2">🔴 {{ session('error') }}</span>
                    <button onclick="document.getElementById('toast-error').remove()" class="text-rose-400 hover:text-rose-200 text-md font-bold">&times;</button>
                </div>
            @endif

            <!-- Course Header Card -->
            <div class="welcome-banner glass-panel rounded-3xl p-8 border border-slate-800/80 shadow-2xl relative overflow-hidden mb-8">
                <!-- Background decorative glowing circle -->
                <div class="absolute -right-16 -top-16 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                <div class="absolute -left-16 -bottom-16 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-3">
                            <span class="course-badge px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 uppercase tracking-wide">
                                {{ $course->code }}
                            </span>
                            <span class="course-credits text-xs text-slate-300 font-medium">
                                {{ $course->credits }} Credits
                            </span>
                        </div>
                        <h1 class="text-2xl md:text-4xl font-extrabold text-white tracking-tight mb-2">
                            {{ $course->title }}
                        </h1>
                        <p class="course-desc text-slate-300 text-sm max-w-2xl leading-relaxed">
                            Welcome to your course workspace. View details, syllabus lectures, shared notes, and discuss course topics.
                        </p>
                    </div>

                    <div class="instructor-card flex-shrink-0 bg-slate-950/40 border border-slate-800/60 rounded-2xl p-4 text-center md:text-right min-w-[200px]">
                        <div class="instructor-label text-[10px] text-slate-400 uppercase tracking-wider font-extrabold">Instructor</div>
                        <div class="instructor-name text-base font-bold text-white mt-1">{{ $course->instructor }}</div>
                        <div class="instructor-email text-xs text-slate-400 mt-1 italic">{{ $course->instructorUser->email ?? 'Active Faculty' }}</div>
                    </div>
                </div>
            </div>

            <!-- Tab Buttons Container -->
            <div class="flex flex-nowrap overflow-x-auto gap-2 border-b border-slate-800/60 pb-3 mb-8 scrollbar-none">
                <button onclick="switchTab('details')" id="tab-btn-details" class="tab-btn active px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                    📋 Course Details
                </button>
                <button onclick="switchTab('classes')" id="tab-btn-classes" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                    📚 Lectures / Classes
                </button>
                <button onclick="switchTab('notes')" id="tab-btn-notes" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                    📝 Shared Notes
                </button>
                <button onclick="switchTab('qa')" id="tab-btn-qa" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                    💬 Q&A Discussion
                </button>
                @if(Auth::user()->isStudent())
                    <button onclick="switchTab('assignments')" id="tab-btn-assignments" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                        ✍️ Assignments / HW
                    </button>
                    <button onclick="switchTab('results')" id="tab-btn-results" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                        🏆 Results & Reviews
                    </button>
                @endif
                @if(Auth::user()->isTeacher())
                    <button onclick="switchTab('prepare-question')" id="tab-btn-prepare-question" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                        📝 Prepare Question
                    </button>
                    <button onclick="switchTab('teacher-assignments')" id="tab-btn-teacher-assignments" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                        ✍️ Assignments / HW
                    </button>
                    <button onclick="switchTab('evaluations')" id="tab-btn-evaluations" class="tab-btn px-5 py-2.5 rounded-xl text-sm font-semibold border border-transparent hover:border-slate-800/80 transition cursor-pointer flex items-center gap-2">
                        📝 Evaluate
                        @if($submissions->whereNull('score')->count() > 0)
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                        @endif
                    </button>
                @endif
            </div>

            <!-- TAB CONTENT: DETAILS -->
            <div id="tab-content-details" class="tab-pane space-y-6">
                <div class="glass-panel rounded-2xl p-6 md:p-8 border border-slate-800/80 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Syllabus & Course Description</h2>
                    <div class="text-slate-300 text-sm leading-relaxed whitespace-pre-line space-y-4">
                        {{ $course->description ?: 'No syllabus description has been provided for this course yet.' }}
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT: CLASSES / LECTURES -->
            <div id="tab-content-classes" class="tab-pane hidden space-y-6">
                <!-- If teacher, show creation consoles -->
                @if(Auth::user()->isTeacher())
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Panel: Schedule Live Virtual Class -->
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg flex flex-col h-full">
                            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-pink-500/10 text-pink-400 flex items-center justify-center text-xs">🎥</span>
                                Schedule Live Virtual Class
                            </h2>
                            <form action="{{ route('teacher.classes.create') }}" method="POST" class="flex flex-col justify-between flex-grow">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Class Topic / Title</label>
                                        <input type="text" name="title" required placeholder="e.g. Chapter 4: Respiration" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs text-slate-400 font-semibold mb-1">Start Time</label>
                                            <input type="datetime-local" name="scheduled_at" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-400 outline-none focus:border-pink-500 transition">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-slate-400 font-semibold mb-1">Duration (Mins)</label>
                                            <input type="number" name="duration_minutes" required value="60" min="15" max="180" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-pink-500 transition text-center">
                                        </div>
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
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Meeting Link (Optional)</label>
                                        <input type="url" name="meeting_link" placeholder="https://zoom.us/j/..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-pink-500 transition">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-500 text-white font-bold text-xs rounded-xl py-3 shadow-lg shadow-pink-600/20 active:scale-[0.98] transition cursor-pointer">
                                        Schedule Class Session
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Right Panel: Upload Lecture Material / Recorded details -->
                        <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg flex flex-col h-full">
                            <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                <span class="w-6 h-6 rounded bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xs">📚</span>
                                Upload Recorded Lecture / Notes
                            </h2>
                            <form action="{{ route('teacher.lectures.create', $course->id) }}" method="POST" class="flex flex-col justify-between flex-grow">
                                @csrf
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Number</label>
                                            <input type="text" name="lecture_number" placeholder="e.g. Lecture 01" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Name / Topic</label>
                                            <input type="text" name="name" placeholder="e.g. Intro to Operating System Kernels" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Details / Notes / Links</label>
                                        <textarea name="details" rows="6" placeholder="Syllabus coverage, reference reading material, youtube/drive links..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition"></textarea>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-xs py-3 rounded-xl shadow-lg transition cursor-pointer">
                                        Save & Publish Lecture Material
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @php
                    $scheduled = $course->scheduledClasses ?? collect();
                    
                    // Live classes: active and duration not expired
                    $liveClasses = $scheduled->filter(function($c) {
                        $endTime = $c->scheduled_at->copy()->addMinutes($c->duration_minutes);
                        return $c->is_active && now()->lessThanOrEqualTo($endTime);
                    });

                    // Upcoming live classes: not active and duration not expired
                    $upcomingClasses = $scheduled->filter(function($c) {
                        $endTime = $c->scheduled_at->copy()->addMinutes($c->duration_minutes);
                        return !$c->is_active && now()->lessThan($endTime);
                    });

                    // Completed live classes
                    $completedClasses = $scheduled->filter(function($c) {
                        $endTime = $c->scheduled_at->copy()->addMinutes($c->duration_minutes);
                        return !$c->is_active || now()->greaterThan($endTime);
                    });
                @endphp

                <!-- Live Classes Section -->
                @if($liveClasses->count() > 0)
                    @foreach($liveClasses as $liveClass)
                        <div class="p-5 border border-pink-500/40 bg-pink-950/10 rounded-2xl shadow-lg relative overflow-hidden">
                            <div class="absolute -right-16 -top-16 w-32 h-32 bg-pink-500/10 rounded-full blur-2xl"></div>
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
                                <div class="space-y-1.5">
                                    <span class="inline-flex items-center gap-1.5 text-[9px] uppercase font-bold text-pink-400 bg-pink-500/10 px-2 py-0.5 rounded-full border border-pink-500/30">
                                        <span class="w-1.5 h-1.5 rounded-full bg-pink-500 animate-ping"></span> Live Class in Progress
                                    </span>
                                    <h3 class="text-base font-extrabold text-white">{{ $liveClass->title }}</h3>
                                    <p class="text-xs text-slate-300">Instructor: {{ $course->instructor }} &middot; Platform: <strong>{{ $liveClass->platform }}</strong> &middot; Duration: <strong>{{ $liveClass->duration_minutes }} Mins</strong></p>
                                    <p class="text-[10px] text-slate-400 italic">Started at: {{ $liveClass->scheduled_at->format('M d, H:i') }} (ends at {{ $liveClass->scheduled_at->copy()->addMinutes($liveClass->duration_minutes)->format('H:i') }})</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    @php
                                        $joinLink = $liveClass->meeting_link;
                                        if ($liveClass->platform === 'In-App Classroom') {
                                            $joinLink = route('classroom', $liveClass->id);
                                        }
                                    @endphp
                                    @if(Auth::user()->isTeacher())
                                        <form action="{{ route('teacher.classes.toggle-active', $liveClass->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold py-2.5 px-5 rounded-xl border border-slate-700/60 transition cursor-pointer">
                                                ⏹ End Session
                                            </button>
                                        </form>
                                        @if($joinLink)
                                            <a href="{{ $joinLink }}" target="_blank" class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-500 text-white font-bold py-2.5 px-5 rounded-xl border border-purple-500/20 transition cursor-pointer shadow-lg shadow-purple-650/20 text-xs">
                                                💻 Launch Classroom
                                            </a>
                                        @endif
                                    @else
                                        @if($joinLink)
                                            <a href="{{ $joinLink }}" target="_blank" class="inline-flex items-center gap-2 bg-pink-600 hover:bg-pink-500 text-white font-bold py-2.5 px-5 rounded-xl border border-pink-500/20 transition cursor-pointer shadow-lg shadow-pink-600/20 text-xs">
                                                💻 Join Live Class
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <!-- Upcoming Scheduled Classes -->
                @if($upcomingClasses->count() > 0)
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <h2 class="text-base font-bold text-white mb-4">Upcoming Scheduled Classes</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($upcomingClasses as $class)
                                <div class="border border-slate-800/80 bg-slate-900/20 rounded-xl p-4 flex flex-col justify-between gap-4 transition-all duration-300">
                                    <div class="space-y-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-[9px] uppercase font-extrabold px-2 py-0.5 rounded bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                                Upcoming Session
                                            </span>
                                            <span class="text-xs text-slate-400">Duration: {{ $class->duration_minutes }} Mins</span>
                                        </div>
                                        <h3 class="text-sm font-bold text-white mt-1">{{ $class->title }}</h3>
                                        <p class="text-[10px] text-slate-400">
                                            Scheduled: {{ $class->scheduled_at->format('M d, Y - H:i') }} ({{ $class->scheduled_at->diffForHumans() }})
                                        </p>
                                        <p class="text-[10px] text-slate-400">Platform: <strong>{{ $class->platform }}</strong></p>
                                    </div>
                                    <div class="flex items-center gap-2 mt-2">
                                        @if(Auth::user()->isTeacher())
                                            <form action="{{ route('teacher.classes.toggle-active', $class->id) }}" method="POST" class="w-full">
                                                @csrf
                                                <button type="submit" class="w-full text-xs bg-pink-600 hover:bg-pink-500 text-white font-bold py-2 px-3.5 rounded-lg border border-pink-500/20 transition cursor-pointer shadow-md shadow-pink-600/10">
                                                    ▶ Start Class
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full text-xs bg-slate-800 text-slate-500 font-bold py-2 px-3.5 rounded-lg border border-slate-700/40 cursor-not-allowed">
                                                ⏳ Waiting for Host to Start
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- List of Lectures -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Course Lectures & Classes</h2>
                    @if($course->lectures->count() === 0 && $completedClasses->count() === 0)
                        <div class="text-center py-12 text-slate-500 text-sm italic">
                            No lectures or classes have been uploaded or taken for this course yet.
                        </div>
                    @else
                        <div class="space-y-4">
                            <!-- Completed Live Classes -->
                            @foreach($completedClasses as $completedClass)
                                <div class="completed-live-class-card border border-slate-800/60 bg-slate-900/10 rounded-xl p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition duration-300">
                                    <div class="flex flex-col md:flex-row md:items-center gap-4 flex-grow">
                                        <div class="flex-shrink-0">
                                            <span class="status-badge px-3 py-1.5 rounded-lg text-xs font-extrabold bg-purple-600 text-white border border-purple-500 uppercase tracking-wide block text-center md:inline-block">
                                                Live Class
                                            </span>
                                        </div>
                                        <div class="space-y-1">
                                            <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $completedClass->title }}</h3>
                                            <p class="text-slate-600 dark:text-slate-350 text-xs leading-relaxed">
                                                Platform: <strong class="text-slate-800 dark:text-slate-200">{{ $completedClass->platform }}</strong> &middot; Duration: <strong class="text-slate-800 dark:text-slate-200">{{ $completedClass->duration_minutes }} Mins</strong>
                                            </p>
                                            <span class="text-[10px] text-slate-500 block">Taken on {{ $completedClass->scheduled_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $joinLink = $completedClass->meeting_link;
                                        if ($completedClass->platform === 'In-App Classroom') {
                                            $joinLink = route('classroom', $completedClass->id);
                                        }
                                    @endphp
                                    @if($joinLink)
                                        <div class="flex-shrink-0 w-full md:w-auto text-right">
                                             <a href="{{ $joinLink }}" target="_blank" class="w-full md:w-auto bg-pink-600 hover:bg-pink-500 text-white font-bold text-xs py-2.5 px-5 rounded-xl border border-pink-500/20 shadow-md shadow-pink-600/10 transition cursor-pointer inline-block text-center">
                                                 See Class
                                             </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach

                            <!-- Recorded Lectures -->
                            @foreach($course->lectures as $lecture)
                                <div class="lecture-card border border-slate-800/60 bg-slate-900/10 rounded-xl p-5 space-y-4 transition duration-300">
                                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                                        <div class="flex-shrink-0">
                                            <span class="status-badge px-3 py-1.5 rounded-lg text-xs font-bold bg-indigo-600 text-white uppercase tracking-wider block text-center md:inline-block shadow-sm">
                                                Recorded
                                            </span>
                                        </div>
                                        <div class="flex-grow space-y-2">
                                            <h3 class="text-base font-bold text-white"><span class="text-xs font-semibold text-purple-400">[{{ $lecture->lecture_number }}]</span> {{ $lecture->name }}</h3>
                                            <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $lecture->details ?: 'No details provided.' }}</p>
                                            
                                            @if($lecture->video_path)
                                                <div class="mt-3 border border-slate-800/85 rounded-xl overflow-hidden bg-slate-950/40">
                                                    <video controls class="w-full max-h-80 object-contain">
                                                        <source src="{{ asset($lecture->video_path) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            @endif

                                            <span class="text-[10px] text-slate-500 block pt-1">Uploaded on {{ $lecture->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                    </div>

                                    <!-- Facebook-like Action Bar (Like & Comment buttons) -->
                                    <div class="flex items-center gap-6 py-2 border-y border-slate-800/40 my-3 text-xs text-slate-400">
                                        <!-- Like Button (AJAX Post) -->
                                        <form id="like-form-{{ $lecture->id }}" class="inline">
                                            @csrf
                                            <button type="button" onclick="toggleLikeAjax({{ $lecture->id }}, '{{ route('course.lectures.like', [$course->id, $lecture->id]) }}')" class="like-btn-{{ $lecture->id }} lecture-action-btn flex items-center gap-1.5 font-semibold transition cursor-pointer {{ $lecture->isLikedBy(Auth::user()) ? 'liked-active' : '' }}">
                                                <span>👍</span>
                                                <span class="like-text">{{ $lecture->isLikedBy(Auth::user()) ? 'Liked' : 'Like' }}</span>
                                                <span class="like-count action-count px-1.5 py-0.5 rounded text-[10px] font-bold {{ $lecture->likes->count() === 0 ? 'hidden' : '' }}">
                                                    {{ $lecture->likes->count() }}
                                                </span>
                                            </button>
                                        </form>

                                        <!-- Comment Trigger Icon/Button -->
                                        <button onclick="toggleCommentsSection({{ $lecture->id }})" class="lecture-action-btn flex items-center gap-1.5 font-semibold transition cursor-pointer">
                                            <span>💬</span>
                                            <span>Comment</span>
                                            @if($lecture->comments->count() > 0)
                                                <span class="action-count px-1.5 py-0.5 rounded text-[10px] font-bold">{{ $lecture->comments->count() }}</span>
                                            @endif
                                        </button>
                                    </div>

                                    <!-- Comments section for this lecture class -->
                                    <div id="comments-section-{{ $lecture->id }}" class="hidden mt-4 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 space-y-3">
                                        <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-slate-800 dark:text-slate-200">Comments & Discussion ({{ $lecture->comments->count() }})</h4>
                                        
                                        <!-- Comments list -->
                                        @if($lecture->rootComments->count() > 0)
                                            <div class="space-y-3">
                                                @foreach($lecture->rootComments as $comment)
                                                    <div class="lecture-comment-card bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-3.5 text-xs space-y-1.5 shadow-sm">
                                                        <div class="flex justify-between items-center text-[10px] text-slate-500 dark:text-slate-400">
                                                            <span class="flex items-center gap-1.5">
                                                                <strong class="font-bold {{ $comment->user->isTeacher() ? 'text-purple-600 dark:text-purple-400' : 'text-slate-900 dark:text-slate-100' }}">{{ $comment->user->name }}</strong>
                                                                @if($comment->user->isTeacher())
                                                                    <span class="text-[8px] font-extrabold uppercase border px-1.5 py-0.5 rounded bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-800/60">Teacher</span>
                                                                @endif
                                                            </span>
                                                            <div class="flex items-center gap-1.5">
                                                                <span class="lecture-comment-meta">{{ $comment->created_at->diffForHumans() }}</span>
                                                                <span class="text-slate-300 dark:text-slate-700">&middot;</span>
                                                                <button type="button" onclick="setLectureReplyParent({{ $lecture->id }}, {{ $comment->id }}, '{{ $comment->user->name }}')" class="lecture-comment-btn bg-transparent border-0 p-0 font-semibold hover:underline cursor-pointer text-slate-800 dark:text-slate-200">Reply</button>
                                                                @if(Auth::id() === $comment->user_id || Auth::user()->isTeacher())
                                                                    <span class="text-slate-300 dark:text-slate-700">&middot;</span>
                                                                    <form action="{{ route('course.lectures.comment.delete', [$course->id, $lecture->id, $comment->id]) }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Delete this comment?');">
                                                                        @csrf
                                                                        <button type="submit" class="lecture-comment-btn bg-transparent border-0 p-0 font-semibold hover:underline cursor-pointer text-slate-800 dark:text-slate-200">Delete</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <p class="leading-relaxed font-semibold text-slate-900 dark:text-slate-100">{{ $comment->comment_text }}</p>

                                                        <!-- Replies -->
                                                        @if($comment->replies->count() > 0)
                                                            <div class="pl-3.5 mt-2 border-l border-slate-200 dark:border-slate-800 space-y-2">
                                                                @foreach($comment->replies as $reply)
                                                                    <div class="lecture-reply-card bg-slate-50 dark:bg-slate-950/40 border border-slate-150 dark:border-slate-850 p-2.5 rounded-lg space-y-1">
                                                                        <div class="flex justify-between items-center text-[10px] text-slate-500 dark:text-slate-400">
                                                                            <span class="flex items-center gap-1">
                                                                                <strong class="font-bold {{ $reply->user->isTeacher() ? 'text-purple-600 dark:text-purple-400' : 'text-slate-900 dark:text-slate-100' }}">{{ $reply->user->name }}</strong>
                                                                                @if($reply->user->isTeacher())
                                                                                    <span class="text-[8px] font-extrabold uppercase border px-1.5 py-0.5 rounded bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-800/60">Teacher</span>
                                                                                @endif
                                                                            </span>
                                                                            <div class="flex items-center gap-1.5">
                                                                                <span class="lecture-comment-meta">{{ $reply->created_at->diffForHumans() }}</span>
                                                                                @if(Auth::id() === $reply->user_id || Auth::user()->isTeacher())
                                                                                    <span class="text-slate-300 dark:text-slate-700">&middot;</span>
                                                                                    <form action="{{ route('course.lectures.comment.delete', [$course->id, $lecture->id, $reply->id]) }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Delete this reply?');">
                                                                                        @csrf
                                                                                        <button type="submit" class="lecture-comment-btn bg-transparent border-0 p-0 font-semibold hover:underline cursor-pointer text-slate-800 dark:text-slate-200">Delete</button>
                                                                                    </form>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <p class="text-[10px] leading-relaxed font-semibold text-slate-800 dark:text-slate-200">{{ $reply->comment_text }}</p>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Comment input form -->
                                        <form action="{{ route('course.lectures.comment', [$course->id, $lecture->id]) }}" method="POST" class="space-y-2">
                                            @csrf
                                            <input type="hidden" name="parent_id" id="lecture-parent-input-{{ $lecture->id }}" value="">
                                            
                                            <!-- Reply Indicator -->
                                            <div id="lecture-reply-indicator-{{ $lecture->id }}" class="hidden flex justify-between items-center bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-850 rounded-lg px-2.5 py-1 text-[10px] text-slate-700 dark:text-slate-350">
                                                <span>Replying to: <strong class="text-indigo-600 dark:text-indigo-400" id="lecture-reply-user-{{ $lecture->id }}"></strong></span>
                                                <button type="button" onclick="cancelLectureReply({{ $lecture->id }})" class="text-red-600 dark:text-red-400 hover:underline font-bold cursor-pointer">&times; Cancel</button>
                                            </div>

                                            <div class="flex gap-2">
                                                <input type="text" name="comment_text" required placeholder="Write a comment or click Reply..." class="flex-grow bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg py-1.5 px-3 text-xs text-slate-900 dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:border-purple-500 transition shadow-sm">
                                                <button type="submit" class="bg-indigo-650 hover:bg-indigo-500 text-white font-bold text-[10px] py-1 px-3 rounded-lg shadow transition cursor-pointer">
                                                    Comment
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- TAB CONTENT: SHARED NOTES -->
            <div id="tab-content-notes" class="tab-pane hidden space-y-6">
                <!-- Upload Notes Form -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-base font-bold text-white mb-4">Share Your Notes (PDF Only)</h2>
                    <form action="{{ route('course.notes.upload', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">Notes Title</label>
                                <input type="text" name="title" placeholder="e.g. Midterm prep summary notes" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">PDF File (Max 10MB)</label>
                                <input type="file" name="note_file" accept=".pdf" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-1.5 px-3 text-sm text-slate-400 focus:outline-none focus:border-purple-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-500 cursor-pointer">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-xs py-2 px-6 rounded-xl shadow transition cursor-pointer">
                                📤 Upload & Share Notes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Shared Notes List -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Community Shared Notes</h2>
                    @if($course->notes->count() === 0)
                        <div class="text-center py-12 text-slate-500 text-sm italic">
                            No shared notes yet. Be the first to upload and help your classmates!
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($course->notes as $note)
                                <div class="border border-slate-800/60 bg-slate-900/10 rounded-xl p-5 flex flex-col gap-4 hover:border-indigo-500/30 transition-all duration-300">
                                    <div class="flex items-start gap-4">
                                        <div class="p-3 bg-rose-500/10 rounded-xl text-rose-400 border border-rose-500/20 text-xl font-bold flex-shrink-0">
                                            📄
                                        </div>
                                        <div class="flex-grow space-y-2 min-w-0">
                                            <h3 class="font-bold text-sm text-white truncate" title="{{ $note->title }}">{{ $note->title }}</h3>
                                            <div class="text-xs text-slate-400">
                                                Shared by: <strong class="text-slate-300">{{ $note->user->name }}</strong> 
                                                @if($note->user->isTeacher()) 
                                                    <span class="bg-purple-500/10 text-purple-300 text-[8px] font-extrabold uppercase px-1 rounded border border-purple-500/25 ml-1">Teacher</span>
                                                @endif
                                            </div>
                                            <div class="text-[9px] text-slate-500">{{ $note->created_at->diffForHumans() }}</div>
                                            <div class="pt-2 flex gap-2">
                                                <a href="{{ asset($note->file_path) }}" target="_blank" class="bg-slate-850 hover:bg-slate-800 text-slate-300 font-bold py-1 px-3 rounded text-[10px] border border-slate-700/60 transition inline-flex items-center gap-1">
                                                    👓 View PDF
                                                </a>
                                                <a href="{{ asset($note->file_path) }}" download class="bg-indigo-650 hover:bg-indigo-500 text-white font-bold py-1 px-3 rounded text-[10px] shadow border border-indigo-500/20 transition inline-flex items-center gap-1">
                                                    📥 Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Facebook-like Action Bar for Notes -->
                                    <div class="flex items-center gap-6 py-2 border-y border-slate-800/40 my-1 text-xs text-slate-400">
                                        <!-- Like Button (AJAX Post) -->
                                        <form id="like-form-note-{{ $note->id }}" class="inline">
                                            @csrf
                                            <button type="button" onclick="toggleLikeNoteAjax({{ $note->id }}, '{{ route('course.notes.like', [$course->id, $note->id]) }}')" class="like-btn-note-{{ $note->id }} lecture-action-btn flex items-center gap-1.5 font-semibold transition cursor-pointer {{ $note->isLikedBy(Auth::user()) ? 'liked-active' : '' }}">
                                                <span>👍</span>
                                                <span class="like-text">{{ $note->isLikedBy(Auth::user()) ? 'Liked' : 'Like' }}</span>
                                                <span class="like-count action-count px-1.5 py-0.5 rounded text-[10px] font-bold {{ $note->likes->count() === 0 ? 'hidden' : '' }}">
                                                    {{ $note->likes->count() }}
                                                </span>
                                            </button>
                                        </form>

                                        <!-- Comment Trigger Icon/Button -->
                                        <button onclick="toggleNoteCommentsSection({{ $note->id }})" class="lecture-action-btn flex items-center gap-1.5 font-semibold transition cursor-pointer">
                                            <span>💬</span>
                                            <span>Comment</span>
                                            @if($note->comments->count() > 0)
                                                <span class="action-count px-1.5 py-0.5 rounded text-[10px] font-bold">{{ $note->comments->count() }}</span>
                                            @endif
                                        </button>
                                    </div>

                                    <!-- Comments section for this Note -->
                                    <div id="note-comments-section-{{ $note->id }}" class="hidden mt-2 pt-3 border-t border-slate-200/60 dark:border-slate-800/60 space-y-3">
                                        <h4 class="text-[10px] font-extrabold uppercase tracking-wider text-slate-800 dark:text-slate-200">Comments & Discussion ({{ $note->comments->count() }})</h4>
                                        
                                        <!-- Comments list -->
                                        @if($note->comments->count() > 0)
                                            <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                                                @foreach($note->comments as $comment)
                                                    <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg p-2.5 text-xs space-y-1 shadow-sm">
                                                        <div class="flex justify-between items-center text-[9px] text-slate-500 dark:text-slate-400">
                                                            <span class="flex items-center gap-1.5">
                                                                <strong class="font-bold {{ $comment->user->isTeacher() ? 'text-purple-600 dark:text-purple-400' : 'text-slate-900 dark:text-slate-100' }}">{{ $comment->user->name }}</strong>
                                                                @if($comment->user->isTeacher())
                                                                    <span class="text-[7px] font-extrabold uppercase border px-1 py-0.2 rounded bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-300 border-purple-200 dark:border-purple-800/60">Teacher</span>
                                                                @endif
                                                            </span>
                                                            <div class="flex items-center gap-1.5">
                                                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                                @if(Auth::id() === $comment->user_id || Auth::user()->isTeacher())
                                                                    <span>&middot;</span>
                                                                    <form action="{{ route('course.notes.comment.delete', [$course->id, $note->id, $comment->id]) }}" method="POST" class="inline m-0 p-0" onsubmit="return confirm('Delete this comment?');">
                                                                        @csrf
                                                                        <button type="submit" class="bg-transparent border-0 p-0 font-semibold hover:underline cursor-pointer text-slate-500 dark:text-slate-400 text-[9px]">Delete</button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <p class="leading-relaxed text-slate-800 dark:text-slate-200">{{ $comment->comment_text }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <!-- Add Comment Form -->
                                        <form action="{{ route('course.notes.comment', [$course->id, $note->id]) }}" method="POST" class="mt-2">
                                            @csrf
                                            <div class="flex items-center gap-2">
                                                <input type="text" name="comment_text" required placeholder="Write a comment..." class="flex-grow bg-slate-950/30 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-850 rounded-xl py-1.5 px-3 text-xs text-slate-900 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-purple-500 transition">
                                                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold text-[10px] py-1.5 px-3 rounded-lg shadow transition cursor-pointer flex-shrink-0">
                                                    Post
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- TAB CONTENT: Q&A -->
            <div id="tab-content-qa" class="tab-pane hidden space-y-6">
                <!-- Ask Question Form -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-base font-bold text-white mb-4">Ask a Question</h2>
                    <form action="{{ route('course.questions.ask', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Your Question / Doubt</label>
                            <textarea name="question_text" rows="3" required placeholder="Type your question or query here..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2.5 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs text-slate-400 font-semibold mb-1">Attach Image (Optional)</label>
                            <input type="file" name="question_image" accept="image/*" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-1.5 px-3 text-sm text-slate-400 focus:outline-none focus:border-purple-500 transition file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-500 cursor-pointer">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-xs py-2 px-6 rounded-xl shadow transition cursor-pointer">
                                ❓ Submit Question
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Questions List -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-6">Discussions / Q&A</h2>
                    @if($course->questions->count() === 0)
                        <div class="text-center py-12 text-slate-500 text-sm italic">
                            No questions posted yet. Start the discussion!
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($course->questions as $question)
                                <div class="border border-slate-800/70 bg-slate-950/20 rounded-2xl p-5 md:p-6 space-y-4">
                                    
                                    <!-- Student Question Details -->
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center font-extrabold flex-shrink-0">
                                            {{ strtoupper(substr($question->user->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-grow space-y-2">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-sm text-white">{{ $question->user->name }}</span>
                                                <span class="text-[10px] text-slate-500">{{ $question->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $question->question_text }}</p>
                                            
                                            <!-- Attached Image -->
                                            @if($question->image_path)
                                                <div class="mt-3 max-w-sm rounded-xl overflow-hidden border border-slate-800 bg-slate-950/30">
                                                    <img src="{{ asset($question->image_path) }}" alt="Question Attachment" class="w-full max-h-60 object-contain hover:scale-[1.02] transition duration-300">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Replies List -->
                                    <div class="border-t border-slate-800/40 pt-4 space-y-4 pl-6 md:pl-12">
                                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Replies ({{ $question->answers->count() }})</h4>
                                        
                                        @foreach($question->answers as $answer)
                                            <div class="flex items-start gap-3 bg-slate-900/10 border border-slate-800/50 rounded-xl p-3.5">
                                                <div class="w-8 h-8 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center font-extrabold text-xs flex-shrink-0">
                                                    {{ strtoupper(substr($answer->user->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-grow space-y-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <span class="font-bold text-xs text-white">{{ $answer->user->name }}</span>
                                                        @if($answer->user->isTeacher())
                                                            <span class="bg-purple-500/10 text-purple-300 text-[8px] font-extrabold uppercase px-1.5 py-0.5 rounded border border-purple-500/25">Instructor</span>
                                                        @endif
                                                        <span class="text-[9px] text-slate-500">{{ $answer->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-slate-300 text-xs leading-relaxed whitespace-pre-line">{{ $answer->answer_text }}</p>
                                                    
                                                    @if($answer->image_path)
                                                        <div class="mt-2 max-w-xs rounded-lg overflow-hidden border border-slate-800 bg-slate-950/20">
                                                            <img src="{{ asset($answer->image_path) }}" alt="Reply Attachment" class="w-full max-h-40 object-contain">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Teacher/Instructor Reply Form -->
                                        @if(Auth::user()->isTeacher())
                                            <form action="{{ route('course.questions.reply', [$course->id, $question->id]) }}" method="POST" enctype="multipart/form-data" class="mt-4 pt-2 border-t border-dashed border-slate-800/60">
                                                @csrf
                                                <div class="space-y-3">
                                                    <div>
                                                        <textarea name="answer_text" rows="2" required placeholder="Write instructor reply..." class="w-full bg-slate-900/50 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition"></textarea>
                                                    </div>
                                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                                                        <div>
                                                            <input type="file" name="answer_image" accept="image/*" class="w-full bg-slate-900/50 border border-slate-800 rounded-lg py-1 px-2 text-[10px] text-slate-400 focus:outline-none focus:border-purple-500 transition file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-500 cursor-pointer">
                                                        </div>
                                                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold text-[10px] py-1.5 px-4 rounded-lg shadow transition cursor-pointer">
                                                            ✏ Post Reply
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            @if(Auth::user()->isStudent())
                <!-- TAB CONTENT: ASSIGNMENTS / HW -->
                <div id="tab-content-assignments" class="tab-pane hidden space-y-6">
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <h3 class="text-lg font-bold text-white mb-2">Assigned Tasks</h3>
                        <p class="text-xs text-slate-400 mb-6">View and attempt your assignments and exams for this course.</p>
                        
                        @if($course->tasks->count() === 0)
                            <div class="text-center py-12 text-slate-500 italic text-sm">
                                No tasks assigned for this course.
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($course->tasks->sortByDesc('created_at') as $task)
                                    @php
                                        $sub = $task->submissions->where('user_id', Auth::id())->first();
                                        $isCompleted = $sub && $sub->is_completed;
                                    @endphp
                                    <div class="workspace-task-card bg-slate-900/60 rounded-2xl p-5 border border-slate-850 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex-grow">
                                            <div class="flex items-center gap-2">
                                                <span class="text-base font-bold text-slate-200">{{ $task->title }}</span>
                                                @if($task->is_test)
                                                    <span class="bg-indigo-500/10 text-indigo-300 border border-indigo-500/25 px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase tracking-wider">Exam</span>
                                                @else
                                                    <span class="bg-purple-500/10 text-purple-300 border border-purple-500/25 px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase tracking-wider text-[8px]">Assignment</span>
                                                @endif
                                                @if($isCompleted)
                                                    <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/25 px-1.5 py-0.5 rounded text-[8px] font-bold">✅ Completed</span>
                                                @else
                                                    @if(!$task->is_test && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($task->due_date)))
                                                        <span class="bg-rose-500/10 text-rose-400 border border-rose-500/25 px-1.5 py-0.5 rounded text-[8px] font-bold">⏳ Closed</span>
                                                    @else
                                                        <span class="bg-amber-500/10 text-amber-400 border border-amber-500/25 px-1.5 py-0.5 rounded text-[8px] font-bold">⏳ Pending</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <p class="text-xs text-slate-400 mt-2">{{ $task->description ?: 'No description provided.' }}</p>
                                            <div class="flex gap-4 mt-3 text-[10px] text-slate-500">
                                                <span>Marks: <strong class="text-slate-400">{{ $task->points }} pts</strong></span>
                                                <span>Due: <strong class="text-slate-400">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y - H:i') : '—' }}</strong></span>
                                                @if($task->duration_minutes && $task->is_test)
                                                    <span>Duration: <strong class="text-slate-400">⏱ {{ $task->duration_minutes }} Mins</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 w-full md:w-auto">
                                            @if($isCompleted)
                                                <div class="text-right">
                                                    <span class="text-xs text-emerald-400 font-bold block">
                                                        Submitted
                                                    </span>
                                                    @if($sub->uploaded_file)
                                                        <a href="{{ asset($sub->uploaded_file) }}" target="_blank" class="text-[10px] text-indigo-400 hover:underline block mt-1">Download Submitted File</a>
                                                    @endif
                                                </div>
                                            @else
                                                @if($task->is_test)
                                                    <a href="/exam/{{ $task->id }}" class="bg-indigo-650 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-xl text-xs shadow-md shadow-indigo-660/20 active:scale-[0.98] transition cursor-pointer inline-block">
                                                        ✍️ Start Exam
                                                    </a>
                                                @else
                                                    @if(\Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($task->due_date)))
                                                        <span class="text-xs text-rose-500 font-extrabold bg-rose-500/10 px-2.5 py-1 rounded-lg border border-rose-500/25">⏳ Closed (Deadline Over)</span>
                                                    @else
                                                        <!-- Assignment Submit Form -->
                                                        <form action="{{ route('course.tasks.submit', [$course->id, $task->id]) }}" method="POST" enctype="multipart/form-data" class="mt-2 space-y-2 max-w-sm">
                                                            @csrf
                                                            <div class="flex flex-col gap-1.5">
                                                                <input type="file" name="submission_file" required class="bg-slate-950/40 border border-slate-800 rounded-lg py-1 px-2 text-[10px] text-slate-400 file:py-0.5 file:px-2 file:rounded file:border-0 file:text-[9px] file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500 cursor-pointer">
                                                                <textarea name="response_text" placeholder="Write any comments/notes (optional)..." rows="1" class="task-review-textarea w-full bg-slate-950/40 border border-slate-800 rounded-lg py-1 px-2 text-[10px] text-slate-200 placeholder-slate-600 focus:outline-none focus:border-indigo-500 transition"></textarea>
                                                            </div>
                                                            <button type="submit" class="w-full bg-indigo-650 hover:bg-indigo-500 text-white font-bold py-1.5 px-3 rounded-lg text-[10px] shadow transition cursor-pointer">
                                                                Submit Assignment
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- TAB CONTENT: RESULTS & REVIEWS -->
                <div id="tab-content-results" class="tab-pane hidden space-y-6">
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <h3 class="text-lg font-bold text-white mb-2">Test Results & Performance</h3>
                        <p class="text-xs text-slate-400 mb-6">Review your scores, feedback, and request grade re-evaluations if needed.</p>

                        @php
                            $mySubmissions = \App\Models\TaskSubmission::whereIn('task_id', $course->tasks->pluck('id'))
                                ->where('user_id', Auth::id())
                                ->with('task')
                                ->orderBy('updated_at', 'desc')
                                ->get();
                        @endphp

                        @if($mySubmissions->count() === 0)
                            <div class="text-center py-12 text-slate-500 italic text-sm">
                                You have not submitted any tests for this course yet.
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach($mySubmissions as $sub)
                                    <div class="workspace-task-card bg-slate-900/60 rounded-2xl p-5 border border-slate-850 space-y-4">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-800 pb-3">
                                            <div>
                                                <h4 class="text-sm font-bold text-slate-200">{{ $sub->task->title }}</h4>
                                                <span class="text-[10px] text-slate-500">Submitted: {{ $sub->updated_at->format('M d, Y - H:i') }}</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-[10px] text-slate-500 block">Marks Obtained</span>
                                                @if(is_null($sub->score))
                                                    <span class="text-[11px] font-bold text-amber-400 bg-amber-500/10 border border-amber-500/25 px-2 py-0.5 rounded-lg">Pending Grading</span>
                                                @else
                                                    <span class="text-base font-extrabold text-emerald-400">{{ $sub->score }}</span>
                                                    <span class="text-xs text-slate-500">/ {{ $sub->task->points }} pts</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if(!is_null($sub->score))
                                            <!-- Feedback & Teacher Remarks -->
                                            <div class="task-feedback-box bg-slate-950/30 rounded-xl p-3 border border-slate-850/60 text-xs">
                                                <span class="font-bold text-indigo-400 block mb-1">Feedback / Remarks:</span>
                                                <p class="text-slate-300 italic">"{{ $sub->feedback ?: 'No specific feedback was provided.' }}"</p>
                                            </div>

                                            <!-- Review Grade Request -->
                                            <div class="border-t border-slate-850 pt-3 mt-2">
                                                @if($sub->review_requested)
                                                    <div class="p-3.5 rounded-xl text-xs space-y-2 {{ $sub->review_status === 'reviewed' ? 'bg-emerald-950/40 border border-emerald-500/30 text-emerald-400' : 'bg-amber-950/40 border border-amber-500/30 text-amber-400' }}">
                                                        <div class="flex items-center justify-between font-bold">
                                                            <span>{{ $sub->review_status === 'reviewed' ? '✅ Re-Evaluation Completed' : '⚠️ Grade Review Pending' }}</span>
                                                            <span class="text-[10px] uppercase px-1.5 py-0.5 rounded {{ $sub->review_status === 'reviewed' ? 'bg-emerald-500/10' : 'bg-amber-500/10' }}">{{ $sub->review_status }}</span>
                                                        </div>
                                                        <p class="text-[11px] text-slate-300 mt-1 font-medium">Your Reason: <span class="italic font-normal">"{{ $sub->review_reason }}"</span></p>
                                                    </div>
                                                @else
                                                    <div class="space-y-3">
                                                        <div class="text-xs font-semibold text-slate-300">Request Re-Evaluation?</div>
                                                        <p class="text-[10px] text-slate-500">If your marks are not satisfactory, submit a brief reason below to request a manual review from your teacher.</p>
                                                        
                                                        <form action="{{ route('course.submissions.review', [$course->id, $sub->id]) }}" method="POST" class="space-y-3">
                                                            @csrf
                                                            <textarea name="review_reason" required placeholder="State your reason (e.g. My written answer was correctly justified but got partial marks...)" rows="2" class="task-review-textarea w-full bg-slate-950/40 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 placeholder-slate-600 outline-none focus:border-indigo-500 transition leading-relaxed"></textarea>
                                                            <div class="text-right">
                                                                <button type="submit" class="bg-indigo-650 hover:bg-indigo-500 text-white font-bold text-[10px] py-1.5 px-4 rounded-lg shadow-md transition cursor-pointer">
                                                                    Submit Review Request
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            @if(Auth::user()->isTeacher())
                <!-- TAB CONTENT: PREPARE QUESTION -->
                <div id="tab-content-prepare-question" class="tab-pane hidden space-y-6">

                    {{-- Published Tests List --}}
                    @if($course->tasks->where('is_test', true)->count() > 0)
                    <div class="glass-panel rounded-2xl p-5 border border-slate-800/80 shadow-lg">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="text-base">📋</span>
                            <div>
                                <h3 class="text-sm font-bold text-white">Published Tests</h3>
                                <p class="text-[11px] text-slate-400">Select a test to edit and republish. MCQ scores are auto-updated on answer changes.</p>
                            </div>
                        </div>
                        <div class="space-y-2" id="published-tests-list">
                        @foreach($course->tasks->where('is_test', true)->sortByDesc('created_at') as $pt)
                            <div class="flex items-center justify-between bg-slate-900/60 rounded-xl px-4 py-3 border border-slate-800 hover:border-indigo-500/40 transition group">
                                <div class="flex-1 min-w-0 pr-4">
                                    <p class="text-sm font-semibold text-white truncate">{{ $pt->title }}</p>
                                    <div class="flex flex-wrap gap-3 mt-0.5">
                                        <span class="text-[10px] text-slate-300">Created: {{ $pt->created_at->format('d M Y') }}</span>
                                        <span class="text-[10px] text-slate-300">Due: {{ $pt->due_date ? $pt->due_date->format('d M Y') : '—' }}</span>
                                        @if($pt->duration_minutes)
                                        <span class="text-[10px] text-slate-300">⏱ {{ $pt->duration_minutes }} min</span>
                                        @endif
                                        <span class="text-[10px] text-indigo-300 font-bold">{{ $pt->points }} marks · {{ $pt->questions->count() }} Qs</span>
                                    </div>
                                </div>
                                <button type="button"
                                    onclick="loadTaskForEdit({{ json_encode([
                                        'id' => $pt->id,
                                        'title' => $pt->title,
                                        'description' => $pt->description,
                                        'due_date' => $pt->due_date ? $pt->due_date->format('Y-m-d') : '',
                                        'duration_minutes' => $pt->duration_minutes,
                                        'mcq_negative_marking' => (bool)$pt->mcq_negative_marking,
                                        'mcq_negative_marking_value' => $pt->mcq_negative_marking_value,
                                        'questions' => $pt->questions->map(fn($q) => [
                                            'id' => $q->id,
                                            'text' => $q->question_text,
                                            'type' => $q->type,
                                            'points' => $q->points,
                                            'options' => $q->options ?? [],
                                            'correct_answer' => $q->correct_answer,
                                        ])->values()
                                    ]) }})"
                                    class="flex-shrink-0 text-[11px] font-bold px-4 py-1.5 rounded-lg bg-indigo-600/20 text-indigo-300 border border-indigo-600/30 hover:bg-indigo-600/40 hover:text-white transition cursor-pointer">
                                    ✏️ Edit
                                </button>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <div class="pb-4 border-b border-slate-800 flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-white" id="question-maker-heading">EduTrack Question Maker</h3>
                                <p class="text-xs text-slate-400 mt-0.5" id="question-maker-subtitle">Design exam papers with dynamic question distribution</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" id="reset-to-create-btn" onclick="resetToCreateMode()" class="hidden text-[11px] font-bold px-3 py-1.5 rounded-lg bg-slate-700/60 text-slate-300 border border-slate-600 hover:bg-slate-600 transition cursor-pointer">+ New Test</button>
                                <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl px-4 py-2 text-right">
                                    <span class="text-[9px] uppercase font-bold text-indigo-400 block">Total Marks</span>
                                    <span class="text-base font-extrabold text-white" id="builder-total-marks">0</span>
                                </div>
                            </div>
                        </div>

                        <form id="question-maker-form" action="{{ route('teacher.tasks.create') }}" method="POST" class="space-y-5">
                            @csrf
                            <input type="hidden" name="is_test" value="1">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="_task_id" id="edit-task-id" value="">

                            <!-- Test Meta Details -->
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-8">
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Test Title</label>
                                    <input type="text" name="title" required placeholder="e.g. Midterm: Respiration" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition">
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Duration (Minutes)</label>
                                    <input type="number" name="duration_minutes" required value="60" min="5" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition text-center font-bold">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                <div class="md:col-span-8">
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Instructions / Description</label>
                                    <input type="text" name="description" placeholder="Instructions: Answer all questions. For files, upload your clear khata photo." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 outline-none focus:border-indigo-500 transition">
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Due Date</label>
                                    <input type="date" name="due_date" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-300 outline-none focus:border-indigo-500 transition">
                                </div>
                            </div>

                            <!-- MCQ Negative Marking Config -->
                            <div class="bg-slate-950/40 border border-slate-850 rounded-2xl p-4 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-xs font-bold text-white">MCQ Negative Marking</h4>
                                        <p class="text-[10px] text-slate-500 mt-0.5">Deduct marks automatically for wrong MCQ answers</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="neg-marking-toggle" name="mcq_negative_marking" value="1" onchange="toggleNegativeMarkingFields(this)" class="sr-only peer">
                                        <div class="w-9 h-5 bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-slate-400 after:border-slate-350 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-indigo-600 peer-checked:after:bg-white"></div>
                                    </label>
                                </div>

                                <div id="negative-marking-details" class="hidden border-t border-slate-900 pt-3">
                                    <input type="hidden" name="mcq_negative_marking_mode" value="per_wrong">
                                    <input type="hidden" name="mcq_negative_marking_threshold_count" value="1">
                                    <div>
                                        <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Deduction Per Wrong Answer (Marks)</label>
                                        <input type="number" name="mcq_negative_marking_value" step="0.25" value="0.25" min="0" class="w-40 bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition text-center font-bold">
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Questions Container -->
                            <div class="border-t border-slate-800/80 pt-4 space-y-4">
                                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400">Questions List</h4>

                                <!-- Question card elements go here -->
                                <div id="test-questions-list" class="space-y-4">
                                    <!-- JS templates insert here -->
                                </div>

                                <!-- Add Question button below the list -->
                                <button type="button" onclick="addQuestion()" class="w-full border border-dashed border-indigo-500/40 hover:border-indigo-500/80 bg-indigo-600/5 hover:bg-indigo-600/10 text-indigo-400 hover:text-indigo-300 text-xs font-bold py-3 rounded-xl transition cursor-pointer flex items-center justify-center gap-2">
                                    <span class="text-base leading-none">+</span> Add Question
                                </button>
                            </div>

                            <!-- Submit Footer -->
                            <div class="border-t border-slate-800 pt-4 flex gap-3 flex-shrink-0">
                                <button type="button" id="form-back-btn" onclick="resetToCreateMode()" class="hidden flex-shrink-0 bg-slate-700/60 hover:bg-slate-700 border border-slate-600 text-slate-300 hover:text-white text-xs font-bold py-3.5 px-5 rounded-xl transition cursor-pointer flex items-center gap-2">
                                    ← Back
                                </button>
                                <button type="submit" id="question-maker-submit-btn" class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-3.5 px-6 rounded-xl transition cursor-pointer shadow-lg shadow-indigo-650/20 active:scale-[0.98]">
                                    Save &amp; Publish Test
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

                <!-- TAB CONTENT: TEACHER ASSIGNMENTS / HW -->
                <div id="tab-content-teacher-assignments" class="tab-pane hidden space-y-6">
                    <!-- Create Assignment Form -->
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <h3 class="text-sm font-bold text-white mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 rounded bg-purple-500/10 text-purple-400 flex items-center justify-center text-xs">+</span>
                            Assign New Homework / Assignment
                        </h3>
                        <p class="text-xs text-slate-400 mb-4">Post a new assignment or homework topic. Students will upload their submissions in file format.</p>
                        
                        <form action="{{ route('teacher.tasks.create') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <input type="hidden" name="is_test" value="0">
                            
                            <div>
                                <label class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Assignment Topic / Title</label>
                                <input type="text" name="title" required placeholder="e.g. Essay on Quantum Mechanics" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition">
                            </div>
                            <div>
                                <label class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Instructions / Description</label>
                                <textarea name="description" rows="3" placeholder="Provide topic details, questions, guidelines, and instructions..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition"></textarea>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Max Marks (Points)</label>
                                    <input type="number" name="points" required min="1" value="100" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition">
                                </div>
                                <div>
                                    <label class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Submission Deadline</label>
                                    <input type="date" name="due_date" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 focus:outline-none focus:border-purple-500 transition">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-[11px] py-2 px-6 rounded-xl shadow-md transition cursor-pointer">
                                    Publish Assignment
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Published Assignments List -->
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-base">📋</span>
                            <div>
                                <h3 class="text-sm font-bold text-white">Current Assignments</h3>
                                <p class="text-[11px] text-slate-400">View and manage deadlines of published homeworks/assignments.</p>
                            </div>
                        </div>

                        @php
                            $assignments = $course->tasks->where('is_test', false)->sortByDesc('created_at');
                        @endphp

                        @if($assignments->count() === 0)
                            <div class="text-center py-8 text-slate-500 italic text-xs">
                                No assignments published yet. Use the form above to assign homework.
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($assignments as $assignment)
                                    <div class="workspace-task-card bg-slate-900/60 rounded-xl p-4 border border-slate-850 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                        <div class="flex-grow">
                                            <h4 class="text-xs font-bold text-slate-200">{{ $assignment->title }}</h4>
                                            <p class="text-[11px] text-slate-400 mt-1">{{ Str::limit($assignment->description ?: 'No instructions provided.', 120) }}</p>
                                            <div class="flex flex-wrap gap-3 mt-2.5 text-[9px] text-slate-500">
                                                <span>Marks: <strong class="text-slate-400">{{ $assignment->points }} pts</strong></span>
                                                <span>Submissions: <strong class="text-slate-400">{{ $assignment->submissions->count() }}</strong></span>
                                                <span>Deadline: <strong class="text-slate-400">{{ $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y - H:i') : '—' }}</strong></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Extend Deadline form -->
                                        <div class="flex-shrink-0 bg-slate-950/20 p-2.5 rounded-lg border border-slate-850/60 max-w-xs">
                                            <label class="block text-[9px] text-slate-500 font-bold uppercase tracking-wider mb-1">Extend Deadline</label>
                                            <form action="{{ route('teacher.tasks.update', $assignment->id) }}" method="POST" class="flex gap-1.5">
                                                @csrf
                                                <input type="date" name="due_date" value="{{ $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('Y-m-d') : '' }}" required class="task-review-textarea bg-slate-950/40 border border-slate-800 rounded-lg py-1 px-2 text-[10px] text-slate-200 focus:outline-none focus:border-purple-500 transition">
                                                <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white font-bold text-[9px] py-1.5 px-3 rounded-lg shadow-sm transition cursor-pointer">
                                                    Extend
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- TAB CONTENT: EVALUATE SUBMISSIONS -->
                <div id="tab-content-evaluations" class="tab-pane hidden space-y-6">
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <div class="mb-6">
                            <h2 class="text-base font-bold text-white">Student Submission Evaluation Console</h2>
                            <p class="text-xs text-slate-400">Review student task completions and assign grades/feedback</p>
                        </div>

                        @if($submissions->count() === 0)
                            <div class="text-center py-16 text-slate-500 text-sm italic">
                                No student submissions found. Active student task completions will appear here.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider text-[10px]">
                                            <th class="py-3 px-4">Student</th>
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
                                                    @if($sub->review_requested && $sub->review_status === 'pending')
                                                        <span class="inline-block bg-rose-500/10 text-rose-400 border border-rose-500/25 px-2 py-0.5 rounded text-[9px] font-extrabold uppercase mt-1">⚠️ Review Requested</span>
                                                    @elseif($sub->review_requested && $sub->review_status === 'reviewed')
                                                        <span class="inline-block bg-emerald-500/10 text-emerald-400 border border-emerald-500/25 px-2 py-0.5 rounded text-[9px] font-bold uppercase mt-1">✅ Reviewed</span>
                                                    @endif
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

                                                    @if($sub->review_requested && $sub->review_reason)
                                                        <div class="mt-2 text-[10px] bg-slate-955/40 border border-slate-850 p-2 rounded-lg text-slate-300 max-w-xs">
                                                            <strong class="text-rose-400 font-semibold">Student's Review Reason:</strong>
                                                            <p class="italic mt-0.5 leading-normal">"{{ $sub->review_reason }}"</p>
                                                        </div>
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
                                                        data-neg-marking="{{ $sub->task->mcq_negative_marking ? 1 : 0 }}"
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
            @endif

        </main>

        @if(Auth::user()->isTeacher())
        <!-- Evaluation / Grading Modal -->
        <div id="grading-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-md hidden items-center justify-center p-4 overflow-y-auto">
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
        @endif

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-900/10 py-6 mt-12">
            <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-xs">
                &copy; {{ date('Y') }} EduTrack - Smart Education Ecosystem. All rights reserved.
            </div>
        </footer>

        <!-- Javascript Utilities -->
        <script>
            // 1. Theme Configuration (Removed)


            // 2. Tab Switching Logic
            function switchTab(tabId) {
                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });
                // Remove active class from all buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // Show current tab pane
                document.getElementById('tab-content-' + tabId).classList.remove('hidden');
                // Set button as active
                document.getElementById('tab-btn-' + tabId).classList.add('active');

                // Save last active tab in localStorage
                localStorage.setItem('active_course_tab_' + {{ $course->id }}, tabId);
            }

            // Load last active tab or default to 'details'
            document.addEventListener('DOMContentLoaded', () => {
                const savedTab = localStorage.getItem('active_course_tab_' + {{ $course->id }}) || 'details';
                if (document.getElementById('tab-btn-' + savedTab)) {
                    switchTab(savedTab);
                }

                const list = document.getElementById('test-questions-list');
                if (list && list.children.length === 0) {
                    addQuestion();
                }
            });

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
                    
                    // Show MCQ details summary if MCQ questions exist
                    const mcqDetails = answers.mcq_details || { correct: 0, wrong: 0, deduction: 0 };
                    if (questions.some(q => q.type === 'mcq')) {
                        const summaryDiv = document.createElement('div');
                        summaryDiv.className = "bg-indigo-950/20 border border-indigo-900/40 rounded-xl p-3 mb-4 grid grid-cols-3 gap-3 text-center";
                        summaryDiv.innerHTML = `
                            <div>
                                <span class="text-[9px] uppercase font-bold text-slate-500 block">MCQ Correct</span>
                                <span class="text-xs font-extrabold text-emerald-400">${mcqDetails.correct}</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold text-slate-500 block">MCQ Wrong</span>
                                <span class="text-xs font-extrabold text-rose-400">${mcqDetails.wrong}</span>
                            </div>
                            <div>
                                <span class="text-[9px] uppercase font-bold text-slate-500 block">Deduction</span>
                                <span class="text-xs font-extrabold text-amber-500">${parseFloat(mcqDetails.deduction).toFixed(2)} pts</span>
                            </div>
                        `;
                        qListContainer.appendChild(summaryDiv);
                    }

                    questions.forEach((q, idx) => {
                        const questionId = q.id;
                        const studentAnswer = answers[questionId] || '';
                        const scoreVal = questionGrades[questionId] !== undefined ? questionGrades[questionId] : '';
                        
                        const qRow = document.createElement('div');
                        qRow.className = 'py-3 space-y-2';
                        
                        let answerSnippet = '';
                        if (q.type === 'mcq') {
                            const isCorrect = studentAnswer.toLowerCase().trim() === (q.correct_answer || '').toLowerCase().trim();
                            answerSnippet = `
                                <div class="flex flex-col gap-1.5 mt-1 bg-slate-900/40 border border-slate-850 p-2.5 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] text-slate-500">Student Response:</span>
                                        <span class="text-[10px] px-2 py-0.5 rounded font-bold ${isCorrect ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20'}">
                                            ${studentAnswer || 'No Answer'}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] text-slate-500">Correct Option Key:</span>
                                        <select name="correct_answers[${questionId}]" onchange="handleCorrectAnswerChange(this, '${studentAnswer.replace(/'/g, "\\'")}', ${q.points}, ${questionId})" class="bg-slate-950 border border-slate-800 rounded-lg py-1 px-2.5 text-[10px] text-slate-300 outline-none focus:border-indigo-500 transition cursor-pointer">
                                            ${(q.options || []).map(opt => `
                                                <option value="${opt}" ${opt === q.correct_answer ? 'selected' : ''}>
                                                    ${opt}
                                                </option>
                                            `).join('')}
                                        </select>
                                    </div>
                                </div>
                            `;
                        } else if (q.type === 'written') {
                            answerSnippet = `
                                <div class="bg-slate-955/30 border border-slate-900 p-2.5 rounded-xl text-[11px] text-slate-300 leading-relaxed font-mono">
                                    ${studentAnswer || 'No Answer.'}
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
                                    <input type="number" name="question_scores[${questionId}]" value="${scoreVal}" required min="0" max="${q.points}" oninput="calculateGradingTotal()" class="question-grade-input w-16 bg-slate-900/60 border border-slate-800 rounded-xl py-1 px-2 text-xs font-bold text-slate-200 text-center outline-none focus:border-purple-500 transition" ${q.type === 'mcq' ? 'readonly tabindex="-1"' : ''}>
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
                    total += parseFloat(input.value || 0);
                });
                document.getElementById('grading-calculated-total').textContent = total;
            }

            function handleCorrectAnswerChange(select, studentAnswer, maxPoints, qId) {
                const scoreInput = document.querySelector(`input[name="question_scores[${qId}]"]`);
                if (scoreInput) {
                    if (select.value.toLowerCase().trim() === studentAnswer.toLowerCase().trim()) {
                        scoreInput.value = maxPoints;
                    } else {
                        scoreInput.value = 0;
                    }
                }
                
                // Update badge style dynamically
                const badge = select.closest('.flex-col').querySelector('.rounded');
                if (badge) {
                    const isCorrect = select.value.toLowerCase().trim() === studentAnswer.toLowerCase().trim();
                    if (isCorrect) {
                        badge.className = 'text-[10px] px-2 py-0.5 rounded font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
                    } else {
                        badge.className = 'text-[10px] px-2 py-0.5 rounded font-bold bg-rose-500/10 text-rose-400 border border-rose-500/20';
                    }
                }
                
                calculateGradingTotal();
            }

            function closeGradingModal() {
                const modal = document.getElementById('grading-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            // Auto-hide session status notifications after 5 seconds
            setTimeout(() => {
                const successToast = document.getElementById('toast-success');
                const errorToast = document.getElementById('toast-error');
                if (successToast) successToast.classList.add('opacity-0');
                if (errorToast) errorToast.classList.add('opacity-0');
                setTimeout(() => {
                    if (successToast) successToast.remove();
                    if (errorToast) errorToast.remove();
                }, 300);
            }, 5000);

            // Lecture Comment Reply Helper Functions
            function setLectureReplyParent(lectureId, parentId, userName) {
                const parentInput = document.getElementById(`lecture-parent-input-${lectureId}`);
                const replyIndicator = document.getElementById(`lecture-reply-indicator-${lectureId}`);
                const replyUserLabel = document.getElementById(`lecture-reply-user-${lectureId}`);
                
                if (parentInput) parentInput.value = parentId;
                if (replyUserLabel) replyUserLabel.textContent = userName;
                if (replyIndicator) replyIndicator.classList.remove('hidden');
                
                // Focus input
                if (parentInput && parentInput.form) {
                    const textInput = parentInput.form.querySelector('input[name="comment_text"]');
                    if (textInput) {
                        textInput.focus();
                        textInput.placeholder = `Reply to ${userName}...`;
                    }
                }
            }

            function cancelLectureReply(lectureId) {
                const parentInput = document.getElementById(`lecture-parent-input-${lectureId}`);
                const replyIndicator = document.getElementById(`lecture-reply-indicator-${lectureId}`);
                
                if (parentInput) parentInput.value = '';
                if (replyIndicator) replyIndicator.classList.add('hidden');
                
                if (parentInput && parentInput.form) {
                    const textInput = parentInput.form.querySelector('input[name="comment_text"]');
                    if (textInput) {
                        textInput.placeholder = "Write a comment or click Reply...";
                    }
                }
            }

            function toggleCommentsSection(lectureId) {
                const section = document.getElementById(`comments-section-${lectureId}`);
                if (section) {
                    section.classList.toggle('hidden');
                }
            }

            function toggleLikeAjax(lectureId, url) {
                const btn = document.querySelector(`.like-btn-${lectureId}`);
                if (!btn) return;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                    || document.querySelector('input[name="_token"]')?.value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const textSpan = btn.querySelector('.like-text');
                        const countSpan = btn.querySelector('.like-count');
                        
                        if (data.liked) {
                            btn.classList.add('liked-active');
                            textSpan.textContent = 'Liked';
                        } else {
                            btn.classList.remove('liked-active');
                            textSpan.textContent = 'Like';
                        }
                        
                        countSpan.textContent = data.count;
                        if (data.count > 0) {
                            countSpan.classList.remove('hidden');
                        } else {
                            countSpan.classList.add('hidden');
                        }
                    }
                })
                .catch(err => console.error(err));
            }

            function toggleLikeNoteAjax(noteId, url) {
                const btn = document.querySelector(`.like-btn-note-${noteId}`);
                if (!btn) return;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                    || document.querySelector('input[name="_token"]')?.value;

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const textSpan = btn.querySelector('.like-text');
                        const countSpan = btn.querySelector('.like-count');
                        
                        if (data.liked) {
                            btn.classList.add('liked-active');
                            textSpan.textContent = 'Liked';
                        } else {
                            btn.classList.remove('liked-active');
                            textSpan.textContent = 'Like';
                        }
                        
                        countSpan.textContent = data.count;
                        if (data.count > 0) {
                            countSpan.classList.remove('hidden');
                        } else {
                            countSpan.classList.add('hidden');
                        }
                    }
                })
                .catch(err => console.error(err));
            }

            function toggleNoteCommentsSection(noteId) {
                const section = document.getElementById(`note-comments-section-${noteId}`);
                if (section) {
                    section.classList.toggle('hidden');
                }
            }

            // Dynamic Question Builder JS
            let questionCount = 0;
            function addQuestion() {
                const list = document.getElementById('test-questions-list');
                if (!list) return;
                const index = questionCount++;
                
                const qBlock = document.createElement('div');
                qBlock.id = `q-block-${index}`;
                qBlock.className = 'bg-slate-955/60 border border-slate-800/80 rounded-xl p-4 space-y-4 relative shadow-md';
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
                        <label class="block text-[10px] text-slate-500 font-bold uppercase">MCQ Choice Options (Check the correct option)</label>
                        <div id="options-container-${index}" class="space-y-2">
                            <div class="flex items-center gap-2 option-row">
                                <input type="radio" name="questions[${index}][correct_option_index]" value="0" checked class="w-3.5 h-3.5 text-indigo-600 bg-slate-900 border-slate-800 focus:ring-indigo-500 cursor-pointer">
                                <span class="text-xs text-slate-500 font-mono">1.</span>
                                <input type="text" name="questions[${index}][options][]" value="Option A" class="bg-slate-900/60 border border-slate-850 rounded-xl py-1 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition flex-grow">
                                <button type="button" onclick="removeOption(this)" class="text-slate-500 hover:text-red-400 font-bold text-xs cursor-pointer">&times;</button>
                            </div>
                            <div class="flex items-center gap-2 option-row">
                                <input type="radio" name="questions[${index}][correct_option_index]" value="1" class="w-3.5 h-3.5 text-indigo-600 bg-slate-900 border-slate-800 focus:ring-indigo-500 cursor-pointer">
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
                    <input type="radio" name="questions[${qIndex}][correct_option_index]" value="${rowsCount}" class="w-3.5 h-3.5 text-indigo-600 bg-slate-900 border-slate-800 focus:ring-indigo-500 cursor-pointer">
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
                        child.querySelector('input[type="radio"]').value = idx;
                    });
                }
            }

            function updateTotalPoints() {
                let sum = 0;
                document.querySelectorAll('.points-input').forEach(input => {
                    sum += parseInt(input.value || 0);
                });
                const totalMarksEl = document.getElementById('builder-total-marks');
                if (totalMarksEl) totalMarksEl.textContent = sum;
            }

            function toggleNegativeMarkingFields(checkbox) {
                const details = document.getElementById('negative-marking-details');
                if (checkbox.checked) {
                    details.classList.remove('hidden');
                } else {
                    details.classList.add('hidden');
                }
            }

            /**
             * Load an existing task into the Question Maker for editing.
             */
            function loadTaskForEdit(task) {
                const form = document.getElementById('question-maker-form');
                const taskIdInput = document.getElementById('edit-task-id');
                const heading = document.getElementById('question-maker-heading');
                const subtitle = document.getElementById('question-maker-subtitle');
                const submitBtn = document.getElementById('question-maker-submit-btn');
                const resetBtn = document.getElementById('reset-to-create-btn');
                const backBtn = document.getElementById('form-back-btn');
                const questionList = document.getElementById('test-questions-list');
                const negMarkingToggle = document.getElementById('neg-marking-toggle');

                // Update form action to the update route
                form.action = `/teacher/tasks/${task.id}/update`;
                taskIdInput.value = task.id;

                // Update heading
                heading.textContent = 'Edit Test';
                subtitle.textContent = `Editing: ${task.title}`;

                // Update submit button
                submitBtn.textContent = '🔄 Save & Republish';
                submitBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-500');
                submitBtn.classList.add('bg-amber-600', 'hover:bg-amber-500');

                // Show reset button and back button
                resetBtn.classList.remove('hidden');
                if (backBtn) backBtn.classList.remove('hidden');

                // Fill in meta fields
                form.querySelector('[name="title"]').value = task.title || '';
                form.querySelector('[name="description"]').value = task.description || '';
                form.querySelector('[name="due_date"]').value = task.due_date || '';
                const durationField = form.querySelector('[name="duration_minutes"]');
                if (durationField) durationField.value = task.duration_minutes || 60;

                // Negative marking
                if (negMarkingToggle) {
                    negMarkingToggle.checked = task.mcq_negative_marking;
                    toggleNegativeMarkingFields(negMarkingToggle);
                }
                const negValueField = form.querySelector('[name="mcq_negative_marking_value"]');
                if (negValueField) negValueField.value = task.mcq_negative_marking_value || 0.25;

                // Clear existing questions
                questionList.innerHTML = '';
                questionCount = 0;

                // Re-build questions from task data
                (task.questions || []).forEach((q) => {
                    const index = questionCount++;
                    const qBlock = document.createElement('div');
                    qBlock.id = `q-block-${index}`;
                    qBlock.className = 'bg-slate-955/60 border border-slate-800/80 rounded-xl p-4 space-y-4 relative shadow-md';

                    const isMcq = q.type === 'mcq';
                    const optionsHtml = isMcq ? (q.options || []).map((opt, oIdx) => `
                        <div class="flex items-center gap-2 option-row">
                            <input type="radio" name="questions[${index}][correct_option_index]" value="${oIdx}" ${q.correct_answer === opt ? 'checked' : ''} class="w-3.5 h-3.5 text-indigo-600 bg-slate-900 border-slate-800 focus:ring-indigo-500 cursor-pointer">
                            <span class="text-xs text-slate-500 font-mono">${oIdx + 1}.</span>
                            <input type="text" name="questions[${index}][options][]" value="${opt}" class="bg-slate-900/60 border border-slate-850 rounded-xl py-1 px-3 text-xs text-slate-300 outline-none focus:border-indigo-500 transition flex-grow">
                            <button type="button" onclick="removeOption(this)" class="text-slate-500 hover:text-red-400 font-bold text-xs cursor-pointer">&times;</button>
                        </div>
                    `).join('') : '';

                    qBlock.innerHTML = `
                        <input type="hidden" name="questions[${index}][existing_id]" value="${q.id || ''}">
                        <button type="button" onclick="removeQuestion(${index})" class="absolute top-4 right-4 text-xs text-red-400 hover:text-red-300 font-semibold cursor-pointer">🗑️ Delete</button>
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                            <div class="md:col-span-7">
                                <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Question ${index + 1} Text</label>
                                <input type="text" name="questions[${index}][text]" required value="${(q.text || '').replace(/"/g, '&quot;')}" placeholder="e.g. Write a brief history of Turing Machines." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition">
                            </div>
                            <div class="md:col-span-3">
                                <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Question Type</label>
                                <select name="questions[${index}][type]" onchange="handleTypeChange(this, ${index})" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-400 outline-none focus:border-indigo-500 transition cursor-pointer">
                                    <option value="written" ${q.type === 'written' ? 'selected' : ''}>Written Text Response</option>
                                    <option value="mcq" ${q.type === 'mcq' ? 'selected' : ''}>Multiple Choice (MCQ)</option>
                                    <option value="file" ${q.type === 'file' ? 'selected' : ''}>File Upload (Notebook / Khata)</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[10px] text-slate-500 font-bold uppercase mb-1">Marks</label>
                                <input type="number" name="questions[${index}][points]" required value="${q.points || 5}" min="1" oninput="updateTotalPoints()" class="points-input w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-xs text-slate-200 outline-none focus:border-indigo-500 transition text-center font-bold">
                            </div>
                        </div>
                        <!-- MCQ Options block -->
                        <div id="options-block-${index}" class="${isMcq ? '' : 'hidden'} pl-4 border-l-2 border-indigo-500/20 space-y-2">
                            <label class="block text-[10px] text-slate-500 font-bold uppercase">MCQ Choice Options (Check the correct option)</label>
                            <div id="options-container-${index}" class="space-y-2">${optionsHtml}</div>
                            <button type="button" onclick="addOption(${index})" class="text-[10px] text-indigo-400 hover:text-indigo-300 font-semibold cursor-pointer">+ Add Choice Option</button>
                        </div>
                    `;

                    questionList.appendChild(qBlock);
                });

                updateTotalPoints();

                // Scroll to the Question Maker
                form.closest('.glass-panel').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            /**
             * Reset the Question Maker back to "create new test" mode.
             */
            function resetToCreateMode() {
                const form = document.getElementById('question-maker-form');
                const taskIdInput = document.getElementById('edit-task-id');
                const heading = document.getElementById('question-maker-heading');
                const subtitle = document.getElementById('question-maker-subtitle');
                const submitBtn = document.getElementById('question-maker-submit-btn');
                const resetBtn = document.getElementById('reset-to-create-btn');
                const backBtn = document.getElementById('form-back-btn');
                const questionList = document.getElementById('test-questions-list');
                const negMarkingToggle = document.getElementById('neg-marking-toggle');

                form.action = '{{ route("teacher.tasks.create") }}';
                taskIdInput.value = '';
                heading.textContent = 'EduTrack Question Maker';
                subtitle.textContent = 'Design exam papers with dynamic question distribution';
                submitBtn.textContent = 'Save & Publish Test';
                submitBtn.classList.add('bg-indigo-600', 'hover:bg-indigo-500');
                submitBtn.classList.remove('bg-amber-600', 'hover:bg-amber-500');
                resetBtn.classList.add('hidden');
                if (backBtn) backBtn.classList.add('hidden');

                // Clear form fields
                form.querySelector('[name="title"]').value = '';
                form.querySelector('[name="description"]').value = '';
                form.querySelector('[name="due_date"]').value = '';
                const durationField = form.querySelector('[name="duration_minutes"]');
                if (durationField) durationField.value = 60;

                if (negMarkingToggle) {
                    negMarkingToggle.checked = false;
                    toggleNegativeMarkingFields(negMarkingToggle);
                }

                questionList.innerHTML = '';
                questionCount = 0;
                updateTotalPoints();
            }
        </script>
    </body>
</html>
