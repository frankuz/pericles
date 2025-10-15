@section('fields')
@props(['institucion', 'grupos'])

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="col-span-1">
        <x-input-label for="dane" :value="__('DANE')" />
        <x-text-input id="dane" name="dane" type="text" class="mt-1 block w-full" :value="old('dane', $institucion->dane)" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('dane')" />
    </div>

    <div class="col-span-2">
        <x-input-label for="nombre" :value="__('Nombre de la Institución')" />
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $institucion->nombre)" required />
        <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
    </div>
    
    <div class="col-span-1">
        <x-input-label for="estado" :value="__('Estado')" />
        <select id="estado" name="estado" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs" required>
            <option value="activo" {{ old('estado', $institucion->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('estado', $institucion->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')" />
    </div>

    <div class="col-span-1">
        <x-input-label for="grupo_id" :value="__('Grupo')" />
        <select id="grupo_id" name="grupo_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-xs">
            <option value="">Seleccione un Grupo</option>
            @foreach($grupos as $grupo)
                <option value="{{ $grupo->id }}" {{ old('grupo_id', $institucion->grupo_id) == $grupo->id ? 'selected' : '' }}>
                    {{ $grupo->nombre }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('grupo_id')" />
    </div>
    
    <div class="col-span-1">
        <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
        <x-text-input id="fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full" :value="old('fecha_inicio', $institucion->fecha_inicio)" />
        <x-input-error class="mt-2" :messages="$errors->get('fecha_inicio')" />
    </div>

    <div class="col-span-1">
        <x-input-label for="fecha_cierre" :value="__('Fecha Cierre')" />
        <x-text-input id="fecha_cierre" name="fecha_cierre" type="date" class="mt-1 block w-full" :value="old('fecha_cierre', $institucion->fecha_cierre)" />
        <x-input-error class="mt-2" :messages="$errors->get('fecha_cierre')" />
    </div>

</div>
@endsection