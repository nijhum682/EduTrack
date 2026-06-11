<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign In - EduTrack</title>

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
            .mesh-gradient {
                background-color: #0b0f19;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(139, 92, 246, 0.15) 0px, transparent 50%),
                    radial-gradient(at 50% 100%, rgba(236, 72, 153, 0.08) 0px, transparent 50%);
            }
        </style>
    </head>
    <body class="mesh-gradient min-height-screen text-slate-100 flex items-center justify-center p-4 md:p-8 min-h-screen relative overflow-x-hidden">
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
                <h2 class="text-2xl font-bold mt-6 text-white tracking-tight">Sign in to your account</h2>
                <p class="text-slate-400 text-sm mt-2">Welcome back! Please enter your details</p>
            </div>

            <!-- Glassmorphic Login Form Card -->
            <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800/80 rounded-2xl shadow-2xl p-6 md:p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
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

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-400">Password</label>
                            <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 transition duration-150 decoration-transparent">Forgot password?</a>
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input type="password" name="password" id="password" required
                                class="w-full bg-slate-950/50 border @error('password') border-red-500 @else border-slate-800 @enderror focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 text-white rounded-xl pl-10 pr-10 py-3 outline-none transition duration-200 placeholder-slate-600 text-sm"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-500 hover:text-slate-300 focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="eye-icon-password">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-slate-800 bg-slate-950/50 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-950 accent-indigo-600 cursor-pointer">
                        <label for="remember" class="ml-2 text-sm text-slate-400 cursor-pointer select-none">Remember this device</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold rounded-xl py-3.5 px-4 shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/30 hover:scale-[1.01] active:scale-[0.99] transition duration-200 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-950 cursor-pointer text-sm">
                        Sign In
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-6 text-center text-sm text-slate-400">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition duration-150 ml-1 decoration-transparent">Sign up</a>
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
        </script>
    </body>
</html>
