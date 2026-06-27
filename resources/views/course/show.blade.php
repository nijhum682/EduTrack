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
                    <!-- Theme Switcher Button -->
                    <button id="theme-toggle" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2.5 rounded-xl border border-slate-700/50 transition cursor-pointer flex items-center justify-center" title="Toggle Theme">
                    </button>

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
            <div class="flex flex-wrap gap-2 border-b border-slate-800/60 pb-3 mb-8">
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
                <!-- If teacher, show "Add Class/Lecture" form -->
                @if(Auth::user()->isTeacher())
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                        <h2 class="text-base font-bold text-white mb-4">Upload New Lecture / Class Detail</h2>
                        <form action="{{ route('teacher.lectures.create', $course->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Number / Code</label>
                                    <input type="text" name="lecture_number" placeholder="e.g. Lecture 01" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Name / Topic</label>
                                    <input type="text" name="name" placeholder="e.g. Intro to Operating System Kernels" required class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs text-slate-400 font-semibold mb-1">Lecture Details / Notes</label>
                                <textarea name="details" rows="3" placeholder="Syllabus coverage, reference reading material, youtube/drive links..." class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-purple-500 transition"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-xs py-2 px-6 rounded-xl shadow transition cursor-pointer">
                                    💾 Save & Publish Lecture
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- List of Lectures -->
                <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Course Lectures & Classes</h2>
                    @if($course->lectures->count() === 0)
                        <div class="text-center py-12 text-slate-500 text-sm italic">
                            No lectures or classes have been uploaded for this course yet.
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($course->lectures as $lecture)
                                <div class="border border-slate-800/60 bg-slate-900/10 rounded-xl p-5 flex flex-col md:flex-row md:items-start gap-4 transition duration-300">
                                    <div class="flex-shrink-0">
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-extrabold bg-purple-500/10 text-purple-300 border border-purple-500/20 uppercase tracking-wide block text-center md:inline-block">
                                            {{ $lecture->lecture_number }}
                                        </span>
                                    </div>
                                    <div class="flex-grow space-y-2">
                                        <h3 class="text-base font-bold text-white">{{ $lecture->name }}</h3>
                                        <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $lecture->details ?: 'No details provided.' }}</p>
                                        <span class="text-[10px] text-slate-500 block">Uploaded on {{ $lecture->created_at->format('M d, Y H:i') }}</span>
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
                                <div class="border border-slate-800/60 bg-slate-900/10 rounded-xl p-5 flex items-start gap-4 hover:border-indigo-500/30 transition-all duration-300">
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

        </main>

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-900/10 py-6 mt-12">
            <div class="max-w-7xl mx-auto px-4 text-center text-slate-500 text-xs">
                &copy; {{ date('Y') }} EduTrack - Smart Education Ecosystem. All rights reserved.
            </div>
        </footer>

        <!-- Javascript Utilities -->
        <script>
            // 1. Theme Configuration
            const themeToggle = document.getElementById('theme-toggle');
            
            const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m0 13.5V21M4.978 4.978l1.591 1.591m10.862 10.862l1.591 1.591M21 12h-2.25m-13.5 0H3m14.022-7.022l-1.591 1.591M6.569 17.43l-1.591 1.591M12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9z" /></svg>`;
            const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>`;

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

            function updateThemeToggleIcon(theme) {
                if (theme === 'theme-space-dark') {
                    themeToggle.innerHTML = sunIcon;
                } else {
                    themeToggle.innerHTML = moonIcon;
                }
            }

            // Apply theme on page load
            const currentTheme = getCookie('dashboard_theme') || 'theme-space-dark';
            document.body.className = currentTheme;
            updateThemeToggleIcon(currentTheme);

            themeToggle.addEventListener('click', function () {
                const newTheme = document.body.classList.contains('theme-space-dark') 
                    ? 'theme-space-light' 
                    : 'theme-space-dark';
                
                document.body.className = newTheme;
                setCookie('dashboard_theme', newTheme, 30);
                updateThemeToggleIcon(newTheme);
            });

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
            });

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
        </script>
    </body>
</html>
