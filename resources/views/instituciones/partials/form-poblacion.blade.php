    <div class="mt-4">
        <x-input-label for="estudiantes" value="# de Estudiantes" />
        <x-text-input id="estudiantes" class="block mt-1 w-full" type="text" name="estudiantes" :value="old('estudiantes', $institucion->estudiantes ?? '')" autofocus autocomplete="estudiantes" />
        <x-input-error :messages="$errors->get('estudiantes')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="familias" value="# de Familias" />
        <x-text-input id="familias" class="block mt-1 w-full" type="text" name="familias" :value="old('familias', $institucion->familias ?? '')" autofocus autocomplete="familias" />
        <x-input-error :messages="$errors->get('familias')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="docentes" value="# de Docentes" />
        <x-text-input id="docentes" class="block mt-1 w-full" type="text" name="docentes" :value="old('docentes', $institucion->docentes ?? '')" autofocus autocomplete="docentes" />
        <x-input-error :messages="$errors->get('docentes')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="directivos" value="# de Directivos" />
        <x-text-input id="directivos" class="block mt-1 w-full" type="text" name="directivos" :value="old('directivos', $institucion->directivos ?? '')" autofocus autocomplete="directivos" />
        <x-input-error :messages="$errors->get('directivos')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="orientadores" value="# de Orientadores" />
        <x-text-input id="orientadores" class="block mt-1 w-full" type="text" name="orientadores" :value="old('orientadores', $institucion->orientadores ?? '')" autofocus autocomplete="orientadores" />
        <x-input-error :messages="$errors->get('orientadores')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="administrativos" value="# de Personal administrativo" />
        <x-text-input id="administrativos" class="block mt-1 w-full" type="text" name="administrativos" :value="old('administrativos', $institucion->administrativos ?? '')" autofocus autocomplete="administrativos" />
        <x-input-error :messages="$errors->get('administrativos')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="servicios" value="# de Personal de servicio" />
        <x-text-input id="servicios" class="block mt-1 w-full" type="text" name="servicios" :value="old('servicios', $institucion->servicios ?? '')" autofocus autocomplete="servicios" />
        <x-input-error :messages="$errors->get('servicios')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    {{-- <div class="block mt-4">
        <label for="docentes" class="inline-flex items-center">
            <input id="docentes" type="checkbox" class="rounded-sm dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-xs focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
        </label>
    </div> --}}

