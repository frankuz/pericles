<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 leading-tight">
            {{ __('Gestión de Instituciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-6">

                <div class="flex justify-end mb-4">
                    <a href="{{ route('instituciones.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Crear Nueva Institución') }}
                    </a>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    DANE
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Departamento
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Municipio
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Estado
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instituciones as $institucion)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $institucion->nombre }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $institucion->dane ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $institucion->departamento->nombre ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $institucion->municipio->nombre ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($institucion->estado == 'Activo') bg-green-100 text-green-800 
                                            @else bg-red-100 text-red-800 
                                            @endif">
                                            {{ $institucion->estado ?? 'Pendiente' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 flex space-x-2">
                                        <a href="{{ route('instituciones.show', $institucion) }}" class="font-medium text-blue-600 hover:underline">Ver</a>
                                        <a href="{{ route('instituciones.edit', $institucion) }}" class="font-medium text-yellow-600 hover:underline">Editar</a>
                                        
                                        <form method="POST" action="{{ route('instituciones.destroy', $institucion) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta institución?')" class="font-medium text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $instituciones->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>