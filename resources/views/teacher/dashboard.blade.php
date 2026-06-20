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
                background: rgba(15, 23, 42, 0.45);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.06);
            }
            .glass-card {
                background: rgba(30, 41, 59, 0.4);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.05);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
    <body class="theme-space-dark min-h-screen text-slate-100 flex flex-col transition-colors duration-500">
        
        <!-- Header Navigation Bar -->
