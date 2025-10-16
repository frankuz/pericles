<x-guest-layout>
    <div class="max-w-4xl grid grid-cols-1 md:grid-cols-[1fr_20rem] gap-y-8 gap-x-20 w-full justify-items-center items-center">

        <div class="flex gap-3 w-fit items-center border-b border-primary">
            <div class="font-bold text-primary" style="font-size: 32px;">
                PROMCE
            </div>
            <div class="text-slate-600 font-bold" style="font-size: clamp(10px, 3vw, 11px);line-height: 1.3;">
                Programa de mejoramiento<br>de la calidad educativa
            </div>
        </div>

        <div class="w-full max-w-sm md:row-span-2 h-min p-3 sm:p-5 border border-primary space-y-5">
            <div class="text-lg text-primary font-bold">INICIO DE SESIÓN</div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')"/>
                </div>

                <!-- Password -->
                <div class="">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-red-600 shadow-xs focus:ring-red-500 dark:focus:ring-red-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <div class="w-full">
            <img src="{{ asset('images/diagrama-promce.svg') }}" >
        </div>

    </div>
</x-guest-layout>
