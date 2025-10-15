@csrf

<div>
    <x-input-label for="codigo" :value="__('Código')" />
    <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo', $departamento->codigo ?? '')" required autofocus maxlength="2" />
    <x-input-error class="mt-2" :messages="$errors->get('codigo')" />
</div>

<div class="mt-4">
    <x-input-label for="nombre" :value="__('Nombre')" />
    <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $departamento->nombre ?? '')" required maxlength="50" />
    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
</div>

<div class="mt-4">
    <x-input-label for="abreviatura" :value="__('Abreviatura')" />
    <x-text-input id="abreviatura" name="abreviatura" type="text" class="mt-1 block w-full" :value="old('abreviatura', $departamento->abreviatura ?? '')" maxlength="3" />
    <x-input-error class="mt-2" :messages="$errors->get('abreviatura')" />
</div>

<div class="mt-4">
    <x-input-label for="codigo_iso" :value="__('Código ISO')" />
    <x-text-input id="codigo_iso" name="codigo_iso" type="text" class="mt-1 block w-full" :value="old('codigo_iso', $departamento->codigo_iso ?? '')" maxlength="6" />
    <x-input-error class="mt-2" :messages="$errors->get('codigo_iso')" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>
</div>