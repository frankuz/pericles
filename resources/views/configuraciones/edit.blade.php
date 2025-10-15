<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Configuración: ') . $configuracion->variable }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('configuraciones.update', $configuracion->variable) }}">
                    @method('PUT')
                    
                    {{-- Incluye el formulario parcial --}}
                    @include('configuraciones.form', ['buttonText' => __('Actualizar Configuración')])
                </form>

            </div>
        </div>
    </div>
</x-app-layout>