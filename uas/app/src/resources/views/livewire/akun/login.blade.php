@section('nav')
    @include('components.partials.nav-akun')
@endsection

<div
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

        button[type="submit"]:disabled {
            background-color: #ccc;
            cursor: not-allowed;
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
    </style>

    <h2 class="text-lg font-semibold mb-5">Login Akun</h2>

    <form wire:submit.prevent="login" novalidate>
        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" wire:model.lazy="email" class="w-full" />
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 relative">
            <label for="password">Password</label>
            <input type="{{ $showPassword ? 'text' : 'password' }}" id="password"
                wire:model.lazy="password" class="w-full pr-10" />
            <button type="button" wire:click="toggleShowPassword" class="icon-btn"
                aria-label="Toggle password visibility">
                @if (!$showPassword)
                    <img src="/front/images/eye-open.svg" alt="Lihat password" />
                @else
                    <img src="/front/images/eye-striked.svg" alt="Sembunyikan password" />
                @endif
            </button>
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            @disabled(!$email || !$password)>
            Login
        </button>
    </form>
</div>