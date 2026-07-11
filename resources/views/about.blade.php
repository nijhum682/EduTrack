<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us - EduTrack</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
        
        <style>
            body {
                overflow-y: auto !important;
                height: auto !important;
                min-height: 100vh;
            }

            .about-container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 10rem 2rem 5rem 2rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: calc(100vh - 80px);
            }

            /* Theme Configuration overrides for about page */
            body.theme-space-dark {
                --text-main: #f8fafc;
                --text-muted: #cbd5e1;
                --text-light: #94a3b8;
                --bg-white: #0f172a;
                --bg-glass: rgba(8, 12, 20, 0.85);
                --border-glass: rgba(255, 255, 255, 0.08);
                
                background-color: #080c14 !important;
                background-image: 
                    linear-gradient(rgba(8, 12, 20, 0.9), rgba(8, 12, 20, 0.9)),
                    url('/images/header-image.png') !important;
            }
            body.theme-space-dark .logo-link {
                color: #ffffff !important;
            }
            body.theme-space-dark .nav-link {
                color: #cbd5e1 !important;
            }
            body.theme-space-dark .nav-link:hover {
                color: #ffffff !important;
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
                margin-right: 0.75rem;
            }
            body.theme-space-dark #theme-toggle {
                background: rgba(255, 255, 255, 0.05) !important;
                color: #f8fafc !important;
                border-color: rgba(255, 255, 255, 0.1) !important;
            }
            #theme-toggle:hover {
                transform: scale(1.05);
            }

            /* Glassmorphism About Card */
            .about-card {
                background: rgba(255, 255, 255, 0.45);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(226, 232, 240, 0.85);
                border-radius: 2rem;
                padding: 4rem;
                max-width: 960px;
                box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.03);
                text-align: center;
                position: relative;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            }
            body.theme-space-dark .about-card {
                background: rgba(15, 23, 42, 0.4);
                border-color: rgba(255, 255, 255, 0.04);
                box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.4);
            }
            .about-card:hover {
                border-color: rgba(79, 70, 229, 0.2);
                box-shadow: 0 30px 60px -20px rgba(79, 70, 229, 0.1);
            }
            body.theme-space-dark .about-card:hover {
                border-color: rgba(167, 139, 250, 0.15);
                box-shadow: 0 30px 60px -20px rgba(0, 0, 0, 0.5);
            }

            .about-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 100%);
            }

            .about-badge {
                display: inline-block;
                padding: 0.5rem 1.25rem;
                border-radius: 2rem;
                font-size: 0.75rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                background: rgba(79, 70, 229, 0.1);
                color: #4f46e5;
                border: 1px solid rgba(79, 70, 229, 0.2);
                margin-bottom: 2rem;
            }
            body.theme-space-dark .about-badge {
                background: rgba(129, 140, 248, 0.1);
                color: #818cf8;
                border-color: rgba(129, 140, 248, 0.2);
            }

            .about-title {
                font-size: 2.75rem;
                font-weight: 800;
                line-height: 1.2;
                letter-spacing: -0.02em;
                color: var(--text-main);
                margin-bottom: 2rem;
            }
            .about-title span {
                background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            body.theme-space-dark .about-title span {
                background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .about-text {
                font-size: 1.15rem;
                color: var(--text-muted);
                line-height: 1.8;
                text-align: justify;
                margin-bottom: 2.5rem;
            }

            .bangladesh-highlight {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
                border: 1px solid rgba(16, 185, 129, 0.25);
                border-radius: 1rem;
                padding: 1.5rem 2rem;
                display: flex;
                align-items: center;
                gap: 1.5rem;
                text-align: left;
                margin-top: 1.5rem;
            }
            body.theme-space-dark .bangladesh-highlight {
                background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
                border-color: rgba(16, 185, 129, 0.15);
            }

            .bh-icon {
                font-size: 2.5rem;
                line-height: 1;
            }

            .bh-content h4 {
                font-size: 1.05rem;
                font-weight: 700;
                color: #10b981;
                margin-bottom: 0.25rem;
            }
            body.theme-space-dark .bh-content h4 {
                color: #34d399;
            }

            .bh-content p {
                font-size: 0.925rem;
                color: var(--text-muted);
                line-height: 1.5;
            }

            .action-buttons {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1.25rem;
                margin-top: 2.5rem;
            }

            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body class="theme-space-light">
        <!-- Core App Content Wrapper -->
        <div class="app-wrapper">
            
            <!-- Navigation Header -->
            <header>
                <div class="nav-container">
                    <!-- Unique Animated Logo & Brand Name -->
                    <a href="/" class="logo-link">
                        <div class="logo-icon">
                            <svg class="logo-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="logo-svg-path" d="M50 85C35 80 20 85 20 85V25C20 25 35 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                <path class="logo-svg-path" d="M50 85C65 80 80 85 80 85V25C80 25 65 20 50 25" stroke="url(#logo-grad)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                                <g id="logo-pen">
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
                        <span class="logo-text">EduTrack</span>
                    </a>

                    <!-- Navigation Links -->
                    <nav class="nav-links">
                        <a href="{{ route('features') }}" class="nav-link">Features</a>
                        <a href="{{ route('about') }}" class="nav-link" style="color: var(--primary); font-weight: 700;">About</a>
                        <a href="{{ route('courses') }}" class="nav-link">Courses</a>
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
                        @endif
                    </div>
                </div>
            </header>

            <!-- Main Content Container -->
            <div class="about-container">
                
                <!-- Glassmorphism About Card -->
                <div class="about-card">
                    <span class="about-badge">Our Mission</span>
                    <h1 class="about-title">Empowering Learners, <span>Connecting Academics</span></h1>
                    
                    <p class="about-text">
                        EduTrack is a next-generation smart education platform built to bridge the gap between students and educators, serving as a vital driver for digital transformation in the Bangladesh online education system. In a landscape often challenged by accessibility, low-bandwidth constraints, and engagement barriers, EduTrack provides localized, low-latency, and all-in-one virtual workspaces. By integrating interactive lecture engagement, peer-to-peer note sharing, real-time Q&A corners, and structured progress tracking, it empowers Bangladeshi schools, colleges, and private academies to transition smoothly into high-fidelity hybrid learning, bringing quality education to students nationwide.
                    </p>

                    <!-- Bangladesh Contribution Highlight Card -->
                    <div class="bangladesh-highlight">
                        <div class="bh-icon">🇧🇩</div>
                        <div class="bh-content">
                            <h4>National Impact & Accessibility</h4>
                            <p>Optimized to load rapidly under standard local broadband networks, supporting national educational equity by bringing high-fidelity virtual classroom workspaces to municipal and rural districts alike.</p>
                        </div>
                    </div>

                    <!-- Call to Action inside the page -->
                    <div class="action-buttons">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary">Get Started Free</a>
                                <a href="{{ route('login') }}" class="btn btn-secondary">Sign In to Platform</a>
                            @endauth
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </body>
</html>
