<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-500 leading-tight">
            Editar Departamento: {{ $departamento->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('departamentos.update', $departamento) }}">
                        @method('PUT')
                        @include('departamentos.form', ['buttonText' => 'Actualizar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>