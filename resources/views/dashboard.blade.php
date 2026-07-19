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
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(243, 244, 255, 0.88) 100%) !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border: 1px solid rgba(139, 92, 246, 0.12) !important;
                box-shadow: 0 10px 30px -10px rgba(139, 92, 246, 0.08), 0 4px 12px -2px rgba(99, 102, 241, 0.03) !important;
            }
            body.theme-space-light .glass-card {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.88) 0%, rgba(240, 242, 255, 0.82) 100%) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                border: 1px solid rgba(139, 92, 246, 0.1) !important;
                box-shadow: 0 8px 24px -8px rgba(139, 92, 246, 0.06) !important;
            }
            body.theme-space-light input,
            body.theme-space-light select {
                background-color: rgba(245, 243, 255, 0.7) !important;
                border-color: rgba(167, 139, 250, 0.3) !important;
                color: #0f172a !important;
                box-shadow: inset 0 2px 4px rgba(109, 40, 217, 0.03), 0 4px 12px rgba(139, 92, 246, 0.02) !important;
                transition: all 0.2s ease-in-out !important;
            }
            body.theme-space-light input:focus,
            body.theme-space-light select:focus {
                background-color: #ffffff !important;
                border-color: #8b5cf6 !important;
                box-shadow: inset 0 2px 4px rgba(139, 92, 246, 0.05), 0 4px 16px rgba(139, 92, 246, 0.08) !important;
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
            body.theme-space-light .bg-slate-950\/30,
            body.theme-space-light .bg-slate-950\/40,
            body.theme-space-light .bg-slate-900\/60,
            body.theme-space-light .bg-slate-900\/10,
            body.theme-space-light .bg-slate-950\/20,
            body.theme-space-light .bg-slate-900\/30 {
                background-color: #edf1f7 !important;
                border-color: #cbd5e1 !important;
            }
            body.theme-space-light .bg-slate-900\/50 {
                background-color: #edf1f7 !important;
            }
            body.theme-space-light .bg-slate-800\/50 {
                background-color: #edf1f7 !important;
            }
            body.theme-space-light .bg-slate-900\/40 {
                background-color: #f1f5f9 !important;
            }
            body.theme-space-light .bg-slate-950 {
                background-color: #e2e8f0 !important;
            }
            body.theme-space-light .bg-slate-900 {
                background-color: #edf1f7 !important;
            }
            body.theme-space-light .bg-slate-800 {
                background-color: rgba(15, 23, 42, 0.06) !important;
            }
            body.theme-space-light header {
                background-color: #e2e8f0 !important;
                border-color: #cbd5e1 !important;
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
            body.theme-space-light button,
            body.theme-space-light input[type="submit"],
            body.theme-space-light a.bg-indigo-600,
            body.theme-space-light a.bg-indigo-650,
            body.theme-space-light a.bg-purple-600 {
                color: #000000 !important;
                background: #ffffff !important;
                background-image: none !important;
                border: 1px solid #cbd5e1 !important;
            }
            body.theme-space-light button:hover,
            body.theme-space-light input[type="submit"]:hover,
            body.theme-space-light a.bg-indigo-600:hover,
            body.theme-space-light a.bg-indigo-650:hover,
            body.theme-space-light a.bg-purple-600:hover {
                color: #000000 !important;
                background: #f1f5f9 !important;
            }

            /* Light-blue Enroll Now button in light theme */
            body.theme-space-light button.bg-sky-500,
            body.theme-space-light button.enroll-action-btn:not(:disabled),
            body.theme-space-light .enroll-action-btn:not(:disabled) {
                background-color: #38bdf8 !important;
                color: #ffffff !important;
                border: 1px solid rgba(56, 189, 248, 0.2) !important;
                box-shadow: 0 4px 12px rgba(56, 189, 248, 0.25) !important;
            }
            body.theme-space-light button.bg-sky-500:hover,
            body.theme-space-light button.enroll-action-btn:not(:disabled):hover,
            body.theme-space-light .enroll-action-btn:not(:disabled):hover {
                background-color: #0ea5e9 !important;
                color: #ffffff !important;
            }

            /* Pink status badges and See Class button in light theme */
            body.theme-space-light .status-badge,
            body.theme-space-light a.bg-pink-600,
            body.theme-space-light button.bg-pink-600 {
                background-color: #ec4899 !important; /* pink-500 */
                color: #ffffff !important;
                border: 1px solid rgba(236, 72, 153, 0.2) !important;
            }
            body.theme-space-light .status-badge:hover,
            body.theme-space-light a.bg-pink-600:hover,
            body.theme-space-light button.bg-pink-600:hover {
                background-color: #db2777 !important; /* pink-600 */
                color: #ffffff !important;
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
            body.theme-space-light .text-purple-300,
            body.theme-space-light .text-purple-400,
            body.theme-space-light .text-purple-500 {
                color: #6d28d9 !important;
            }
            body.theme-space-light .text-indigo-300,
            body.theme-space-light .text-indigo-400,
            body.theme-space-light .text-indigo-500 {
                color: #4338ca !important;
            }
            body.theme-space-light .text-emerald-300,
            body.theme-space-light .text-emerald-400,
            body.theme-space-light .text-emerald-500 {
                color: #047857 !important;
            }
            body.theme-space-light .text-rose-300,
            body.theme-space-light .text-rose-400,
            body.theme-space-light .text-rose-50 {
                color: #be123c !important;
            }
            body.theme-space-light .text-amber-300,
            body.theme-space-light .text-amber-400,
            body.theme-space-light .text-amber-500 {
                color: #b45309 !important;
            }
            body.theme-space-light .bg-purple-500\/10,
            body.theme-space-light .bg-purple-500\/20,
            body.theme-space-light .bg-purple-50 {
                background-color: rgba(139, 92, 246, 0.12) !important;
                border-color: rgba(139, 92, 246, 0.3) !important;
            }
            body.theme-space-light .bg-indigo-500\/10,
            body.theme-space-light .bg-indigo-500\/20,
            body.theme-space-light .bg-indigo-50 {
                background-color: rgba(99, 102, 241, 0.12) !important;
                border-color: rgba(99, 102, 241, 0.3) !important;
            }
            body.theme-space-light .bg-emerald-500\/10,
            body.theme-space-light .bg-emerald-500\/20,
            body.theme-space-light .bg-emerald-50 {
                background-color: rgba(16, 185, 129, 0.12) !important;
                border-color: rgba(16, 185, 129, 0.3) !important;
            }
            body.theme-space-light .bg-rose-500\/10,
            body.theme-space-light .bg-rose-500\/20,
            body.theme-space-light .bg-rose-50 {
                background-color: rgba(244, 63, 94, 0.12) !important;
                border-color: rgba(244, 63, 94, 0.3) !important;
            }
            body.theme-space-light .bg-amber-500\/10,
            body.theme-space-light .bg-amber-500\/20,
            body.theme-space-light .bg-amber-50 {
                background-color: rgba(245, 158, 11, 0.12) !important;
                border-color: rgba(245, 158, 11, 0.3) !important;
            }
            body.theme-space-light .dark\:text-purple-300,
            body.theme-space-light .dark\:text-purple-400 {
                color: #6d28d9 !important;
            }
            body.theme-space-light .dark\:bg-purple-950\/40,
            body.theme-space-light .dark\:bg-purple-900\/50 {
                background-color: rgba(139, 92, 246, 0.12) !important;
            }
            body.theme-space-light .dark\:border-purple-800\/60,
            body.theme-space-light .dark\:border-purple-850 {
                border-color: rgba(139, 92, 246, 0.3) !important;
            }
            body.theme-space-light .dark\:text-indigo-300,
            body.theme-space-light .dark\:text-indigo-400 {
                color: #4338ca !important;
            }
            body.theme-space-light .dark\:bg-indigo-950\/40,
            body.theme-space-light .dark\:bg-indigo-900\/50 {
                background-color: rgba(99, 102, 241, 0.12) !important;
            }
            body.theme-space-light .dark\:border-indigo-800\/60,
            body.theme-space-light .dark\:border-indigo-850 {
                border-color: rgba(99, 102, 241, 0.3) !important;
            }
            body.theme-space-light .dark\:text-emerald-300,
            body.theme-space-light .dark\:text-emerald-400 {
                color: #047857 !important;
            }
            body.theme-space-light .dark\:bg-emerald-950\/40,
            body.theme-space-light .dark\:bg-emerald-900\/50 {
                background-color: rgba(16, 185, 129, 0.12) !important;
            }
            body.theme-space-light .dark\:border-emerald-800\/60,
            body.theme-space-light .dark\:border-emerald-850 {
                border-color: rgba(16, 185, 129, 0.3) !important;
            }
            /* Toast readability styling overrides for light theme */
            body.theme-space-light .toast-item.bg-emerald-950\/90 {
                background-color: #ecfdf5 !important; /* light green background */
                border-color: #a7f3d0 !important; /* light green border */
                color: #065f46 !important; /* dark green text */
            }
            body.theme-space-light .toast-item.bg-emerald-950\/90 span {
                color: #065f46 !important;
            }
            body.theme-space-light .toast-item.bg-emerald-950\/90 button {
                color: #047857 !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }
            body.theme-space-light .toast-item.bg-emerald-950\/90 button:hover {
                color: #065f46 !important;
                background: rgba(4, 120, 87, 0.1) !important;
            }
            
            body.theme-space-light .toast-item.bg-red-950\/90,
            body.theme-space-light .toast-item.bg-rose-950\/90 {
                background-color: #fff1f2 !important; /* light red background */
                border-color: #fecdd3 !important; /* light red border */
                color: #9f1239 !important; /* dark red text */
            }
            body.theme-space-light .toast-item.bg-red-950\/90 span,
            body.theme-space-light .toast-item.bg-rose-950\/90 span {
                color: #9f1239 !important;
            }
            body.theme-space-light .toast-item.bg-red-950\/90 button,
            body.theme-space-light .toast-item.bg-rose-950\/90 button {
                color: #be123c !important;
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
            }
            body.theme-space-light .toast-item.bg-red-950\/90 button:hover,
            body.theme-space-light .toast-item.bg-rose-950\/90 button:hover {
                color: #9f1239 !important;
                background: rgba(190, 18, 60, 0.1) !important;
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
                </div>
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-indigo-600/10 rounded-full blur-3xl -z-1"></div>
            </div>

            <!-- Dashboard Statistics Cards (Values populated dynamically via API Controller) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
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

                <!-- Stat 2: Total Course Fees -->
                <div class="glass-panel rounded-2xl p-6 shadow-md border border-slate-800/80 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total Course Fees</span>
                        <div class="w-8 h-8 rounded-lg bg-purple-500/10 flex items-center justify-center text-purple-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-3xl font-extrabold text-white" id="stat-total-credits">-</div>
                    <p class="text-slate-500 text-[10px] mt-1" id="stat-total-credits-sub">Total fee for active courses</p>
                </div>
            </div>

            <!-- Course Catalog & Workspace Layout Wrapper -->
            <div class="space-y-8">
                
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
                                    <input type="text" id="catalog-search" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 pl-9 pr-4 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-indigo-500/80 focus:ring-1 focus:ring-indigo-500/30 transition" placeholder="Search by title or course code...">
                                </div>
                                <div class="w-full sm:w-44">
                                    <select id="catalog-class" class="w-full bg-slate-900/60 border border-slate-800 rounded-xl py-2 px-3 text-sm text-slate-400 focus:outline-none focus:border-indigo-500/80 focus:ring-1 focus:ring-indigo-500/30 transition cursor-pointer">
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

                <!-- User-Specific Courses (Enrolled Courses for Students, Offered Courses for Teachers) -->
                <section id="user-courses-section" class="hidden">
                    <div class="glass-panel rounded-3xl p-6 border border-slate-800/80 shadow-lg">
                        <div class="mb-6">
                            <h2 id="user-courses-title" class="text-xl font-extrabold text-white tracking-tight">Enrolled Courses</h2>
                            <p id="user-courses-subtitle" class="text-xs text-slate-400 mt-1">Courses you are currently participating in</p>
                        </div>
                        <div id="user-courses-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>
                </section>


        </div>
    </main>

        <!-- Footer -->
        <footer class="border-t border-slate-800/80 bg-slate-950/40 py-6 text-center text-xs text-slate-500">
            <p>&copy; 2026 EduTrack</p>
        </footer>

        <!-- Javascript AJAX & Frontend Logic: Javascript -->
        <script>
            // Document Ready configuration
            document.addEventListener('DOMContentLoaded', function () {
                
                // Global role configuration
                const isStudent = {{ Auth::user()->isStudent() ? 'true' : 'false' }};
                const currentUserId = {{ Auth::id() }};

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
                const catalogClassSelect = document.getElementById('catalog-class');
                const courseCatalogList = document.getElementById('course-catalog-list');
                const workspaceContainer = document.getElementById('workspace-container');

                // User specific course section selectors
                const userCoursesSection = document.getElementById('user-courses-section');
                const userCoursesTitle = document.getElementById('user-courses-title');
                const userCoursesSubtitle = document.getElementById('user-courses-subtitle');
                const userCoursesList = document.getElementById('user-courses-list');

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
                            
                            statTotalCredits.textContent = stats.total_credits === 0 ? 'Free' : '৳' + stats.total_credits;
                            
                            if (statTaskPercentage) {
                                statTaskPercentage.textContent = `${stats.completion_percentage}%`;
                            }
                            if (statTaskProgressBar) {
                                statTaskProgressBar.style.width = `${stats.completion_percentage}%`;
                            }
                            if (statTaskCount) {
                                statTaskCount.textContent = `${stats.completed_tasks_count} of ${stats.total_tasks_count} completed`;
                            }

                            if (statOverallGrade) {
                                statOverallGrade.textContent = stats.overall_grade;
                                if (stats.overall_grade === 'N/A') {
                                    statOverallGrade.className = 'text-3xl font-extrabold text-slate-500';
                                } else if (stats.overall_grade === 'A+' || stats.overall_grade === 'A') {
                                    statOverallGrade.className = 'text-3xl font-extrabold text-emerald-400';
                                } else {
                                    statOverallGrade.className = 'text-3xl font-extrabold text-indigo-400';
                                }
                            }
                        }
                    } catch (error) {
                        console.error('Failed to load user stats:', error);
                    }
                }

                // Asynchronous Function: Load Course Catalog & Workspace Courses
                async function loadCoursesData() {
                    const query = catalogSearchInput.value;
                    const classVal = catalogClassSelect.value;
                    
                    try {
                        // Retrieve filtered list from API
                        const response = await fetch(`/api/courses?q=${encodeURIComponent(query)}&class=${encodeURIComponent(classVal)}`);
                        const data = await response.json();
                        
                        if (data.success) {
                            renderCatalog(data.courses);
                            renderUserCourses(data.courses);
                            renderWorkspace(data.courses.filter(c => c.is_enrolled));
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
                                // Students cannot unenroll - show disabled/styled "Enrolled" button
                                btnClass = 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/25 w-full justify-center cursor-not-allowed';
                                btnText = 'Enrolled';
                                action = 'none';
                                isDisabled = 'disabled';
                            } else {
                                // Teachers/admins can unenroll
                                btnClass = 'bg-rose-500/10 hover:bg-rose-500/25 text-rose-400 border border-rose-500/25 w-full justify-center';
                                btnText = 'Unenroll';
                                action = 'unenroll';
                            }
                        } else {
                            btnClass = 'bg-sky-500 hover:bg-sky-400 text-white shadow-md shadow-sky-500/20 w-full justify-center';
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
                        filtered = courses.filter(c => c.instructor_id === currentUserId);
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
                        // Dynamic background image index (bg1 for 1st course, bg2 for 2nd...)
                        const bgIndex = (index % 5) + 1;
                        const bgUrl = course.image_path ? `/${course.image_path}` : `/images/bg${bgIndex}.jpg`;

                        // Rating calculation
                        const ratingValue = course.average_rating ? course.average_rating.toFixed(1) : '4.5';

                        // Action details
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

                // Helper: Render My Enrolled Workspace & Task Completion Lists (Right Column)
                function renderWorkspace(enrolledCourses) {
                    if (!workspaceContainer) return;
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
                                    <a href="/course/${course.id}" class="hover:underline transition">
                                        <h3 class="text-xs font-extrabold uppercase tracking-wide text-indigo-400 hover:text-indigo-300">${course.code} &middot; ${course.title} ↗</h3>
                                    </a>
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
                                const lineStrike = isCompleted ? 'text-slate-500' : 'text-slate-200';
                                
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
                                label.classList.add('text-slate-500');
                                label.classList.remove('text-slate-200');
                                showToast('Task marked as completed.');
                            } else {
                                label.classList.remove('text-slate-500');
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

                // Class Select Change Event
                catalogClassSelect.addEventListener('change', loadCoursesData);


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
        <div id="profile-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-md">
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
