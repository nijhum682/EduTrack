<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Features - EduTrack</title>

        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
        
        <style>
            /* Custom Scrollbar for Features page */
            ::-webkit-scrollbar {
                width: 8px;
            }
            ::-webkit-scrollbar-track {
                background: rgba(15, 23, 42, 0.02);
            }
            body.theme-space-dark ::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.02);
            }
            ::-webkit-scrollbar-thumb {
                background: rgba(79, 70, 229, 0.2);
                border-radius: 4px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: rgba(79, 70, 229, 0.4);
            }

            body {
                overflow-y: auto !important; /* Enable scrolling for features details */
                height: auto !important;
                min-height: 100vh;
            }

            .features-container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 7rem 2rem 5rem 2rem;
            }

            /* Theme Configuration overrides for features page */
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

            /* Header Title Block */
            .header-block {
                text-align: center;
                margin-bottom: 5rem;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
                animation: fadeInDown 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .header-badge {
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
                margin-bottom: 1.5rem;
            }
            body.theme-space-dark .header-badge {
                background: rgba(129, 140, 248, 0.1);
                color: #818cf8;
                border-color: rgba(129, 140, 248, 0.2);
            }

            .header-title {
                font-size: 2.75rem;
                font-weight: 800;
                line-height: 1.2;
                letter-spacing: -0.02em;
                color: var(--text-main);
                margin-bottom: 1.5rem;
            }
            .header-title span {
                background: linear-gradient(135deg, #4f46e5 0%, #8b5cf6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            body.theme-space-dark .header-title span {
                background: linear-gradient(135deg, #a78bfa 0%, #c084fc 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .header-description {
                font-size: 1.125rem;
                color: var(--text-muted);
                line-height: 1.6;
            }

            /* Grid Layout */
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
                gap: 2.25rem;
                margin-bottom: 5rem;
            }

            /* Glassmorphism Feature Card */
            .feature-card {
                background: rgba(255, 255, 255, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 1.5rem;
                padding: 2.5rem;
                transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                display: flex;
                flex-direction: column;
                position: relative;
                overflow: hidden;
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.02);
            }
            body.theme-space-dark .feature-card {
                background: rgba(15, 23, 42, 0.35);
                border-color: rgba(255, 255, 255, 0.04);
                box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.25);
            }

            .feature-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: linear-gradient(90deg, #4f46e5 0%, #8b5cf6 100%);
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-6px);
                border-color: rgba(79, 70, 229, 0.2);
                box-shadow: 0 20px 40px -15px rgba(79, 70, 229, 0.1);
            }
            body.theme-space-dark .feature-card:hover {
                border-color: rgba(167, 139, 250, 0.15);
                box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.45);
            }

            .feature-card:hover::before {
                opacity: 1;
            }

            .feature-icon-wrapper {
                width: 3.5rem;
                height: 3.5rem;
                border-radius: 1rem;
                background: linear-gradient(135deg, rgba(79, 70, 229, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
                color: #4f46e5;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                margin-bottom: 2rem;
                border: 1px solid rgba(79, 70, 229, 0.15);
                transition: transform 0.3s ease;
            }
            body.theme-space-dark .feature-icon-wrapper {
                background: linear-gradient(135deg, rgba(167, 139, 250, 0.1) 0%, rgba(192, 132, 252, 0.1) 100%);
                color: #a78bfa;
                border-color: rgba(167, 139, 250, 0.2);
            }
            .feature-card:hover .feature-icon-wrapper {
                transform: scale(1.08) rotate(5deg);
            }

            .feature-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: var(--text-main);
                margin-bottom: 1rem;
                letter-spacing: -0.01em;
            }

            .feature-text {
                font-size: 0.95rem;
                color: var(--text-muted);
                line-height: 1.6;
                margin-bottom: 1.75rem;
                flex-grow: 1;
            }

            .feature-tag {
                align-self: flex-start;
                font-size: 0.7rem;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                padding: 0.3rem 0.75rem;
                border-radius: 0.5rem;
                background: rgba(15, 23, 42, 0.04);
                color: var(--text-muted);
                border: 1px solid rgba(15, 23, 42, 0.06);
            }
            body.theme-space-dark .feature-tag {
                background: rgba(255, 255, 255, 0.04);
                border-color: rgba(255, 255, 255, 0.06);
            }

            /* Highlight Callout Section */
            .ctas-section {
                text-align: center;
                background: rgba(255, 255, 255, 0.3);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                border-radius: 2rem;
                padding: 4rem 2rem;
                margin-top: 5rem;
                animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            }
            body.theme-space-dark .ctas-section {
                background: rgba(15, 23, 42, 0.2);
                border-color: rgba(255, 255, 255, 0.03);
            }

            .cta-title {
                font-size: 2rem;
                font-weight: 800;
                color: var(--text-main);
                margin-bottom: 1rem;
                letter-spacing: -0.01em;
            }

            .cta-description {
                color: var(--text-muted);
                font-size: 1.05rem;
                margin-bottom: 2.25rem;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.5;
            }

            .cta-buttons {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1.25rem;
            }

            /* Animations */
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

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

            .feature-card:nth-child(1) { animation: fadeInUp 0.5s ease-out 0.1s both; }
            .feature-card:nth-child(2) { animation: fadeInUp 0.5s ease-out 0.2s both; }
            .feature-card:nth-child(3) { animation: fadeInUp 0.5s ease-out 0.3s both; }
            .feature-card:nth-child(4) { animation: fadeInUp 0.5s ease-out 0.4s both; }
            .feature-card:nth-child(5) { animation: fadeInUp 0.5s ease-out 0.5s both; }
            .feature-card:nth-child(6) { animation: fadeInUp 0.5s ease-out 0.6s both; }
        </style>
    </head>
    <body class="theme-space-dark">
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
                        <a href="{{ route('features') }}" class="nav-link" style="color: var(--primary); font-weight: 700;">Features</a>
                        <a href="/#about" class="nav-link">About</a>
                        <a href="/#pricing" class="nav-link">Pricing</a>
                    </nav>

                    <!-- Authentication Routes -->
                    <div class="nav-auth">
                        <button id="theme-toggle" title="Toggle Theme"></button>
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
            <div class="features-container">
                
                <!-- Header Block -->
                <div class="header-block">
                    <h1 class="header-title">Engineered for the <span>Modern Academic Journey</span></h1>
                    <p class="header-description">
                        Discover the comprehensive toolsets built to empower students, facilitate rich peer collaboration, and streamline daily educational workflows for instructors.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="features-grid">
                    
                    <!-- 1. Interactive Course Workspace -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>📚</span>
                        </div>
                        <h3 class="feature-title">Central Course Workspace</h3>
                        <p class="feature-text">
                            An intuitive, organized control room for enrolled students. Instantly toggle between video lectures, course materials, assignments, live chat portals, and Q&A boards.
                        </p>
                        <span class="feature-tag">Workspace</span>
                    </div>

                    <!-- 2. Lecture Engagement Player -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>🎬</span>
                        </div>
                        <h3 class="feature-title">Interactive Video Player</h3>
                        <p class="feature-text">
                            Stream recorded lectures with built-in engagement features. Share feedback directly via a Facebook-style likes button and nested comment threads for collaborative study.
                        </p>
                        <span class="feature-tag">Engagement</span>
                    </div>

                    <!-- 3. Peer-to-Peer Note Sharing -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>📝</span>
                        </div>
                        <h3 class="feature-title">Note Exchange & Grading</h3>
                        <p class="feature-text">
                            Allows students to share lecture notes and resources. Instructors can evaluate, leave written comments, and rate shared notes out of five stars to recognize quality work.
                        </p>
                        <span class="feature-tag">Collaboration</span>
                    </div>

                    <!-- 4. Real-time Q&A Board -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>❓</span>
                        </div>
                        <h3 class="feature-title">Smart Q&A Corner</h3>
                        <p class="feature-text">
                            A focused discussion forum for academic topics. Students can ask questions with rich image attachments. Teachers post official solutions while locking inactive threads.
                        </p>
                        <span class="feature-tag">Q&A Forum</span>
                    </div>

                    <!-- 5. Live Virtual Classrooms -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>🎙️</span>
                        </div>
                        <h3 class="feature-title">Live Classrooms & Broadcasts</h3>
                        <p class="feature-text">
                            Broadcast live classes directly on the platform. Features automatic "Live Class" notifications, a dedicated live discussion board, and a clean, responsive layout.
                        </p>
                        <span class="feature-tag">Streaming</span>
                    </div>


                    <!-- 7. Instructor Workspace -->
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <span>📊</span>
                        </div>
                        <h3 class="feature-title">Teacher Control Panel</h3>
                        <p class="feature-text">
                            Manage your academy from a single interface. Schedule live sessions, upload lectures, publish assignments, grade student responses, and track engagement trends.
                        </p>
                        <span class="feature-tag">Management</span>
                    </div>

                </div>

                <!-- Call to Action Section -->
                <div class="ctas-section">
                    <h2 class="cta-title">Ready to Elevate Your Academy?</h2>
                    <p class="cta-description">
                        Join thousands of students and teachers who use EduTrack to simplify learning administration and increase academic collaboration.
                    </p>
                    <div class="cta-buttons">
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

        <script>
            // Theme toggling logic
            const themeToggle = document.getElementById('theme-toggle');
            
            const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m0 13.5V21M4.978 4.978l1.591 1.591m10.862 10.862l1.591 1.591M21 12h-2.25m-13.5 0H3m14.022-7.022l-1.591 1.591M6.569 17.43l-1.591 1.591M12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9z" /></svg>`;
            const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>`;

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
            document.body.classList.remove('theme-space-dark', 'theme-space-light');
            document.body.classList.add(currentTheme);
            updateThemeToggleIcon(currentTheme);

            themeToggle.addEventListener('click', function () {
                const newTheme = document.body.classList.contains('theme-space-dark') 
                    ? 'theme-space-light' 
                    : 'theme-space-dark';
                
                document.body.classList.remove('theme-space-dark', 'theme-space-light');
                document.body.classList.add(newTheme);
                setCookie('dashboard_theme', newTheme, 30);
                updateThemeToggleIcon(newTheme);
            });
        </script>
    </body>
</html>
