<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $task->title }} - Exam Arena | EduTrack</title>
    <!-- Google Fonts & Tailwind -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Modern Space Dark Theme system */
        .theme-space-dark {
            --bg-base: #030712;
            --bg-surface: #0b0f19;
            --border-color: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent-glow: rgba(99, 102, 241, 0.15);
        }
        /* Modern Space Light Theme system */
        .theme-space-light {
            --bg-base: #f8fafc;
            --bg-surface: rgba(255, 255, 255, 0.55);
            --border-color: rgba(15, 23, 42, 0.08);
            --text-main: #0f172a;
            --text-muted: #475569;
            --accent-glow: rgba(99, 102, 241, 0.05);
        }
        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            background-attachment: fixed;
        }
        body.theme-space-dark {
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(236, 72, 153, 0.05) 0px, transparent 50%);
        }
        body.theme-space-light {
            background-image: 
                linear-gradient(135deg, rgba(255, 255, 255, 0.84) 0%, rgba(237, 244, 254, 0.84) 65%, rgba(218, 231, 252, 0.84) 100%),
                url('{{ asset('images/header-image.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .glass-panel {
            background: rgba(11, 15, 25, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.04);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }
        
        /* Space Light Theme Specific Element Overrides */
        body.theme-space-light .glass-panel {
            background: rgba(255, 255, 255, 0.55) !important;
            border-color: rgba(15, 23, 42, 0.08) !important;
            box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.04) !important;
        }
        body.theme-space-light .text-white,
        body.theme-space-light h1,
        body.theme-space-light h2,
        body.theme-space-light h3,
        body.theme-space-light h4 {
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
        body.theme-space-light label {
            background: rgba(255, 255, 255, 0.6) !important;
            border-color: rgba(15, 23, 42, 0.08) !important;
        }
        body.theme-space-light label:hover {
            background: rgba(15, 23, 42, 0.03) !important;
        }
        body.theme-space-light textarea {
            background: rgba(255, 255, 255, 0.75) !important;
            border-color: rgba(15, 23, 42, 0.12) !important;
            color: #0f172a !important;
        }
        body.theme-space-light .border-dashed {
            border-color: rgba(15, 23, 42, 0.15) !important;
            background: rgba(15, 23, 42, 0.02) !important;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <script>
        (function() {
            const currentTheme = localStorage.getItem('theme') || 'light';
            document.body.classList.add(currentTheme === 'dark' ? 'theme-space-dark' : 'theme-space-light');
        })();
    </script>

    <!-- Exam Top Bar -->
    <header class="glass-panel sticky top-0 z-40 border-b border-slate-800/80 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold px-2.5 py-1 rounded bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-wider">
                {{ $task->course->code }}
            </span>
            <div>
                <h1 class="text-base font-bold text-white leading-tight">{{ $task->title }}</h1>
                <p class="text-[10px] text-slate-400 mt-0.5">Exam Arena &middot; Hand in your answers before time expires.</p>
            </div>
        </div>

        <!-- Timer Panel -->
        <div class="flex items-center gap-4">
            <div class="glass-panel border-amber-500/30 bg-amber-500/5 rounded-xl px-4 py-2 flex items-center gap-2.5 shadow shadow-amber-500/5">
                <span class="text-xs text-amber-400 font-bold uppercase tracking-wider animate-pulse">⏰ Time Left:</span>
                <span id="countdown-timer" class="text-lg font-mono font-extrabold text-white">00:00</span>
            </div>
            
            <a href="{{ route('dashboard') }}" onclick="return confirm('Are you sure? Your progress will not be saved unless you submit the exam!')" class="text-xs text-slate-400 hover:text-white px-3 py-2 border border-slate-800 rounded-lg hover:bg-slate-900 transition">
                Leave Arena
            </a>
        </div>
    </header>

    <!-- Main Workspace -->
    <main class="flex-grow max-w-4xl w-full mx-auto px-6 py-8">
        @if($task->description)
            <div class="glass-panel rounded-2xl p-4 border border-slate-800/60 mb-6 flex items-start gap-3">
                <span class="text-lg">📢</span>
                <div>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block">Instructions</span>
                    <p class="text-xs text-slate-300 leading-relaxed mt-0.5">{{ $task->description }}</p>
                </div>
            </div>
        @endif

        <form id="exam-form" action="{{ route('student.exam.submit', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Questions Container -->
            <div class="space-y-6">
                @foreach($task->questions as $index => $q)
                    <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg space-y-4">
                        <!-- Header -->
                        <div class="flex justify-between items-start gap-4">
                            <div class="flex gap-2.5">
                                <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 flex items-center justify-center text-xs font-mono font-bold">
                                    {{ $index + 1 }}
                                </span>
                                <h3 class="text-sm font-bold text-slate-200 pt-0.5 leading-snug">{{ $q->question_text }}</h3>
                            </div>
                            <span class="text-[10px] font-extrabold px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-400 border border-slate-700/60 flex-shrink-0">
                                {{ $q->points }} Marks
                            </span>
                        </div>

                        <!-- Response input based on question type -->
                        <div class="pl-8 pt-2">
                            @if($q->type === 'mcq')
                                <!-- MCQ Radio Buttons -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($q->options as $optIdx => $opt)
                                        <label class="flex items-center gap-3 bg-slate-950/40 hover:bg-slate-900/60 border border-slate-850 rounded-xl p-3 cursor-pointer transition">
                                            <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt }}" class="w-4 h-4 text-indigo-600 bg-slate-900 border-slate-800 focus:ring-indigo-500 transition">
                                            <span class="text-xs text-slate-300 font-medium">{{ $opt }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($q->type === 'written')
                                <!-- Written TextArea -->
                                <textarea name="answers[{{ $q->id }}]" placeholder="Type your written answer here..." rows="5" class="w-full bg-slate-950/40 border border-slate-850 rounded-xl py-3 px-4 text-xs text-slate-200 placeholder-slate-600 outline-none focus:border-indigo-500 transition leading-relaxed font-mono"></textarea>
                            @elseif($q->type === 'file')
                                <!-- Khata File Upload -->
                                <div class="border-2 border-dashed border-slate-800/80 rounded-xl p-6 bg-slate-950/10 hover:bg-slate-950/20 text-center transition">
                                    <span class="text-2xl block mb-2">📸</span>
                                    <span class="text-xs text-slate-300 font-bold block mb-1">Upload image of your khata (answer sheet)</span>
                                    <span class="text-[10px] text-slate-500 block mb-4">Supported formats: JPG, PNG, JPEG (Max 5MB)</span>
                                    
                                    <input type="file" name="khata_file" accept="image/*" class="mx-auto block text-xs text-slate-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-[11px] file:font-semibold file:bg-indigo-600/10 file:text-indigo-400 hover:file:bg-indigo-600/25 file:cursor-pointer transition">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Panel -->
            <div class="glass-panel rounded-2xl p-6 border border-slate-800/80 shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="space-y-1">
                    <h3 class="text-sm font-bold text-white">Ready to hand in?</h3>
                    <p class="text-[10px] text-slate-400">Ensure all MCQ options are checked, essays are written, and khata photos are uploaded.</p>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl py-3.5 px-8 shadow-lg shadow-indigo-650/20 active:scale-[0.98] transition cursor-pointer">
                    Submit Exam Paper
                </button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950/40 py-6 text-center text-[10px] text-slate-600">
        <p>&copy; 2026 EduTrack Smart Learning Exam Panel. Academic integrity monitored.</p>
    </footer>

    <!-- Timer Ticking Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timerDisplay = document.getElementById('countdown-timer');
            const form = document.getElementById('exam-form');
            const taskId = "{{ $task->id }}";
            const durationMinutes = parseInt("{{ $task->duration_minutes }}") || 60;
            const durationSeconds = durationMinutes * 60;
            
            const startKey = `exam_start_${taskId}`;
            
            let startTime = localStorage.getItem(startKey);
            if (!startTime) {
                startTime = Date.now().toString();
                localStorage.setItem(startKey, startTime);
            }
            
            function updateTimer() {
                const elapsedSeconds = Math.floor((Date.now() - parseInt(startTime)) / 1000);
                const remainingSeconds = durationSeconds - elapsedSeconds;
                
                if (remainingSeconds <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.textContent = "00:00";
                    timerDisplay.classList.add('text-red-500');
                    alert("Time is up! Your exam paper will be submitted automatically.");
                    
                    // Clear storage key and submit
                    localStorage.removeItem(startKey);
                    form.submit();
                    return;
                }
                
                const mins = Math.floor(remainingSeconds / 60);
                const secs = remainingSeconds % 60;
                
                const formattedMins = String(mins).padStart(2, '0');
                const formattedSecs = String(secs).padStart(2, '0');
                
                timerDisplay.textContent = `${formattedMins}:${formattedSecs}`;
                
                // Visual warnings
                if (remainingSeconds <= 60) {
                    timerDisplay.parentElement.className = "glass-panel border-red-500/40 bg-red-500/10 rounded-xl px-4 py-2 flex items-center gap-2.5 shadow shadow-red-500/10 animate-bounce";
                    timerDisplay.className = "text-lg font-mono font-extrabold text-red-400";
                } else if (remainingSeconds <= 300) {
                    timerDisplay.parentElement.className = "glass-panel border-amber-500/40 bg-amber-500/10 rounded-xl px-4 py-2 flex items-center gap-2.5 shadow shadow-amber-500/10";
                    timerDisplay.className = "text-lg font-mono font-extrabold text-amber-400";
                }
            }
            
            // Run timer instantly and tick every second
            updateTimer();
            const timerInterval = setInterval(updateTimer, 1000);
            
            // Clean localstorage on manual submit
            form.addEventListener('submit', function () {
                localStorage.removeItem(startKey);
            });
        });
    </script>
</body>
</html>
