<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Social Login Buttons -->
        <div class="flex items-center justify-center mt-6 space-x-4">
            <!-- Login with Google -->
            <a href="{{ route('google.login') }}" class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-800 font-semibold hover:bg-gray-100">
                <img src="google.svg" alt="Google" class="h-5 w-5 me-2">


                {{ __('Google') }}
            </a>

            <!-- Login with Facebook -->
            <a href="{{ route('facebook.login') }}" class="flex items-center justify-center w-full px-4 py-2 border border-blue-500 rounded-md shadow-sm bg-blue-500 text-white font-semibold hover:bg-blue-600">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="h-5 w-5 me-2">

                {{ __('Facebook') }}
            </a>
            
        </div>
        <!-- Register Button -->
<div class="flex items-center justify-center mt-6">
    <a href="{{ route('register') }}" class="w-full text-center px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">
        {{ __('Register use email') }}
    </a>
</div>
    </form>
</x-guest-layout>
