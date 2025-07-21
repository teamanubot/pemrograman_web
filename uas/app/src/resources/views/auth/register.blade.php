@extends('auth.app')

@section('nav')
    @include('components.partials.nav-akun')
@endsection

@section('content')
    <div x-data="{ showPassword: false, showConfirmPassword: false }"
        :style="{
            '--bg-color': '#ffffff',
            '--text-color': '#111',
            '--border-color': '#ccc',
            '--input-bg': '#fff',
            '--input-text': '#111',
            '--button-bg': '#2563eb',
            '--button-text': '#fff',
        }"
        class="max-w-xs mx-auto mt-8 p-5 rounded-md shadow-md"
        style="background-color: var(--bg-color); color: var(--text-color);">
        <style>
            input,
            button,
            select,
            textarea {
                font: inherit;
                margin: 0;
                padding: 0;
                background: none;
                border: none;
                outline: none;
                color: var(--input-text);
                background-color: var(--input-bg);
            }

            label {
                display: block;
                margin-bottom: 0.25rem;
                font-weight: 600;
                font-size: 0.9rem;
            }

            input.w-full {
                width: 100%;
                border: 1px solid var(--border-color);
                padding: 0.4rem 0.75rem;
                border-radius: 0.375rem;
                font-size: 0.9rem;
            }

            button[type="submit"] {
                background-color: var(--button-bg);
                color: var(--button-text);
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
                border: none;
                font-size: 0.95rem;
                font-weight: 600;
                width: 100%;
                margin-top: 1rem;
            }

            .mb-3 {
                margin-bottom: 0.75rem;
            }

            .relative {
                position: relative;
            }

            .icon-btn {
                position: absolute;
                top: 20%;
                right: 0.75rem;
                transform: translateY(-50%);
                background: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
                display: flex;
                align-items: center;
                color: var(--text-color);
            }

            .icon-btn img {
                width: 20px;
                height: 20px;
            }

            .text-red-500 {
                color: #ef4444;
                font-size: 0.8rem;
                margin-top: 0.25rem;
                display: block;
            }

            .otp-wrapper {
                display: flex;
                gap: 8px;
            }

            .otp-input {
                flex: 1;
                padding: 0.5rem 0.75rem;
                border: 1px solid #ccc;
                border-radius: 6px;
                font-size: 0.9rem;
            }

            .otp-button {
                padding: 0.5rem 0.75rem;
                background-color: #3b82f6;
                /* biru */
                color: #fff;
                font-weight: 600;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                white-space: nowrap;
            }

            .otp-button:hover {
                background-color: #2563eb;
            }

            .otp-feedback {
                display: block;
                margin-top: 0.3rem;
                font-size: 0.85rem;
                color: #16a34a;
            }

            .otp-button:disabled {
                background-color: #93c5fd;
                cursor: not-allowed;
            }
        </style>

        <h2 class="text-lg font-semibold mb-5">Daftar Akun</h2>

        <form action="{{ route('akun.register.submit') }}" method="POST" novalidate>
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full" />
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full" />
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nomor WhatsApp</label>
                <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number') }}"
                    class="w-full" />
                @error('whatsapp_number')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="otp_input">Kode OTP</label>
                <div class="otp-wrapper">
                    <input type="text" id="otp_input" name="otp_input" class="otp-input"
                        placeholder="Masukkan kode OTP" />
                    <button type="button" onclick="sendOtp()" class="otp-button">Kirim OTP</button>
                </div>
                <small id="otp-feedback" class="otp-feedback"></small>
                @error('otp_input')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-3 relative">
                <label for="password">Password</label>
                <input :type="showPassword ? 'text' : 'password'" name="password" id="password" class="w-full pr-10" />
                <button type="button" @click="showPassword = !showPassword" class="icon-btn">
                    <img :src="showPassword ? '/front/images/eye-striked.svg' : '/front/images/eye-open.svg'"
                        alt="Toggle" />
                </button>
                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 relative">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation"
                    id="password_confirmation" class="w-full pr-10" />
                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="icon-btn">
                    <img :src="showConfirmPassword ? '/front/images/eye-striked.svg' : '/front/images/eye-open.svg'"
                        alt="Toggle" />
                </button>
            </div>

            <button type="submit">Daftar</button>
        </form>
        <script>
            let otpCooldown = false;
            let otpTimer;

            function sendOtp() {
                if (otpCooldown) return; // Blok kirim ulang kalau cooldown

                const number = document.getElementById('whatsapp_number').value;
                const feedback = document.getElementById('otp-feedback');
                const btn = document.querySelector('.otp-button');

                feedback.textContent = 'Mengirim kode...';
                feedback.classList.remove('text-danger');
                feedback.classList.add('text-success');

                fetch("{{ route('send.otp') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            whatsapp_number: number
                        })
                    })
                    .then(async response => {
                        const contentType = response.headers.get('content-type') || '';
                        if (!contentType.includes('application/json')) {
                            throw new Error('Respon bukan JSON');
                        }
                        const data = await response.json();

                        feedback.textContent = data.message;

                        if (response.ok) {
                            startOtpCooldown(btn, feedback);
                        } else {
                            feedback.classList.remove('text-success');
                            feedback.classList.add('text-danger');
                        }
                    })
                    .catch(err => {
                        feedback.textContent = 'Terjadi kesalahan: ' + err.message;
                        feedback.classList.remove('text-success');
                        feedback.classList.add('text-danger');
                    });
            }

            function startOtpCooldown(button, feedback) {
                otpCooldown = true;
                let seconds = 300; // 5 menit

                button.disabled = true;
                button.textContent = `Tunggu 5:00`;

                otpTimer = setInterval(() => {
                    seconds--;

                    const min = String(Math.floor(seconds / 60)).padStart(1, '0');
                    const sec = String(seconds % 60).padStart(2, '0');

                    button.textContent = `Tunggu ${min}:${sec}`;

                    if (seconds <= 0) {
                        clearInterval(otpTimer);
                        otpCooldown = false;
                        button.disabled = false;
                        button.textContent = 'Kirim OTP';
                        feedback.textContent = '';
                    }
                }, 1000);
            }
        </script>
    </div>
@endsection
