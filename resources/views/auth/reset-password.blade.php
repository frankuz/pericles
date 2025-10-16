<x-guest-layout>
    <div class="flex gap-3 w-fit items-center border-b border-primary">
        <div class="font-bold text-primary" style="font-size: 32px;">
            PROMCE
        </div>
        <div class="text-slate-600 font-bold" style="font-size: clamp(10px, 3vw, 11px);line-height: 1.3;">
            Programa de mejoramiento<br>de la calidad educativa
        </div>
    </div>

    <div class="w-full max-w-sm h-min p-3 sm:p-5 border border-primary space-y-5">
        <div class="text-lg text-primary font-bold">NUEVA CONTRASEÑA</div>

         <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form class="space-y-5" method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
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
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
