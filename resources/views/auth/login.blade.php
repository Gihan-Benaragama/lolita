<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-rose-50 via-white to-rose-100">
        <div class="bg-white/30 backdrop-blur-md rounded-xl shadow-xl p-8 max-w-md w-full mx-4">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Lolita Logo" class="h-16">
            </div>
            <h2 class="text-2xl font-bold text-wine text-center mb-2">Welcome Back</h2>
            <p class="text-center text-gray-600 mb-6">Sign in to access your account and continue your floral journey.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    <div class="block mt-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-primary-button class="ml-3 bg-gradient-to-r from-wine to-pink-500 hover:from-pink-500 hover:to-wine text-white">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm">
                {{ "Don't have an account?" }} <a href="{{ route('register') }}" class="text-wine font-medium underline">{{ __('Create one') }}</a>
            </p>
        </div>
    </div>
</x-guest-layout>
