@csrf

<div class="space-y-4">
    {{-- Campo Variable (Se usa como ID, no debería ser editable después de la creación) --}}
    <div>
        <x-input-label for="variable" :value="__('Variable (Clave)')" />
        @if(isset($configuracion))
            {{-- Enviar el valor real en edición, ya que el campo está deshabilitado --}}
            <input type="hidden" name="variable" value="{{ $configuracion->variable }}"/>
        @endif
        @php
            $disabled = isset($configuracion) ? 'disabled' : ''
        @endphp
        <x-text-input 
            id="variable" 
            name="variable" 
            type="text" 
            class="mt-1 block w-full" 
            :value="old('variable', $configuracion->variable ?? '')" 
            required 
            autofocus 
            autocomplete="off"
            :disabled="isset($configuracion)"
        ></x-text-input >
        <x-input-error class="mt-2" :messages="$errors->get('variable')" />
        <p class="text-xs text-gray-500 mt-1">{{ __('Solo se permiten minúsculas, números y guiones (ej: sistema-activo).') }}</p>
    </div>

        
    <div>
        <x-input-label for="valor" :value="__('Valor')" />
        <textarea id="valor" name="valor" class="w-full rounded-radius border border-outline px-2.5 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark" rows="3" :value="old('valor', $configuracion->valor ?? '')" required>
            {{ old('valor', $configuracion->valor ?? '') }}
        </textarea>
        <x-input-error class="mt-2" :messages="$errors->get('valor')" />
    </div>
</div>

<div class="flex items-center justify-end mt-6">
    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>
</div>