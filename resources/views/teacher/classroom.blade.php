<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Virtual Classroom - EduTrack</title>

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
            body {
                background-color: #05080f;
                overflow: hidden;
            }
            .glass-container {
                background: rgba(15, 23, 42, 0.45);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }
            /* Simulated WebCam Wave Animation */
            .video-wave {
                animation: scaleWave 4s ease-in-out infinite alternate;
            }
            @keyframes scaleWave {
                0% { transform: scale(0.95); opacity: 0.7; }
                100% { transform: scale(1.05); opacity: 0.95; }
            }
        </style>
    </head>
    <body class="text-slate-100 min-h-screen flex flex-col h-screen select-none font-sans">
        
        <!-- Classroom Header Bar -->
        <header class="bg-slate-950/80 border-b border-slate-900 px-6 py-4 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-3">
                <span class="w-3.5 h-3.5 rounded-full bg-red-500 animate-pulse border-2 border-red-300"></span>
                <div>
                    <h1 class="text-sm font-extrabold tracking-tight text-white flex items-center gap-2">
                        {{ $class->course->code }} &middot; {{ $class->title }}
                        <span class="text-[9px] font-bold uppercase bg-pink-500/10 text-pink-400 border border-pink-500/30 px-2 py-0.5 rounded">Live Broadcast</span>
                    </h1>
                    <p class="text-[10px] text-slate-500 mt-0.5">Instructor: <strong>{{ $class->course->instructor }}</strong></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-slate-900 border border-slate-800/80 rounded-xl px-3 py-1.5 flex items-center gap-2 text-xs">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Participants: <strong class="text-pink-400" id="participant-count">1</strong></span>
                </div>

                @if($user->isTeacher())
                    <form action="{{ route('teacher.classes.toggle-active', $class->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold text-xs py-2 px-4 rounded-xl border border-red-500/20 shadow-md active:scale-95 transition cursor-pointer">
                            End Class
                        </button>
                    </form>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-slate-850 hover:bg-slate-800 text-slate-300 hover:text-white font-bold text-xs py-2 px-4 rounded-xl border border-slate-800 active:scale-95 transition cursor-pointer">
                        Leave Class
                    </a>
                @endif
            </div>
        </header>

        <!-- Main Workplace -->
        <main class="flex-grow flex overflow-hidden min-h-0">
            <!-- Left Workspace: Whiteboard & Webcam (Grid) -->
            <section class="flex-grow flex flex-col p-4 space-y-4 overflow-y-auto">
                <!-- Whiteboard/Presentation Canvas -->
                <div class="flex-grow glass-container rounded-2xl border border-slate-800/80 shadow-2xl p-6 flex flex-col min-h-[300px] justify-between relative overflow-hidden">
                    
                    <!-- Canvas Background glow -->
                    <div class="absolute -right-20 -top-20 w-80 h-80 bg-purple-600/5 rounded-full blur-3xl -z-10"></div>
                    <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-pink-600/5 rounded-full blur-3xl -z-10"></div>

                    <!-- Slide Controls Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-800/60 relative z-10">
                        <span class="text-xs font-bold text-slate-400">Interactive Blackboard</span>
                        <div class="flex items-center gap-2">
                            <button onclick="prevSlide()" class="bg-slate-900 border border-slate-800 text-slate-300 hover:text-white p-1.5 rounded-lg text-xs cursor-pointer active:scale-90 transition">&lt;</button>
                            <span class="text-xs font-mono font-semibold" id="slide-num">Slide 1 / 4</span>
                            <button onclick="nextSlide()" class="bg-slate-900 border border-slate-800 text-slate-300 hover:text-white p-1.5 rounded-lg text-xs cursor-pointer active:scale-90 transition">&gt;</button>
                        </div>
                    </div>

                    <!-- Slide Contents -->
                    <div class="flex-grow flex flex-col items-center justify-center text-center p-6 relative z-10">
                        <!-- Slide 1 -->
                        <div id="slide-1" class="slide-item space-y-4 max-w-lg">
                            <div class="w-16 h-16 bg-pink-500/10 text-pink-400 rounded-2xl flex items-center justify-center mx-auto text-3xl font-extrabold animate-pulse">
                                🎓
                            </div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight">Welcome to Today's Interactive Lecture</h2>
                            <p class="text-sm text-slate-400 leading-relaxed">
                                We will discuss core concepts, review assignments, and run a live interactive classroom simulation. Ensure your microphone is muted during presentation modules.
                            </p>
                        </div>

                        <!-- Slide 2 -->
                        <div id="slide-2" class="slide-item hidden space-y-4 max-w-lg">
                            <h3 class="text-indigo-400 text-xs font-bold uppercase tracking-widest">Topic Overview</h3>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight">Architectural Principles</h2>
                            <ul class="text-left text-xs text-slate-300 space-y-3 mx-auto max-w-xs mt-4">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    Loose coupling and high cohesion
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    State management in distributed apps
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                    Real-time API feedback structures
                                </li>
                            </ul>
                        </div>

                        <!-- Slide 3 -->
                        <div id="slide-3" class="slide-item hidden space-y-4 max-w-lg">
                            <h2 class="text-xl font-extrabold text-white tracking-tight">Let's solve normal forms!</h2>
                            <p class="text-xs text-slate-400">Can you normalization this table structure?</p>
                            <div class="bg-slate-950/60 border border-slate-800/80 rounded-xl p-4 font-mono text-[10px] text-slate-300 text-left">
                                <span class="text-pink-400">UNNORMALIZED RELATION:</span><br>
                                CourseEnroll(StudentID, StudentName, CourseID, CourseTitle, InstructorName, InstructorRoom)<br><br>
                                <span class="text-emerald-400">TASK:</span> Decompose into 3NF.
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div id="slide-4" class="slide-item hidden space-y-4 max-w-lg">
                            <div class="text-4xl">💬</div>
                            <h2 class="text-2xl font-extrabold text-white tracking-tight">Question & Answer Session</h2>
                            <p class="text-sm text-slate-400">
                                Send your queries directly in the virtual chat lobby. The instructor will answer in real-time.
                            </p>
                        </div>
                    </div>

                    <!-- Blackboard Footer toolbar -->
                    <div class="flex items-center justify-between border-t border-slate-900 pt-3 relative z-10">
                        <span class="text-[10px] text-slate-500">Status: <strong class="text-emerald-400">● Streaming Connection Stable</strong></span>
                        <div class="flex gap-2">
                            <span class="w-3 h-3 bg-purple-500 rounded-full inline-block cursor-pointer" onclick="setBoardColor('bg-purple-950/10')"></span>
                            <span class="w-3 h-3 bg-blue-500 rounded-full inline-block cursor-pointer" onclick="setBoardColor('bg-blue-950/10')"></span>
                            <span class="w-3 h-3 bg-slate-800 rounded-full inline-block cursor-pointer" onclick="setBoardColor('bg-slate-900/10')"></span>
                        </div>
                    </div>
                </div>

                <!-- Teacher Cam / Active Feeds footer (Height limited) -->
                <div class="h-44 flex gap-4 flex-shrink-0">
                    <!-- Host webcam simulator -->
                    <div class="w-64 glass-container rounded-2xl border border-slate-800/80 relative overflow-hidden flex items-center justify-center flex-shrink-0 shadow-lg">
                        
                        <!-- Camera simulation drawing -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <canvas id="camera-visualizer" class="w-full h-full opacity-60"></canvas>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent flex flex-col justify-between p-3 z-10">
                            <span class="text-[8px] uppercase tracking-widest font-extrabold bg-red-600 px-1.5 py-0.5 rounded text-white self-start">HOST</span>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-white">{{ $class->course->instructor }}</span>
                                <div class="flex gap-1">
                                    <button onclick="toggleAudio()" id="audio-btn" class="w-6 h-6 rounded bg-slate-900/80 border border-slate-700/60 flex items-center justify-center text-xs hover:bg-slate-800 cursor-pointer">🎙️</button>
                                    <button onclick="toggleVideo()" id="video-btn" class="w-6 h-6 rounded bg-slate-900/80 border border-slate-700/60 flex items-center justify-center text-xs hover:bg-slate-800 cursor-pointer">📹</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Participant webcam simulator (Students) -->
                    <div class="flex-grow glass-container rounded-2xl border border-slate-800/80 flex items-center justify-center relative overflow-hidden text-center p-4">
                        <div class="space-y-1 relative z-10">
                            <div class="text-2xl animate-bounce">🎲</div>
                            <h4 class="text-xs font-bold text-white">Student Study Lobby</h4>
                            <p class="text-[10px] text-slate-400">Classmates are viewing presentation slides</p>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-indigo-500/5 rounded-full blur-2xl"></div>
                    </div>
                </div>
            </section>

            <!-- Right Sidebar: Attendance & Live Chat (4 cols equivalent) -->
            <section class="w-80 bg-slate-950/40 border-l border-slate-900 flex flex-col flex-shrink-0">
                <!-- Attendance Widget (1/3 height) -->
                <div class="h-48 border-b border-slate-900 p-4 flex flex-col min-h-0">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3 flex items-center justify-between flex-shrink-0">
                        <span>Attendance Logs</span>
                        <span class="text-[9px] font-normal lowercase" id="active-percentage">100% active</span>
                    </h3>
                    <div class="flex-grow overflow-y-auto space-y-2 pr-1" id="attendance-list">
                        <!-- Active Host -->
                        <div class="flex items-center justify-between text-xs py-1 border-b border-slate-900/40">
                            <span class="font-semibold text-white flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                {{ $class->course->instructor }}
                            </span>
                            <span class="text-[9px] text-purple-400 font-bold">Host</span>
                        </div>
                    </div>
                </div>

                <!-- Chat Room Widget (2/3 height) -->
                <div class="flex-grow flex flex-col p-4 min-h-0">
                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3 flex-shrink-0">Class Chatroom</h3>
                    
                    <!-- Chat Messages List -->
                    <div class="flex-grow overflow-y-auto space-y-3 mb-4 pr-1 text-xs" id="chat-messages-container">
                        <div class="text-center text-[10px] text-slate-500 italic py-2 border-b border-slate-900/30">
                            Joined virtual classroom chat lobby.
                        </div>

                        @if($class->rootComments->count() === 0)
                            <div class="text-center text-[10px] text-slate-600 italic py-4">
                                No messages in this class session yet.
                            </div>
                        @endif

                        @foreach($class->rootComments as $comment)
                            <div class="space-y-2 bg-slate-900/30 border border-slate-900/50 p-2.5 rounded-xl">
                                <div class="flex justify-between items-start text-[10px]">
                                    <span class="flex items-center gap-1.5">
                                        <strong class="{{ $comment->user->isTeacher() ? 'text-purple-300' : 'text-slate-300' }}">{{ $comment->user->name }}</strong>
                                        @if($comment->user->isTeacher())
                                            <span class="text-[8px] font-extrabold uppercase border px-1 rounded bg-purple-500/20 text-purple-300 border-purple-500/40">Teacher</span>
                                        @endif
                                    </span>
                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-600">{{ $comment->created_at->diffForHumans() }}</span>
                                        <button onclick="setReplyParent({{ $comment->id }}, '{{ $comment->user->name }}')" class="text-pink-400 hover:text-pink-300 font-bold hover:underline cursor-pointer">Reply</button>
                                    </div>
                                </div>
                                <p class="text-slate-200 font-medium leading-relaxed">{{ $comment->comment_text }}</p>

                                <!-- Replies List -->
                                @if($comment->replies->count() > 0)
                                    <div class="pl-4 mt-2 border-l border-slate-800/80 space-y-2">
                                        @foreach($comment->replies as $reply)
                                            <div class="bg-slate-950/20 p-2 rounded-lg space-y-1">
                                                <div class="flex justify-between items-start text-[9px]">
                                                    <span class="flex items-center gap-1">
                                                        <strong class="{{ $reply->user->isTeacher() ? 'text-purple-300' : 'text-slate-400' }}">{{ $reply->user->name }}</strong>
                                                        @if($reply->user->isTeacher())
                                                            <span class="text-[7px] font-extrabold uppercase border px-1 rounded bg-purple-500/10 text-purple-300 border-purple-500/30">Teacher</span>
                                                        @endif
                                                    </span>
                                                    <span class="text-slate-600">{{ $reply->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-slate-300 text-[10px] leading-relaxed">{{ $reply->comment_text }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Chat Message Input -->
                    <form action="{{ route('classroom.comment', $class->id) }}" method="POST" id="classroom-chat-form" class="mt-auto flex-shrink-0">
                        @csrf
                        <input type="hidden" name="parent_id" id="parent-id-input" value="">
                        
                        <!-- Reply Indicator Badge -->
                        <div id="reply-indicator" class="hidden flex justify-between items-center bg-slate-900 border border-slate-800 rounded-lg px-2.5 py-1 mb-2 text-[10px]">
                            <span class="text-slate-400">Replying to: <strong class="text-pink-400" id="reply-user-label"></strong></span>
                            <button type="button" onclick="cancelReply()" class="text-red-400 hover:text-red-300 font-bold cursor-pointer">&times; Cancel</button>
                        </div>

                        <div class="relative">
                            <input type="text" name="comment_text" required placeholder="Type a message or click Reply..." autocomplete="off" class="w-full bg-slate-900/80 border border-slate-800 focus:border-pink-500 focus:ring-1 focus:ring-pink-500/20 text-slate-200 placeholder-slate-500 rounded-xl py-2.5 pl-3 pr-10 text-xs outline-none transition">
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3 text-pink-400 hover:text-pink-300 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>

        <!-- Canvas camera visualizer script & Chat automation -->
        <script>
            // Slide Handler
            let currentSlideNum = 1;
            const totalSlides = 4;
            function showSlide(num) {
                document.querySelectorAll('.slide-item').forEach(slide => {
                    slide.classList.add('hidden');
                });
                document.getElementById('slide-' + num).classList.remove('hidden');
                document.getElementById('slide-num').textContent = `Slide ${num} / ${totalSlides}`;
            }
            function nextSlide() {
                if (currentSlideNum < totalSlides) {
                    currentSlideNum++;
                    showSlide(currentSlideNum);
                }
            }
            function prevSlide() {
                if (currentSlideNum > 1) {
                    currentSlideNum--;
                    showSlide(currentSlideNum);
                }
            }

            function setBoardColor(bgColorClass) {
                const board = document.querySelector('.slide-item').parentElement;
                // remove existing BG
                board.classList.remove('bg-purple-950/10', 'bg-blue-950/10', 'bg-slate-900/10');
                // We won't add classes directly if not tailwind, but simple inline override
                board.style.backgroundColor = bgColorClass.includes('purple') ? 'rgba(88, 28, 135, 0.08)' : (bgColorClass.includes('blue') ? 'rgba(30, 58, 138, 0.08)' : 'rgba(30, 41, 59, 0.05)');
            }

            // Audio & Video controls
            let audioActive = true;
            let videoActive = true;
            function toggleAudio() {
                audioActive = !audioActive;
                document.getElementById('audio-btn').textContent = audioActive ? '🎙️' : '🔇';
                document.getElementById('audio-btn').style.borderColor = audioActive ? 'rgba(100, 116, 139, 0.6)' : '#ef4444';
            }
            function toggleVideo() {
                videoActive = !videoActive;
                document.getElementById('video-btn').textContent = videoActive ? '📹' : '🚫';
                document.getElementById('video-btn').style.borderColor = videoActive ? 'rgba(100, 116, 139, 0.6)' : '#ef4444';
            }

            // Simulated WebCam canvas visualizer
            const canvas = document.getElementById('camera-visualizer');
            const ctx = canvas.getContext('2d');
            function resizeCanvas() {
                canvas.width = canvas.parentElement.clientWidth;
                canvas.height = canvas.parentElement.clientHeight;
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            let waveOffset = 0;
            function drawVisualizer() {
                if (!canvas.width || !canvas.height) return;
                
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                if (!videoActive) {
                    ctx.fillStyle = '#0f172a';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.fillStyle = '#64748b';
                    ctx.font = '12px Plus Jakarta Sans';
                    ctx.textAlign = 'center';
                    ctx.fillText('Camera Disabled', canvas.width/2, canvas.height/2);
                    requestAnimationFrame(drawVisualizer);
                    return;
                }

                // Render camera backdrop gradient
                const grad = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
                grad.addColorStop(0, '#1e1b4b');
                grad.addColorStop(1, '#3b0764');
                ctx.fillStyle = grad;
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                // Render webcam scanning lines
                ctx.strokeStyle = 'rgba(139, 92, 246, 0.15)';
                ctx.lineWidth = 1;
                for (let i = 0; i < canvas.height; i += 6) {
                    ctx.beginPath();
                    ctx.moveTo(0, i);
                    ctx.lineTo(canvas.width, i);
                    ctx.stroke();
                }

                // Render wave movements
                ctx.strokeStyle = 'rgba(236, 72, 153, 0.25)';
                ctx.lineWidth = 2.5;
                ctx.beginPath();
                for (let x = 0; x < canvas.width; x++) {
                    const y = canvas.height/2 + Math.sin(x*0.02 + waveOffset) * 20 * Math.sin(waveOffset * 0.1);
                    if (x === 0) ctx.moveTo(x, y);
                    else ctx.lineTo(x, y);
                }
                ctx.stroke();

                ctx.strokeStyle = 'rgba(139, 92, 246, 0.3)';
                ctx.lineWidth = 1.5;
                ctx.beginPath();
                for (let x = 0; x < canvas.width; x++) {
                    const y = canvas.height/2 + Math.cos(x*0.015 - waveOffset) * 25 * Math.cos(waveOffset * 0.08);
                    if (x === 0) ctx.moveTo(x, y);
                    else ctx.lineTo(x, y);
                }
                ctx.stroke();

                waveOffset += 0.05;
                requestAnimationFrame(drawVisualizer);
            }
            drawVisualizer();

            // Classroom Simulation Chatbots & Attendance
            const students = [
                { name: 'John Doe', email: 'john@example.com' },
                { name: 'Sarah Connor', email: 'sarah@example.com' },
                { name: 'Michael Scott', email: 'michael@example.com' },
                { name: 'Bruce Wayne', email: 'bruce@example.com' },
                { name: 'Peter Parker', email: 'peter@example.com' }
            ];

            const mockStudentQuestions = [
                "Could you explain step 2 again?",
                "Is this table normalization required for 3NF?",
                "Will there be a laboratory lab this week?",
                "Makes perfect sense, thank you professor!",
                "Wow, this whiteboard interface is extremely smooth.",
                "How does the database index resolve this?",
                "Could we download these presentation notes?"
            ];

            const participantCountEl = document.getElementById('participant-count');
            const attendanceList = document.getElementById('attendance-list');
            const chatContainer = document.getElementById('chat-messages-container');
            const chatForm = document.getElementById('classroom-chat-form');
            const chatInput = document.getElementById('chat-input');
            
            let activeCount = 1; // Instructor initially

            // Append student attendees and count them dynamically
            function joinStudents() {
                students.forEach((student, index) => {
                    setTimeout(() => {
                        // Increment count
                        activeCount++;
                        participantCountEl.textContent = activeCount;

                        // Append attendee list row
                        const row = document.createElement('div');
                        row.className = 'flex items-center justify-between text-xs py-1 border-b border-slate-900/30';
                        row.innerHTML = `
                            <span class="text-slate-300 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                ${student.name}
                            </span>
                            <span class="text-[9px] text-slate-500">Present</span>
                        `;
                        attendanceList.appendChild(row);

                        // Post join notification
                        const joinNote = document.createElement('div');
                        joinNote.className = 'text-center text-[9px] text-slate-600 py-1';
                        joinNote.textContent = `Student ${student.name} joined the class.`;
                        chatContainer.appendChild(joinNote);
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }, (index + 1) * 3000); // 3s intervals
                });
            }
            joinStudents();

            // Append regular mock messages from students
            function startChatBot() {
                setInterval(() => {
                    if (activeCount <= 1) return; // Wait for students to join

                    const randomStudent = students[Math.floor(Math.random() * students.length)];
                    const randomQuestion = mockStudentQuestions[Math.floor(Math.random() * mockStudentQuestions.length)];
                    
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'space-y-1 bg-slate-900/30 border border-slate-900/50 p-2.5 rounded-xl';
                    msgDiv.innerHTML = `
                        <div class="flex justify-between items-center text-[10px]">
                            <strong class="text-slate-400">${randomStudent.name}</strong>
                            <span class="text-slate-600">Just now</span>
                        </div>
                        <p class="text-slate-300">${randomQuestion}</p>
                    `;
                    chatContainer.appendChild(msgDiv);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }, 12000); // Trigger student message every 12 seconds
            }
            startChatBot();

            // Reply helpers for classroom chat
            function setReplyParent(parentId, userName) {
                const parentIdInput = document.getElementById('parent-id-input');
                const replyIndicator = document.getElementById('reply-indicator');
                const replyUserLabel = document.getElementById('reply-user-label');
                
                if (parentIdInput) parentIdInput.value = parentId;
                if (replyUserLabel) replyUserLabel.textContent = userName;
                if (replyIndicator) replyIndicator.classList.remove('hidden');
                
                const textInput = document.querySelector('input[name="comment_text"]');
                if (textInput) {
                    textInput.focus();
                    textInput.placeholder = `Reply to ${userName}...`;
                }
            }

            function cancelReply() {
                const parentIdInput = document.getElementById('parent-id-input');
                const replyIndicator = document.getElementById('reply-indicator');
                
                if (parentIdInput) parentIdInput.value = '';
                if (replyIndicator) replyIndicator.classList.add('hidden');
                
                const textInput = document.querySelector('input[name="comment_text"]');
                if (textInput) {
                    textInput.placeholder = "Type a message or click Reply...";
                }
            }

            // Auto-scroll chat to bottom
            const chatMsgBox = document.getElementById('chat-messages-container');
            if (chatMsgBox) {
                chatMsgBox.scrollTop = chatMsgBox.scrollHeight;
            }
        </script>
    </body>
</html>
