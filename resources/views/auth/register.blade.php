<x-guest-layout>
<div class="min-h-screen flex font-sans antialiased bg-ivory">

    {{-- ═══════════════════ LEFT PANEL — Brand Visual ═══════════════════ --}}
    <div class="hidden lg:flex lg:w-5/12 xl:w-1/2 relative flex-col items-center justify-center overflow-hidden bg-wine">

        {{-- Soft radial glow blobs --}}
        <div class="absolute -top-32 -left-32 w-[26rem] h-[26rem] rounded-full bg-rose/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full bg-rose/10 blur-2xl pointer-events-none"></div>

        {{-- Decorative petal circles --}}
        <div class="absolute top-10 right-10 w-56 h-56 rounded-full border border-rose/20 opacity-40"></div>
        <div class="absolute top-16 right-16 w-44 h-44 rounded-full border border-rose/15 opacity-30"></div>
        <div class="absolute bottom-16 left-8 w-36 h-36 rounded-full border border-ivory/10 opacity-30"></div>

        {{-- Main content --}}
        <div class="relative z-10 px-12 text-center space-y-8 max-w-md">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="inline-block group">
                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Lolita Hand Made Flowers"
                    class="h-24 w-auto object-contain drop-shadow-2xl transition-transform duration-500 group-hover:scale-105 rounded-full bg-white/10 p-2"
                >
            </a>

            {{-- Headline --}}
            <div class="space-y-3">
                <h1 class="font-display text-4xl xl:text-5xl italic text-ivory leading-tight">
                    Join the Circle
                </h1>
                <div class="w-12 h-px bg-rose/60 mx-auto"></div>
                <p class="text-ivory/70 text-sm leading-relaxed tracking-wide">
                    Create your Lolita account and unlock exclusive floral collections, early access to seasonal drops, and artisan bouquet personalisation.
                </p>
            </div>

            {{-- Feature badges --}}
            <ul class="space-y-3 text-left">
                @foreach ([
                    ['icon' => '🌸', 'text' => 'Artisan hand-tied to order'],
                    ['icon' => '🚚', 'text' => 'Complimentary local delivery'],
                    ['icon' => '✨', 'text' => 'Members-only seasonal previews'],
                ] as $feature)
                    <li class="flex items-center gap-3 text-ivory/80 text-sm">
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-rose/20 flex items-center justify-center text-base">{{ $feature['icon'] }}</span>
                        {{ $feature['text'] }}
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Bottom quote --}}
        <div class="absolute bottom-8 text-center px-10">
            <p class="font-display italic text-rose/70 text-sm">"Every bloom tells a story — let's write yours."</p>
        </div>
    </div>

    {{-- ═══════════════════ RIGHT PANEL — Register Form ═══════════════════ --}}
    <div class="w-full lg:w-7/12 xl:w-1/2 flex items-center justify-center px-6 py-12 lg:py-0">
        <div class="w-full max-w-md space-y-8">

            {{-- Mobile logo --}}
            <div class="flex flex-col items-center lg:hidden space-y-3">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Lolita" class="h-16 w-auto object-contain rounded-full shadow-md">
                </a>
                <p class="font-display italic text-wine text-lg">Lolita Floral Studio</p>
            </div>

            {{-- Heading --}}
            <div class="space-y-1">
                <h2 class="font-display text-3xl xl:text-4xl italic text-wine">Create your account</h2>
                <p class="text-sm text-ink/50 tracking-wide">Fill in the details below to begin your floral journey.</p>
            </div>

            {{-- Error banner --}}
            @if ($errors->any())
                <div class="rounded-2xl bg-rose/10 border border-rose/30 px-4 py-3 flex gap-3 items-start">
                    <svg class="w-5 h-5 text-rose flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <ul class="text-sm text-rose/90 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Register Form --}}
            <form method="POST" action="{{ route('register') }}" class="space-y-5" id="register-form">
                @csrf

                {{-- Full Name --}}
                <div class="group">
                    <label for="name" class="block text-xs uppercase tracking-widest font-medium text-ink/60 mb-1.5">
                        Full Name
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-ink/30 group-focus-within:text-wine transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Your full name"
                            class="w-full pl-11 pr-4 py-3.5 rounded-2xl border {{ $errors->has('name') ? 'border-rose bg-rose/5' : 'border-rose/20 bg-white' }} text-ink text-sm placeholder-ink/30 focus:outline-none focus:border-wine focus:ring-2 focus:ring-wine/10 transition-all duration-200"
                        >
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-xs text-rose flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="group">
                    <label for="email" class="block text-xs uppercase tracking-widest font-medium text-ink/60 mb-1.5">
                        Email Address
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-ink/30 group-focus-within:text-wine transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="you@example.com"
                            class="w-full pl-11 pr-4 py-3.5 rounded-2xl border {{ $errors->has('email') ? 'border-rose bg-rose/5' : 'border-rose/20 bg-white' }} text-ink text-sm placeholder-ink/30 focus:outline-none focus:border-wine focus:ring-2 focus:ring-wine/10 transition-all duration-200"
                        >
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="group">
                    <label for="password" class="block text-xs uppercase tracking-widest font-medium text-ink/60 mb-1.5">
                        Password
                    </label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-ink/30 group-focus-within:text-wine transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </span>
                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Min. 8 characters"
                            class="w-full pl-11 pr-12 py-3.5 rounded-2xl border {{ $errors->has('password') ? 'border-rose bg-rose/5' : 'border-rose/20 bg-white' }} text-ink text-sm placeholder-ink/30 focus:outline-none focus:border-wine focus:ring-2 focus:ring-wine/10 transition-all duration-200"
                        >
                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-4 flex items-center text-ink/30 hover:text-wine transition-colors duration-200"
                            tabindex="-1"
                        >
                            <svg x-show="!showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>

                    {{-- Password strength meter --}}
                    <div class="mt-2 space-y-1" x-data="passwordStrength()">
                        <div class="flex gap-1">
                            <template x-for="i in 4" :key="i">
                                <div class="flex-1 h-1 rounded-full transition-all duration-300"
                                    :class="{
                                        'bg-rose': strength >= i && strength === 1,
                                        'bg-amber-400': strength >= i && strength === 2,
                                        'bg-lime-400': strength >= i && strength === 3,
                                        'bg-emerald-500': strength >= i && strength === 4,
                                        'bg-rose/15': strength < i
                                    }">
                                </div>
                            </template>
                        </div>
                        <p class="text-xs text-ink/40" x-text="label"></p>
                    </div>

                    @error('password')
                        <p class="mt-1.5 text-xs text-rose flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="group">
                    <label for="password_confirmation" class="block text-xs uppercase tracking-widest font-medium text-ink/60 mb-1.5">
                        Confirm Password
                    </label>
                    <div class="relative" x-data="{ showConfirm: false }">
                        <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-ink/30 group-focus-within:text-wine transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </span>
                        <input
                            id="password_confirmation"
                            :type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Re-enter your password"
                            class="w-full pl-11 pr-12 py-3.5 rounded-2xl border {{ $errors->has('password_confirmation') ? 'border-rose bg-rose/5' : 'border-rose/20 bg-white' }} text-ink text-sm placeholder-ink/30 focus:outline-none focus:border-wine focus:ring-2 focus:ring-wine/10 transition-all duration-200"
                        >
                        <button
                            type="button"
                            @click="showConfirm = !showConfirm"
                            class="absolute inset-y-0 right-4 flex items-center text-ink/30 hover:text-wine transition-colors duration-200"
                            tabindex="-1"
                        >
                            <svg x-show="!showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1.5 text-xs text-rose flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Terms notice --}}
                <p class="text-xs text-ink/40 leading-relaxed">
                    By creating an account you agree to our
                    <span class="text-wine underline-offset-2 hover:underline cursor-pointer transition-colors">Privacy Policy</span>
                    and
                    <span class="text-wine underline-offset-2 hover:underline cursor-pointer transition-colors">Terms of Service</span>.
                </p>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="group w-full flex items-center justify-center gap-2.5 bg-wine hover:bg-rose text-ivory rounded-2xl py-4 text-sm font-medium uppercase tracking-widest transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-wine/30"
                >
                    <svg class="w-4 h-4 transition-transform duration-300 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Create Account
                </button>

                {{-- Divider --}}
                <div class="relative flex items-center gap-4">
                    <div class="flex-1 h-px bg-rose/15"></div>
                    <span class="text-xs text-ink/30 uppercase tracking-widest">or</span>
                    <div class="flex-1 h-px bg-rose/15"></div>
                </div>

                {{-- Sign In link --}}
                <p class="text-center text-sm text-ink/50">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-wine font-medium hover:text-rose transition-colors duration-200 underline underline-offset-2">
                        Sign in
                    </a>
                </p>
            </form>

        </div>
    </div>
</div>

{{-- Alpine.js Password Strength Component --}}
<script>
function passwordStrength() {
    return {
        strength: 0,
        label: '',
        init() {
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', (e) => this.calculate(e.target.value));
            }
        },
        calculate(val) {
            let score = 0;
            if (!val) { this.strength = 0; this.label = ''; return; }
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;
            this.strength = score;
            this.label = ['', 'Weak', 'Fair', 'Good', 'Strong'][score] ?? '';
        }
    }
}
</script>
</x-guest-layout>
