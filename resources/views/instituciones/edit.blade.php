{{-- @props(['institucion', 'sectionName', 'route']) --}}

@php
    $currentSectionKey = request()->get('section', 'institucion');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Institución: ') . $institucion->nombre }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-sm relative" role="alert">
                    <strong class="font-bold">¡Revisa los Errores!</strong>
                    <span class="block sm:inline"> No se pudo guardar la sección debido a los siguientes problemas:</span>
                    <ul class="mt-3 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            </div>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('instituciones.update', $institucion) }}">
                @csrf
                @method('PUT')
                @include('instituciones.partials.form-poblacion')
                <input type="hidden" name="section" value="{{ $currentSectionKey }}">
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    

    {{-- <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                // Determina la sección actual, por defecto 'basicos'
                $section = request()->get('section', 'basicos');

                // Define las rutas y nombres de las secciones
                $sections = [
                    'basicos'       => ['title' => 'Institución', 'file' => 'datos-institucion-form'],
                    'localizacion'  => ['title' => 'Localización', 'file' => 'localizacion-form'],
                    'contactos'     => ['title' => 'Contactos', 'file' => 'contactos-form'],
                    'poblacion'     => ['title' => 'Población', 'file' => 'poblacion-form'],
                    'academico'     => ['title' => 'Académico', 'file' => 'academico-form'],
                ];

                $currentSection = $sections[$section] ?? $sections['basicos'];

                // Define la ruta de acción (asumiendo que tienes rutas separadas para cada sección en el controlador)
                // O si usas una única ruta, solo apunta a update:
                $updateRoute = route('instituciones.update', $institucion);
            @endphp
            
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach ($sections as $key => $data)
                    <a href="{{ route('instituciones.edit', ['institucion' => $institucion, 'section' => $key]) }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg transition duration-150 ease-in-out 
                              {{ $section == $key ? 'bg-indigo-600 text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100 border' }}">
                        {{ $data['title'] }}
                    </a>
                @endforeach
            </div>

            @include('instituciones.partials.form-base', [
                'institucion' => $institucion,
                'sectionName' => $currentSection['title'],
                'route'       => $updateRoute
            ])
                @include('instituciones.partials.' . $currentSection['file'], [
                    'institucion' => $institucion,
                    // Pasa otras variables que la vista necesite, ej:
                    'grupos' => $grupos ?? []
                ])
            @endinclude
            @extends('instituciones.partials.form-base', [
                'institucion' => $institucion,
                'sectionName' => $currentSection['title'],
                'route' => $updateRoute
            ])

            @include('instituciones.partials.' . $currentSection['file'], [
                'institucion' => $institucion,
                'grupos' => $grupos ?? []
            ])

            
        </div>
    </div> --}}
</x-app-layout>