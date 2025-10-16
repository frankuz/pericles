<x-guest-layout>
    <div>
        <div class="text-xl text-center font-bold text-on-surface-strong dark:text-on-surface-dark-strong">
            ENCUESTA DE CLIMA ESCOLAR 
        </div>
        <div class="text-lg font-semibold text-center">
            {{session('clima.institucion.nombre')}} 
        </div>
    </div>
    <div class="border border-primary w-full sm:w-xl p-3 sm:p-5 flex flex-col items-stretch gap-5">
        <div class="text-lg text-primary font-bold">DATOS GENERALES</div>
        <form class="flex flex-wrap gap-y-5" method="POST" action="{{ route('clima-participantes.store') }}">
            @csrf

            <div class="w-full sm:w-1/3 sm:pr-6">
                <x-input-label for="clave">Clave</x-input-label>
                <x-text-input 
                    id="clave" 
                    type="text" 
                    name="clave" 
                    value="{{ old('clave') }}" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('clave')" class="mt-1" />
            </div>

            @php
                $estamentos = [
                    'Familias' => 'Padre / Madre / Acudiente',
                    'Estudiantes' => 'Estudiante',
                    'Docentes' => 'Docente',
                    'Directivos' => 'Directivo',
                    'Administrativos' => 'Personal administrativo',
                ];
            @endphp

            <div class="w-full sm:w-2/3">
                <x-input-label for="estamento" value="Rol en la institución" />
                <x-select
                    name="estamento" 
                    :options="$estamentos" 
                    required
                />
                <x-input-error :messages="$errors->get('estamento')" class="mt-1" />
            </div>

            @php
                $sedesParaSelect = $sedes->pluck('nombre', 'id')->map(function ($nombre, $id) use ($sedes) {
                    $sede = $sedes->firstWhere('id', $id);
                    if ($sede && $sede->es_principal) {
                        return $nombre . ' (Principal)';
                    }
                    return $nombre;
                })->toArray();
            @endphp

            <div class="w-full">
                <x-input-label for="sede_id" value="Sede" />
                <x-select
                    name="sede_id" 
                    :options="$sedesParaSelect" 
                    placeholder="Selecciona la sede a la que perteneces"
                    required
                />
                <x-input-error :messages="$errors->get('sede_id')" class="mt-1" />
            </div>

            <div class="w-full flex items-center justify-end">
                <x-primary-button class="ms-3">
                    Continuar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>