<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EduTrack - Smart Education Platform</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    </head>
    <body>
        <!-- Core App Content Wrapper -->
        <div class="app-wrapper">
            
            <!-- Navigation Header -->
            <header>
                <div class="nav-container">
                    <!-- Unique Animated Logo & Brand Name -->
                    <a href="/" class="logo-link">
                        <div class="logo-icon">
                            <svg class="logo-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Book Left Page -->
                                <path class="logo-svg-path" d="M50 85C35 80 20 85 20 85V25C20 25 35 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                <!-- Book Right Page -->
                                <path class="logo-svg-path" d="M50 85C65 80 80 85 80 85V25C80 25 65 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                <!-- Clear Pen in the middle -->
                                <g id="logo-pen">
                                    <!-- Pen Clip -->
                                    <path d="M55 21 H60 V28 H55" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                    <!-- Pen Nib (Metal Tip) -->
                                    <path d="M45 70 L50 84 L55 70 Z" fill="#e2e8f0" stroke="#475569" stroke-width="1.5" stroke-linejoin="round" />
                                    <!-- Pen Body -->
                                    <rect x="45" y="32" width="10" height="38" fill="url(#logo-grad-alt)" rx="1" />
                                    <!-- Pen Cap -->
                                    <path d="M45 18 C45 14, 55 14, 55 18 V32 H45 Z" fill="#4f46e5" />
                                    <!-- Cap Tip -->
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
                        <span class="logo-text">EduTrack</span>
                    </a>

                    <!-- Navigation Links -->
                    <nav class="nav-links">
                        <a href="{{ route('features') }}" class="nav-link">Features</a>
                        <a href="#about" class="nav-link">About</a>
                        <a href="#pricing" class="nav-link">Pricing</a>
                    </nav>

                    <!-- Authentication Routes -->
                    <div class="nav-auth">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-ghost">Sign In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                                @endif
                            @endauth
                        @else
                            <!-- Fallback when Auth features are not yet installed -->
                            <a href="#" class="btn btn-ghost" onclick="alert('Auth system integration is in progress.')">Sign In</a>
                            <a href="#" class="btn btn-primary" onclick="alert('Auth system integration is in progress.')">Sign Up</a>
                        @endif
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <main class="hero">
                <div class="hero-content">
                    <div class="badge">Next Gen Learning</div>
                    <h1 class="hero-title">Track Your Journey,<br>Reach Your Goals with<br><span>EduTrack</span></h1>
                    <p class="hero-description">
                        EduTrack is an all-in-one education ecosystem designed to seamlessly manage course workflows, track student achievements, and empower educators with real-time academic analytics.
                    </p>
                    <div class="hero-ctas">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                                <a href="{{ route('login') }}" class="btn btn-secondary">Sign In to Platform</a>
                            @endauth
                        @else
                            <!-- Fallbacks -->
                            <a href="#" class="btn btn-primary" onclick="alert('Auth system integration is in progress.')">Get Started Free</a>
                            <a href="#" class="btn btn-secondary" onclick="alert('Auth system integration is in progress.')">Sign In to Platform</a>
                        @endif
                    </div>
                </div>

                <!-- Interactive Vector Illustration (Digital Learning Platforms) -->
                <div class="hero-visual">
                    <img src="{{ asset('images/hero-illustration.webp') }}" alt="Digital Learning Ecosystem" class="hero-image">
                </div>
            </main>

        </div>

    </body>
</html>
