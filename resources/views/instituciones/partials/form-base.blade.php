@props(['institucion', 'sectionName', 'route'])

<form method="POST" action="{{ $route }}" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="p-6 bg-white shadow-sm sm:rounded-lg">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Editar Sección: ') . $sectionName }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Actualiza los campos de la institución.') }}
            </p>
        </header>

        <div class="mt-6 space-y-6">
            @yield('fields')
        </div>
        
        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>
        </div>
    </div>
</form>