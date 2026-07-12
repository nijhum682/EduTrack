<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up - EduTrack</title>

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
                    url('{{ asset('images/header-image.png') }}') !important;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
            
            body.theme-space-light {
                background-color: #f8fafc;
                background-image: 
                    linear-gradient(135deg, rgba(255, 255, 255, 0.84) 0%, rgba(237, 244, 254, 0.84) 65%, rgba(218, 231, 252, 0.84) 100%),
                    url('{{ asset('images/header-image.png') }}') !important;
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }

            /* Light mode overrides for auth page */
            body.theme-space-light {
                color: #0f172a !important;
            }
            body.theme-space-light h2,
            body.theme-space-light label {
                color: #0f172a !important;
            }
            body.theme-space-light .text-slate-400 {
                color: #475569 !important;
            }
            body.theme-space-light .bg-slate-900\/60 {
                background: rgba(255, 255, 255, 0.6) !important;
                backdrop-filter: blur(16px) !important;
                border-color: rgba(15, 23, 42, 0.08) !important;
                box-shadow: 0 10px 35px rgba(15, 23, 42, 0.05) !important;
            }
            body.theme-space-light input,
            body.theme-space-light select {
                background: rgba(255, 255, 255, 0.8) !important;
                border-color: rgba(15, 23, 42, 0.12) !important;
                color: #0f172a !important;
            }
            body.theme-space-light input::placeholder {
                color: #94a3b8 !important;
            }
            body.theme-space-light .text-indigo-400 {
                color: #4f46e5 !important;
            }
            body.theme-space-light .text-indigo-400:hover {
                color: #4338ca !important;
            }
            body.theme-space-light button[type="submit"] {
                color: #ffffff !important;
            }

            /* Dark mode readability & opacity improvements */
            body.theme-space-dark .bg-slate-900\/60 {
                background: rgba(23, 31, 52, 0.75) !important;
                border-color: rgba(255, 255, 255, 0.12) !important;
            }
            body.theme-space-dark input,
            body.theme-space-dark select {
                background-color: rgba(15, 23, 42, 0.7) !important;
                border-color: rgba(255, 255, 255, 0.15) !important;
                color: #ffffff !important;
            }
            body.theme-space-dark input::placeholder {
                color: #94a3b8 !important;
            }
            body.theme-space-dark label {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .text-slate-400 {
                color: #cbd5e1 !important;
            }

            /* Autocomplete / Autofill custom overrides */
            input:-webkit-autofill,
            input:-webkit-autofill:hover, 
            input:-webkit-autofill:focus, 
            input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0 30px #090e18 inset !important;
                -webkit-text-fill-color: #ffffff !important;
                transition: background-color 5000s ease-in-out 0s;
            }
            body.theme-space-light input:-webkit-autofill,
            body.theme-space-light input:-webkit-autofill:hover, 
            body.theme-space-light input:-webkit-autofill:focus, 
            body.theme-space-light input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
                -webkit-text-fill-color: #0f172a !important;
                transition: background-color 5000s ease-in-out 0s;
            }

            /* Theme Toggle Button custom styles */
            #theme-toggle {
                background: rgba(15, 23, 42, 0.05);
                color: #0f172a;
                border: 1px solid rgba(15, 23, 42, 0.1);
                border-radius: 0.75rem;
                padding: 0.6rem;
                cursor: pointer;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
            body.theme-space-dark #theme-toggle {
                background: rgba(255, 255, 255, 0.05) !important;
                color: #f8fafc !important;
                border-color: rgba(255, 255, 255, 0.1) !important;
            }
            #theme-toggle:hover {
                transform: scale(1.05);
            }
        </style>
    </head>
    <body class="theme-space-light min-h-screen text-slate-100 flex items-center justify-center p-4 md:p-8 relative overflow-x-hidden">
        <!-- Floating Ambient Blobs -->
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl -z-10 animate-pulse" style="animation-delay: 2s;"></div>

        <div class="w-full max-w-md">
            <!-- Brand Logo / Header -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-3 no-underline group">
                    <div class="w-10 h-10 transition-transform duration-300 group-hover:scale-110">
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
                    <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">EduTrack</span>
                </a>
                <h2 class="text-2xl font-bold mt-6 text-white tracking-tight">Create your account</h2>
                <p class="text-slate-400 text-sm mt-2">Get started with the next generation learning system</p>
            </div>

            <!-- Glassmorphic Signup Form Card -->
            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-2xl shadow-2xl p-6 md:p-8">
                <form id="register-form" method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Full Name</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                class="w-full bg-slate-950/50 border @error('name') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-4 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="John Doe">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Username</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </span>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" required autocomplete="username"
                                class="w-full bg-slate-950/50 border @error('username') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-4 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="johndoe">
                        </div>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                                class="w-full bg-slate-950/50 border @error('email') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-4 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="you@example.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Phone Number</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.252.834l-1.26 1.26a11.085 11.085 0 005.28 5.28l1.26-1.26a1 1 0 01.834-.252l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </span>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" autocomplete="tel"
                                class="w-full bg-slate-950/50 border @error('phone_number') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-4 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="+1 (555) 0199">
                        </div>
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Select Your Role</label>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Student Option -->
                            <label class="relative flex flex-col items-center justify-center p-4 bg-slate-950/30 border border-slate-800 rounded-xl cursor-pointer hover:border-indigo-500/50 transition duration-200 group text-center">
                                <input type="radio" name="role" value="student" required class="absolute top-3 right-3 text-indigo-600 focus:ring-indigo-500 bg-slate-950 border-slate-800" checked>
                                <div class="w-10 h-10 mb-2 bg-indigo-500/10 text-indigo-400 rounded-lg flex items-center justify-center group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-white">Student</span>
                                <span class="text-[10px] text-slate-500 mt-1">Enroll & complete tasks</span>
                            </label>

                            <!-- Teacher Option -->
                            <label class="relative flex flex-col items-center justify-center p-4 bg-slate-950/30 border border-slate-800 rounded-xl cursor-pointer hover:border-purple-500/50 transition duration-200 group text-center">
                                <input type="radio" name="role" value="teacher" required class="absolute top-3 right-3 text-purple-600 focus:ring-purple-500 bg-slate-950 border-slate-800">
                                <div class="w-10 h-10 mb-2 bg-purple-500/10 text-purple-400 rounded-lg flex items-center justify-center group-hover:scale-110 transition duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-white">Teacher</span>
                                <span class="text-[10px] text-slate-500 mt-1">Manage tasks & classes</span>
                            </label>
                        </div>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" name="password" id="password" required autocomplete="new-password"
                                class="w-full bg-slate-950/50 border @error('password') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-10 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-icon-password">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <!-- Client-side Validation Error Container -->
                        <div id="password-client-error" class="hidden text-red-500 text-[11px] mt-1.5 flex items-start gap-1">
                            <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <span id="password-client-error-text"></span>
                        </div>

                        @error('password')
                            <p id="password-server-error" class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Confirm Password</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </span>
                            <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                                class="w-full bg-slate-950/50 border border-slate-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-10 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-icon-password_confirmation">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <!-- Client-side Confirm Password Validation Container -->
                        <div id="confirm-client-msg" class="hidden text-[11px] mt-1.5 flex items-center gap-1">
                            <svg id="confirm-icon-error" class="w-3.5 h-3.5 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            <svg id="confirm-icon-success" class="hidden w-3.5 h-3.5 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span id="confirm-client-msg-text"></span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold rounded-xl py-3.5 px-4 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 hover:scale-[1.01] active:scale-[0.99] transition duration-200 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-950 cursor-pointer text-sm">
                        Create Account
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-6 text-center text-sm text-slate-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition duration-150 ml-1 decoration-transparent">Sign in</a>
                </div>
            </div>
        </div>

        <script>
            function togglePasswordVisibility(fieldId, button) {
                const passwordField = document.getElementById(fieldId);
                const eyeIcon = document.getElementById('eye-icon-' + fieldId);
                
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    // Change eye icon to "eye-off"
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    `;
                } else {
                    passwordField.type = "password";
                    // Change eye icon back to standard "eye"
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            }

            const passwordInput = document.getElementById('password');
            const clientErr = document.getElementById('password-client-error');
            const clientErrText = document.getElementById('password-client-error-text');
            const serverErr = document.getElementById('password-server-error');

            function validatePassword() {
                const password = passwordInput.value;
                
                if (password.length === 0) {
                    clientErr.classList.add('hidden');
                    clientErr.classList.remove('flex');
                    passwordInput.classList.remove('border-red-500');
                    passwordInput.classList.add('border-slate-800');
                    return true;
                }

                const lengthValid = password.length >= 6;
                const hasNumber = /[0-9]/.test(password);
                const hasLowercase = /[a-z]/.test(password);
                const hasUppercase = /[A-Z]/.test(password);
                const hasSpecial = /[^A-Za-z0-9]/.test(password);

                if (!lengthValid || !hasNumber || !hasLowercase || !hasUppercase || !hasSpecial) {
                    clientErrText.textContent = "Password must be at least 6 characters long and include at least one number, one lowercase letter, one uppercase letter, and one special character.";
                    clientErr.classList.remove('hidden');
                    clientErr.classList.add('flex');
                    passwordInput.classList.add('border-red-500');
                    passwordInput.classList.remove('border-slate-800');
                    if (serverErr) serverErr.classList.add('hidden');
                    return false;
                } else {
                    clientErr.classList.add('hidden');
                    clientErr.classList.remove('flex');
                    passwordInput.classList.remove('border-red-500');
                    passwordInput.classList.add('border-slate-800');
                    return true;
                }
            }

            const confirmInput = document.getElementById('password_confirmation');
            const confirmMsg = document.getElementById('confirm-client-msg');
            const confirmMsgText = document.getElementById('confirm-client-msg-text');
            const confirmIconError = document.getElementById('confirm-icon-error');
            const confirmIconSuccess = document.getElementById('confirm-icon-success');

            function validateConfirmPassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmInput.value;

                if (confirmPassword.length === 0) {
                    confirmMsg.classList.add('hidden');
                    confirmMsg.classList.remove('flex');
                    confirmInput.classList.remove('border-red-500', 'border-emerald-500');
                    confirmInput.classList.add('border-slate-800');
                    return true;
                }

                if (password !== confirmPassword) {
                    confirmMsgText.textContent = "Passwords do not match.";
                    confirmMsgText.className = "text-red-500";
                    confirmIconError.classList.remove('hidden');
                    confirmIconSuccess.classList.add('hidden');
                    confirmMsg.classList.remove('hidden');
                    confirmMsg.classList.add('flex');
                    confirmInput.classList.add('border-red-500');
                    confirmInput.classList.remove('border-slate-800', 'border-emerald-500');
                    return false;
                } else {
                    confirmMsgText.textContent = "Passwords match.";
                    confirmMsgText.className = "text-emerald-500";
                    confirmIconError.classList.add('hidden');
                    confirmIconSuccess.classList.remove('hidden');
                    confirmMsg.classList.remove('hidden');
                    confirmMsg.classList.add('flex');
                    confirmInput.classList.add('border-emerald-500');
                    confirmInput.classList.remove('border-slate-800', 'border-red-500');
                    return true;
                }
            }

            passwordInput.addEventListener('input', () => {
                validatePassword();
                validateConfirmPassword(); // Re-verify whenever the password is changed
            });
            confirmInput.addEventListener('input', validateConfirmPassword);

            document.getElementById('register-form').addEventListener('submit', function (event) {
                const isPasswordValid = validatePassword();
                const isConfirmValid = validateConfirmPassword();
                if (!isPasswordValid || !isConfirmValid) {
                    event.preventDefault();
                }
            });

        </script>
    </body>
</html>
