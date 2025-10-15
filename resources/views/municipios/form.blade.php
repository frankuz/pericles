@csrf

<div>
    <x-input-label for="departamento_id" :value="__('Departamento')" />
    <select id="departamento_id" name="departamento_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs mt-1 block w-full" required>
        <option value="">Seleccione un Departamento</option>
        @foreach ($departamentos as $departamento)
            <option value="{{ $departamento->id }}" @selected(old('departamento_id', $municipio->departamento_id ?? '') == $departamento->id)>
                {{ $departamento->nombre }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('departamento_id')" />
</div>

<div class="mt-4">
    <x-input-label for="codigo" :value="__('Código')" />
    <x-text-input id="codigo" name="codigo" type="text" class="mt-1 block w-full" :value="old('codigo', $municipio->codigo ?? '')" required autofocus maxlength="5" />
    <x-input-error class="mt-2" :messages="$errors->get('codigo')" />
</div>

<div class="mt-4">
    <x-input-label for="nombre" :value="__('Nombre')" />
    <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $municipio->nombre ?? '')" required maxlength="40" />
    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
</div>

<div class="mt-4">
    <x-input-label for="provincia" :value="__('Provincia (Opcional)')" />
    <x-text-input id="provincia" name="provincia" type="text" class="mt-1 block w-full" :value="old('provincia', $municipio->provincia ?? '')" maxlength="40" />
    <x-input-error class="mt-2" :messages="$errors->get('provincia')" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>
</div>