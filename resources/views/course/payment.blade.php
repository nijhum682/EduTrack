<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Secure Enrollment Payment - {{ $course->title }}</title>
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- Tailwind CSS -->
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
            :root {
                --input-text: #ffffff;
                --input-bg: rgba(2, 6, 23, 0.5);
                --input-border: #1e293b;
                --card-bg: rgba(15, 23, 42, 0.6);
                --card-border: rgba(30, 41, 59, 0.8);
                --text-title: #ffffff;
                --text-desc: #cbd5e1;
                --text-label: #cbd5e1;
                
                /* SMS simulator variables */
                --sms-bg: rgba(30, 27, 75, 0.25);
                --sms-border: rgba(49, 46, 129, 0.5);
                --sms-title: #818cf8;
                --sms-text: #94a3b8;
                --sms-code: #f1f5f9;
                
                --btn-sec-text: #94a3b8;
                --btn-sec-hover: #cbd5e1;
            }

            body.theme-space-light {
                --input-text: #0f172a;
                --input-bg: #ffffff;
                --input-border: #cbd5e1;
                --card-bg: rgba(255, 255, 255, 0.75);
                --card-border: rgba(226, 232, 240, 0.8);
                --text-title: #0f172a;
                --text-desc: #334155;
                --text-label: #1e293b;
                
                /* SMS simulator variables (light theme) */
                --sms-bg: rgba(239, 246, 255, 0.85);
                --sms-border: rgba(191, 219, 254, 1);
                --sms-title: #4f46e5;
                --sms-text: #475569;
                --sms-code: #0f172a;
                
                --btn-sec-text: #475569;
                --btn-sec-hover: #0f172a;
            }

            .payment-card-selected-bkash {
                border-color: #ec4899 !important;
                background-color: rgba(236, 72, 153, 0.15) !important;
            }
            .payment-card-selected-nagad {
                border-color: #f97316 !important;
                background-color: rgba(249, 115, 22, 0.15) !important;
            }
            .payment-card-selected-card {
                border-color: #6366f1 !important;
                background-color: rgba(99, 102, 241, 0.15) !important;
            }

            .custom-bg {
                background-color: #080c14;
                background-image: 
                    linear-gradient(rgba(8, 12, 20, 0.85), rgba(8, 12, 20, 0.85)),
                    url('{{ asset('images/header-image.png') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }

            body.theme-space-light .custom-bg {
                background-color: #f8fafc;
                background-image: 
                    linear-gradient(rgba(248, 250, 252, 0.9), rgba(248, 250, 252, 0.9)),
                    url('{{ asset('images/header-image.png') }}');
            }

            .glass-panel {
                background: var(--card-bg);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid var(--card-border);
            }

            #pin-input {
                -webkit-text-security: disc !important;
                text-security: disc !important;
            }

            /* Animations */
            .checkmark {
                width: 72px;
                height: 72px;
                border-radius: 50%;
                display: block;
                stroke-width: 2;
                stroke: #22c55e;
                stroke-miterlimit: 10;
                box-shadow: inset 0px 0px 0px #22c55e;
                animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out 0s both;
                margin: 0 auto;
            }
            .checkmark__circle {
                stroke-dasharray: 166;
                stroke-dashoffset: 166;
                stroke-width: 2;
                stroke-miterlimit: 10;
                stroke: #22c55e;
                fill: none;
                animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            }
            .checkmark__check {
                transform-origin: 50% 50%;
                stroke-dasharray: 48;
                stroke-dashoffset: 48;
                animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
            }

            @keyframes stroke {
                100% { stroke-dashoffset: 0; }
            }
            @keyframes scale {
                0%, 100% { transform: none; }
                50% { transform: scale3d(1.1, 1.1, 1); }
            }
            @keyframes fill {
                100% { box-shadow: inset 0px 0px 0px 30px rgba(34, 197, 94, 0.1); }
            }
        </style>
    </head>
    <body class="theme-space-dark min-h-screen flex flex-col font-sans transition-colors duration-500">
        
        <div class="custom-bg min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Theme Toggler Button -->
            <button onclick="toggleTheme()" class="absolute top-6 right-6 w-10 h-10 rounded-xl bg-slate-900/60 hover:bg-slate-800/80 border border-slate-800 flex items-center justify-center text-slate-300 hover:text-white transition cursor-pointer z-50">
                <span id="theme-icon">☀️</span>
            </button>

            <!-- Main Panel -->
            <div class="w-full max-w-md glass-panel rounded-2xl p-8 shadow-2xl relative z-10 space-y-6">
                <!-- Course Overview Header -->
                <div class="text-center border-b border-slate-800/60 pb-5">
                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-slate-900/80 text-indigo-400 border border-indigo-500/25">SECURE CHECKOUT</span>
                    <h1 class="text-xl font-bold tracking-tight text-[var(--text-title)] mt-2 leading-tight">{{ $course->code }} &middot; {{ $course->title }}</h1>
                    <p class="text-xs text-[var(--text-desc)] mt-1.5">Instructor: <span class="font-semibold text-indigo-400">{{ $course->instructor }}</span></p>
                    <div class="text-2xl font-extrabold text-[var(--text-title)] mt-3 flex items-center justify-center gap-1">
                        <span class="text-indigo-400 font-bold">৳</span>
                        <span>{{ $course->enrollment_fee }}</span>
                        <span class="text-xs font-semibold text-[var(--btn-sec-text)] ml-1">Taka Only</span>
                    </div>
                </div>

                <!-- Wizard Steps Wrapper -->
                <div id="payment-wizard">

                    <!-- STEP 1: SELECT METHOD -->
                    <div id="step-1" class="space-y-4">
                        <h2 class="text-sm font-bold text-[var(--text-title)]">Choose Payment Method</h2>
                        
                        <div class="grid grid-cols-3 gap-3">
                            <!-- Bkash -->
                            <div onclick="selectMethod('bkash')" id="method-bkash" class="border border-[var(--input-border)] rounded-xl p-4 bg-[var(--input-bg)] hover:border-pink-500/50 flex flex-col items-center gap-3 transition cursor-pointer text-center group">
                                <div class="w-12 h-12 bg-pink-500/10 text-pink-400 border border-pink-500/25 rounded-lg flex items-center justify-center font-bold text-xl uppercase group-hover:scale-105 transition-transform">
                                    ৳
                                </div>
                                <span class="text-xs font-bold text-[var(--text-title)]">bKash</span>
                            </div>

                            <!-- Nagad -->
                            <div onclick="selectMethod('nagad')" id="method-nagad" class="border border-[var(--input-border)] rounded-xl p-4 bg-[var(--input-bg)] hover:border-orange-500/50 flex flex-col items-center gap-3 transition cursor-pointer text-center group">
                                <div class="w-12 h-12 bg-orange-500/10 text-orange-400 border border-orange-500/25 rounded-lg flex items-center justify-center font-bold text-xl uppercase group-hover:scale-105 transition-transform">
                                    ৳
                                </div>
                                <span class="text-xs font-bold text-[var(--text-title)]">Nagad</span>
                            </div>

                            <!-- Card -->
                            <div onclick="selectMethod('card')" id="method-card" class="border border-[var(--input-border)] rounded-xl p-4 bg-[var(--input-bg)] hover:border-indigo-500/50 flex flex-col items-center gap-3 transition cursor-pointer text-center group">
                                <div class="w-12 h-12 bg-indigo-500/10 text-indigo-400 border border-indigo-500/25 rounded-lg flex items-center justify-center font-bold text-xl uppercase group-hover:scale-105 transition-transform">
                                    💳
                                </div>
                                <span class="text-xs font-bold text-[var(--text-title)]">Card</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-[var(--input-border)] mt-4">
                            <a href="{{ route('dashboard') }}" class="text-xs text-[var(--btn-sec-text)] hover:text-[var(--btn-sec-hover)] transition font-semibold">Back to Dashboard</a>
                            <button onclick="goToStep(2)" id="btn-next-1" disabled class="bg-indigo-600 hover:bg-indigo-500 disabled:opacity-40 disabled:hover:bg-indigo-600 text-white font-semibold text-xs py-2.5 px-6 rounded-xl transition cursor-pointer shadow-md shadow-indigo-600/10">
                                Next Step
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: ACCOUNT NUMBER -->
                    <div id="step-2" class="hidden space-y-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span id="branding-badge" class="px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase">BKASH</span>
                            <h2 class="text-sm font-bold text-[var(--text-title)]">Enter Account Details</h2>
                        </div>

                        <div>
                            <label id="account-label" class="block text-xs text-[var(--text-label)] font-semibold mb-2">Wallet Account Number</label>
                            <input type="text" id="account-number" name="wallet_number" autocomplete="new-password" placeholder="e.g. 01712345678" class="w-full bg-[var(--input-bg)] border border-[var(--input-border)] text-[var(--input-text)] rounded-xl py-3 px-4 text-sm outline-none focus:border-indigo-500 transition">
                            <p id="account-error" class="text-[10px] text-red-400 mt-1.5 hidden">Please enter a valid wallet number.</p>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-[var(--input-border)] mt-4">
                            <button onclick="goToStep(1)" class="text-xs text-[var(--btn-sec-text)] hover:text-[var(--btn-sec-hover)] transition font-semibold cursor-pointer">Previous</button>
                            <button onclick="validateStep2()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs py-2.5 px-6 rounded-xl transition cursor-pointer shadow-md shadow-indigo-600/10">
                                Send OTP
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: OTP VERIFICATION -->
                    <div id="step-3" class="hidden space-y-4">
                        <h2 class="text-sm font-bold text-[var(--text-title)]">One-Time Password (OTP)</h2>
                        <p class="text-xs text-[var(--text-desc)] leading-relaxed">We sent a temporary verification code to your device. Enter the code below to authorize the fee.</p>

                        <div>
                            <input type="text" id="otp-input" placeholder="Enter 4-digit code" class="w-full bg-[var(--input-bg)] border border-[var(--input-border)] text-[var(--input-text)] rounded-xl py-3 px-4 text-sm text-center font-mono tracking-widest outline-none focus:border-indigo-500 transition">
                            <p id="otp-error" class="text-[10px] text-red-400 mt-1.5 hidden"></p>
                        </div>

                        <!-- SMS Simulator Box -->
                        <div id="otp-sms-box" class="bg-[var(--sms-bg)] border border-[var(--sms-border)] rounded-xl p-3 flex items-start gap-2.5 transition duration-300">
                            <span class="text-xs">💬</span>
                            <div class="leading-normal">
                                <strong class="text-[10px] text-[var(--sms-title)] font-bold block uppercase tracking-wider">Simulated Message</strong>
                                <span class="text-[10px] text-[var(--sms-text)]">EduTrack Security Code: <strong class="text-[var(--sms-code)]" id="otp-sms-code">----</strong> (expires in 5s)</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-[var(--input-border)] mt-4">
                            <button onclick="goToStep(2)" class="text-xs text-[var(--btn-sec-text)] hover:text-[var(--btn-sec-hover)] transition font-semibold cursor-pointer">Change Wallet</button>
                            <button onclick="validateStep3()" class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs py-2.5 px-6 rounded-xl transition cursor-pointer shadow-md shadow-indigo-600/10">
                                Verify OTP
                            </button>
                        </div>
                    </div>

                    <!-- STEP 4: PIN VERIFICATION -->
                    <div id="step-4" class="hidden space-y-4">
                        <h2 class="text-sm font-bold text-[var(--text-title)]">Transaction PIN</h2>
                        <p class="text-xs text-[var(--text-desc)] leading-relaxed">Security requirement: Please authenticate with your secure transaction PIN to finalize the payment.</p>

                        <div>
                            <input type="text" id="pin-input" autocomplete="new-password" placeholder="Enter security PIN" class="w-full bg-[var(--input-bg)] border border-[var(--input-border)] text-[var(--input-text)] rounded-xl py-3 px-4 text-sm text-center tracking-widest outline-none focus:border-indigo-500 transition">
                            <p id="pin-error" class="text-[10px] text-red-400 mt-1.5 hidden"></p>
                        </div>

                        <!-- SMS Simulator Box -->
                        <div id="pin-sms-box" class="bg-[var(--sms-bg)] border border-[var(--sms-border)] rounded-xl p-3 flex items-start gap-2.5 transition duration-300">
                            <span class="text-xs">💬</span>
                            <div class="leading-normal">
                                <strong class="text-[10px] text-[var(--sms-title)] font-bold block uppercase tracking-wider">Simulated Message</strong>
                                <span class="text-[10px] text-[var(--sms-text)]">Your secure transaction PIN is <strong class="text-[var(--sms-code)]" id="pin-sms-code">----</strong> (expires in 5s)</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-[var(--input-border)] mt-4">
                            <button onclick="goToStep(3)" class="text-xs text-[var(--btn-sec-text)] hover:text-[var(--btn-sec-hover)] transition font-semibold cursor-pointer">Previous</button>
                            <button onclick="validateStep4()" id="btn-pay" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-xs py-2.5 px-6 rounded-xl transition cursor-pointer shadow-lg shadow-indigo-600/20">
                                Verify & Pay
                            </button>
                        </div>
                    </div>

                    <!-- STEP 5: SUCCESS TICK -->
                    <div id="step-5" class="hidden text-center space-y-6 py-4">
                        <div class="success-checkmark">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>

                        <div class="space-y-1">
                            <h2 class="text-lg font-bold text-emerald-400">Enrollment Successful!</h2>
                            <p class="text-xs text-slate-400">You are now registered in the course.</p>
                        </div>

                        <!-- Receipt Details -->
                        <div class="bg-[var(--input-bg)] border border-[var(--input-border)] rounded-xl p-4 text-left text-xs space-y-2 max-w-xs mx-auto">
                            <div class="flex justify-between border-b border-[var(--input-border)] pb-1.5">
                                <span class="text-[var(--btn-sec-text)]">Method:</span>
                                <strong class="text-[var(--text-title)] uppercase" id="receipt-method">bKash</strong>
                            </div>
                            <div class="flex justify-between border-b border-[var(--input-border)] pb-1.5">
                                <span class="text-[var(--btn-sec-text)]">Account:</span>
                                <strong class="text-[var(--text-title)]" id="receipt-account">01712345678</strong>
                            </div>
                            <div class="flex justify-between pb-0.5">
                                <span class="text-[var(--btn-sec-text)]">Amount Paid:</span>
                                <strong class="text-emerald-400">৳ {{ $course->enrollment_fee }}</strong>
                            </div>
                        </div>

                        <div class="pt-4">
                            <a href="{{ route('dashboard') }}" class="inline-block bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs py-3 px-8 rounded-xl transition cursor-pointer shadow-md shadow-indigo-600/15">
                                Go to Student Dashboard
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script>
            // Theme toggling logic
            const currentTheme = localStorage.getItem('theme') || 'dark';
            if (currentTheme === 'light') {
                document.body.classList.remove('theme-space-dark');
                document.body.classList.add('theme-space-light');
                document.getElementById('theme-icon').innerText = '🌙';
            } else {
                document.body.classList.remove('theme-space-light');
                document.body.classList.add('theme-space-dark');
                document.getElementById('theme-icon').innerText = '☀️';
            }

            function toggleTheme() {
                const body = document.body;
                const icon = document.getElementById('theme-icon');
                if (body.classList.contains('theme-space-dark')) {
                    body.classList.remove('theme-space-dark');
                    body.classList.add('theme-space-light');
                    icon.innerText = '🌙';
                    localStorage.setItem('theme', 'light');
                } else {
                    body.classList.remove('theme-space-light');
                    body.classList.add('theme-space-dark');
                    icon.innerText = '☀️';
                    localStorage.setItem('theme', 'dark');
                }
            }

            // Wizard States
            let selectedMethod = '';
            let accountNumber = '';
            let currentOtp = '';
            let currentPin = '';
            let otpTimeoutId = null;
            let pinTimeoutId = null;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const courseId = "{{ $course->id }}";

            // Select payment method card
            function selectMethod(method) {
                selectedMethod = method;
                
                // Clear selection states
                document.getElementById('method-bkash').className = document.getElementById('method-bkash').className.replace(/\b(payment-card-selected-bkash|payment-card-selected-nagad|payment-card-selected-card)\b/g, '').trim();
                document.getElementById('method-nagad').className = document.getElementById('method-nagad').className.replace(/\b(payment-card-selected-bkash|payment-card-selected-nagad|payment-card-selected-card)\b/g, '').trim();
                document.getElementById('method-card').className = document.getElementById('method-card').className.replace(/\b(payment-card-selected-bkash|payment-card-selected-nagad|payment-card-selected-card)\b/g, '').trim();

                // Apply active select card style
                if (method === 'bkash') {
                    document.getElementById('method-bkash').classList.add('payment-card-selected-bkash');
                } else if (method === 'nagad') {
                    document.getElementById('method-nagad').classList.add('payment-card-selected-nagad');
                } else if (method === 'card') {
                    document.getElementById('method-card').classList.add('payment-card-selected-card');
                }

                // Enable next button
                document.getElementById('btn-next-1').removeAttribute('disabled');
            }

            // Show and hide step views
            function goToStep(step) {
                // Clear errors
                document.getElementById('account-error').classList.add('hidden');
                document.getElementById('otp-error').classList.add('hidden');
                document.getElementById('pin-error').classList.add('hidden');

                // Hide all steps
                document.getElementById('step-1').classList.add('hidden');
                document.getElementById('step-2').classList.add('hidden');
                document.getElementById('step-3').classList.add('hidden');
                document.getElementById('step-4').classList.add('hidden');
                document.getElementById('step-5').classList.add('hidden');

                // Clear any timers
                if (otpTimeoutId) clearTimeout(otpTimeoutId);
                if (pinTimeoutId) clearTimeout(pinTimeoutId);

                // Show target step
                document.getElementById(`step-${step}`).classList.remove('hidden');

                if (step === 2) {
                    const badge = document.getElementById('branding-badge');
                    const label = document.getElementById('account-label');
                    const input = document.getElementById('account-number');

                    // Style Step 2 according to selected method
                    if (selectedMethod === 'bkash') {
                        badge.innerText = 'bKash';
                        badge.className = 'px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase bg-pink-500/10 text-pink-400 border border-pink-500/20';
                        label.innerText = 'bKash Wallet Number';
                        input.placeholder = 'e.g. 01712345678';
                    } else if (selectedMethod === 'nagad') {
                        badge.innerText = 'Nagad';
                        badge.className = 'px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase bg-orange-500/10 text-orange-400 border border-orange-500/20';
                        label.innerText = 'Nagad Wallet Number';
                        input.placeholder = 'e.g. 01712345678';
                    } else {
                        badge.innerText = 'Card';
                        badge.className = 'px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase bg-indigo-500/10 text-indigo-400 border border-indigo-500/20';
                        label.innerText = 'Debit / Credit Card Number';
                        input.placeholder = 'e.g. 4242 •••• •••• 4242';
                    }
                } else if (step === 3) {
                    generateOtp();
                } else if (step === 4) {
                    generatePin();
                }
            }

            // Step 2 validation
            function validateStep2() {
                const input = document.getElementById('account-number');
                const val = input.value.trim();

                if (val.length < 8) {
                    document.getElementById('account-error').classList.remove('hidden');
                    return;
                }

                accountNumber = val;
                goToStep(3);
            }

            // Generate Simulated SMS OTP (visible for 5s, valid until submission)
            function generateOtp() {
                currentOtp = Math.floor(1000 + Math.random() * 9000).toString();
                const smsBox = document.getElementById('otp-sms-box');
                const labelCode = document.getElementById('otp-sms-code');
                
                smsBox.style.opacity = '1';
                labelCode.innerText = currentOtp;
                
                if (otpTimeoutId) clearTimeout(otpTimeoutId);
                
                otpTimeoutId = setTimeout(() => {
                    smsBox.style.opacity = '0';
                }, 5000);
            }

            // Step 3 validation
            function validateStep3() {
                const otpInput = document.getElementById('otp-input');
                const typed = otpInput.value.trim();
                const error = document.getElementById('otp-error');

                if (typed !== currentOtp) {
                    error.innerText = 'Invalid verification code. A new code has been sent.';
                    error.classList.remove('hidden');
                    otpInput.value = '';
                    generateOtp();
                    return;
                }

                currentOtp = ''; // clear OTP once verified successfully
                goToStep(4);
            }

            // Generate Simulated SMS PIN (visible for 5s, valid until submission)
            function generatePin() {
                currentPin = Math.floor(1000 + Math.random() * 9000).toString();
                const smsBox = document.getElementById('pin-sms-box');
                const labelCode = document.getElementById('pin-sms-code');

                smsBox.style.opacity = '1';
                labelCode.innerText = currentPin;

                if (pinTimeoutId) clearTimeout(pinTimeoutId);

                pinTimeoutId = setTimeout(() => {
                    smsBox.style.opacity = '0';
                }, 5000);
            }

            // Step 4 validation & API submit
            async function validateStep4() {
                const pinInput = document.getElementById('pin-input');
                const typed = pinInput.value.trim();
                const error = document.getElementById('pin-error');
                const btnPay = document.getElementById('btn-pay');

                if (typed !== currentPin) {
                    error.innerText = 'Invalid security PIN. A new PIN has been sent.';
                    error.classList.remove('hidden');
                    pinInput.value = '';
                    generatePin();
                    return;
                }

                currentPin = ''; // clear PIN once verified successfully

                // Proceed with backend API post
                btnPay.disabled = true;
                btnPay.innerText = 'Authorizing...';

                try {
                    const response = await fetch(`/course/${courseId}/payment/complete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            payment_method: selectedMethod,
                            account_number: accountNumber
                        })
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        // Show step 5 receipt details
                        document.getElementById('receipt-method').innerText = selectedMethod;
                        document.getElementById('receipt-account').innerText = accountNumber;
                        goToStep(5);
                    } else {
                        error.innerText = data.message || 'Payment system error. Please try again.';
                        error.classList.remove('hidden');
                        btnPay.disabled = false;
                        btnPay.innerText = 'Verify & Pay';
                    }
                } catch (err) {
                    console.error('Payment network failure:', err);
                    error.innerText = 'Connection error. Check your internet link.';
                    error.classList.remove('hidden');
                    btnPay.disabled = false;
                    btnPay.innerText = 'Verify & Pay';
                }
            }
        </script>
    </body>
</html>
