<x-guest-layout>
    <div class="w-full sm:w-xl mx-auto px-4 flex flex-col items-stretch">
        <div class="text-xl text-center font-bold text-on-surface-strong dark:text-on-surface-dark-strong">
            ENCUESTA DE CLIMA ESCOLAR 
        </div>
        <div class="text-lg font-semibold mb-8 text-center">
            {{session('clima.institucion.nombre')}}
        </div>

        {{-- Mostrar errores de validación, si existen --}}
        {{-- @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        
        <form class="flex flex-wrap" method="POST" action="{{ route('clima-participantes.store') }}">
            @csrf

            <div class="mt-6 w-full sm:w-1/3 sm:pr-6">
                <x-input-label for="clave">Clave</x-input-label>
                <x-text-input 
                    id="clave" 
                    type="text" 
                    name="clave" 
                    value="{{ old('clave') }}" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('clave')" class="mt-2" />
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

            <div class="mt-6 w-full sm:w-2/3">
                <x-input-label for="estamento" value="Rol en la institución" />
                <x-select
                    name="estamento" 
                    :options="$estamentos" 
                    required
                />
                <x-input-error :messages="$errors->get('estamento')" class="mt-2" />
            </div>
            <!-- <div class="mt-6 w-full sm:w-1/3 sm:pr-6">
                <x-input-label for="clave">Clave</x-input-label>
                <x-text-input 
                    id="clave" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="clave" 
                    value="{{ old('clave') }}" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('clave')" class="mt-2" />
            </div>

            <div class="mt-6 w-full sm:w-2/3">
                <x-input-label for="estamento" value="Estamento al que pertenece" />
                
                <select id="estamento" name="estamento" required 
                        class="w-full p-1 border border-outline dark:border-outline-dark dark:bg-gray-900 dark:text-gray-300 focus:border-outline dark:focus:border-outline-dark focus-visible:outline-primary dark:focus-visible:outline-primary rounded-none">
                    
                    <option value="" disabled selected>Seleccione su estamento</option>
                    <option 
                        value="Familias" 
                        {{ old('estamento') == "Familias" ? 'selected' : '' }}
                    >Familias 
                    </option>
                    <option 
                        value="Estudiantes" 
                        {{ old('estamento') == "Estudiantes" ? 'selected' : '' }}
                    >Estudiantes
                    </option>
                    <option 
                        value="Administrativos" 
                        {{ old('estamento') == "Administrativos" ? 'selected' : '' }}
                    >Administrativos 
                    </option>
                    <option 
                        value="Docentes" 
                        {{ old('estamento') == "Docentes" ? 'selected' : '' }}
                    >Docentes 
                    </option>
                    <option 
                        value="Directivos" 
                        {{ old('estamento') == "Directivos"  ? 'selected' : '' }}
                    >Directivos 
                    </option>
                </select>
                
                <x-input-error :messages="$errors->get('estamento')" class="mt-2" />
            </div> -->
            @php
                $sedesParaSelect = $sedes->pluck('nombre', 'id')->map(function ($nombre, $id) use ($sedes) {
                    $sede = $sedes->firstWhere('id', $id);
                    if ($sede && $sede->es_principal) {
                        return $nombre . ' (Principal)';
                    }
                    return $nombre;
                })->toArray();
            @endphp

            <div class="mt-6 w-full">
                <x-input-label for="sede_id" value="Sede" />
                <x-select
                    name="sede_id" 
                    :options="$sedesParaSelect" 
                    placeholder="Selecciona la sede a la que perteneces"
                    required
                />
                <!-- <select id="sede_id" name="sede_id" required 
                        class="w-full p-1 border border-outline dark:border-outline-dark dark:bg-gray-900 dark:text-gray-300 focus:border-outline dark:focus:border-outline-dark focus-visible:outline-primary dark:focus-visible:outline-primary rounded-none">
                    
                    <option value="" disabled selected>Seleccione su Sede</option>
                    
                    @foreach ($sedes as $sede)
                        <option 
                            value="{{ $sede->id }}" 
                            {{ old('sede_id') == $sede->id ? 'selected' : '' }}
                        >
                            {{ $sede->nombre }} 
                            @if ($sede->es_principal)
                                (Principal)
                            @endif
                        </option>
                    @endforeach
                </select> -->
                <x-input-error :messages="$errors->get('sede_id')" class="mt-2" />
            </div>

            <div class="w-full flex items-center justify-end mt-10">
                <x-primary-button class="ms-3">
                    Continuar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>