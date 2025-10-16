<x-guest-layout>
    <div class="flex gap-3 w-fit items-center border-b border-primary">
        <div class="font-bold text-primary" style="font-size: 32px;">
            PROMCE
        </div>
        <div class="text-slate-600 font-bold" style="font-size: clamp(10px, 3vw, 11px);line-height: 1.3;">
            Programa de mejoramiento<br>de la calidad educativa
        </div>
    </div>

    <div class="w-full max-w-sm">
        ¿Olvidó su contraseña? No hay problema. Escriba la dirección de correo electrónico con la cual se registró y le enviaremos un enlace para establecer una nueva contraseña.
    </div>

    <div class="w-full max-w-sm h-min p-3 sm:p-5 border border-primary space-y-5">
        <div class="text-lg text-primary font-bold">RESTABLECIMIENTO DE CONTRASEÑA</div>

         <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form class="space-y-5" method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    CONTINUAR
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
