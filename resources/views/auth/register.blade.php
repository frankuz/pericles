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
            <div class="text-lg text-primary font-bold">REGISTRO</div>

            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

        </div>

        <div class="w-full">
            <img src="{{ asset('images/diagrama-promce.svg') }}" >
        </div>

    </div>
</x-guest-layout>
