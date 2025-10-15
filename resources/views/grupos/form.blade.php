@csrf

<div>
    <x-input-label for="nombre" :value="__('Nombre del Grupo')" />
    <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $grupo->nombre ?? '')" required autofocus maxlength="50" />
    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
</div>

<div class="mt-4">
    <x-input-label for="user_id" :value="__('Facilitador')" /> <select id="user_id" name="user_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs mt-1 block w-full" required>
        <option value="">Seleccione un Facilitador</option>
        @foreach ($facilitadores as $facilitador) <option value="{{ $facilitador->id }}" @selected(old('user_id', $grupo->user_id ?? '') == $facilitador->id)>
                {{ $facilitador->name }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
</div>

<div class="flex items-center justify-end mt-4">
    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>
</div>