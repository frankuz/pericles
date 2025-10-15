<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Institución: ') . $institucion->nombre }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-end space-x-4">
                {{-- <a href="{{ route('instituciones.edit', $institucion) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Editar Institución') }}
                </a> --}}
                {{-- <a href="{{ route('instituciones.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-xs hover:bg-gray-50 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Volver al Listado') }}
                </a> --}}
            </div>

            <div class="space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                    
                    <x-data-card title="{{ __('Institución') }}">
                        <x-data-item label="{{ __('Nombre') }}" value="{{ $institucion->nombre }}" />
                        <x-data-item label="{{ __('DANE') }}" value="{{ $institucion->dane }}" />
                        <x-data-item label="{{ __('Estado') }}" value="{{ $institucion->estado }}" />
                        <x-data-item label="{{ __('Fecha Inicio') }}" value="{{ $institucion->fecha_inicio }}" />
                        <x-data-item label="{{ __('Fecha Cierre') }}" value="{{ $institucion->fecha_cierre ?? '—' }}" />
                        <x-data-item label="{{ __('Grupo') }}" value="{{ $institucion->grupo->nombre ?? '—' }}" />
                    </x-data-card>

                    <x-data-card title="{{ __('Localización') }}">
                        <x-data-item label="{{ __('Departamento') }}" value="{{ $institucion->departamento->nombre }}" />
                        <x-data-item label="{{ __('Municipio') }}" value="{{ $institucion->municipio->nombre }}" />
                        <x-data-item label="{{ __('Corregimiento') }}" value="{{ $institucion->corregimiento ?? '—' }}" />
                        <x-data-item label="{{ __('Vereda') }}" value="{{ $institucion->vereda ?? '—' }}" />
                        <x-data-item label="{{ __('Barrio') }}" value="{{ $institucion->barrio ?? '—' }}" />
                        <x-data-item label="{{ __('Dirección') }}" value="{{ $institucion->direccion ?? '—' }}" />
                        <x-data-item label="{{ __('Geolocalización') }}" value="{{ $institucion->geolocalizacion ?? '—' }}" />
                        <x-data-item label="{{ __('Tipo de Zona') }}" value="{{ $institucion->es_urbana ? 'Urbana' : ($institucion->es_rural ? 'Rural' : 'No definido') }}" />
                    </x-data-card>
                    
                    <x-data-card title="{{ __('Contactos') }}">
                        <x-data-item label="{{ __('Teléfono') }}" value="{{ $institucion->telefono ?? '—' }}" />
                        <x-data-item label="{{ __('Celular') }}" value="{{ $institucion->celular ?? '—' }}" />
                        <x-data-item label="{{ __('Email') }}" value="{{ $institucion->email ?? '—' }}" />
                        <x-data-item label="{{ __('Web') }}" value="{{ $institucion->web ?? '—' }}" />
                        <x-data-item label="{{ __('Redes Sociales') }}" value="{{ ($institucion->facebook || $institucion->instagram) ? 'Sí' : '—' }}" />
                        
                        <x-data-item label="{{ __('Rector') }}" value="{{ $institucion->rector ?? '—' }}" />
                        <x-data-item label="{{ __('Celular Rector') }}" value="{{ $institucion->rector_celular ?? '—' }}" />
                        <x-data-item label="{{ __('Email Rector') }}" value="{{ $institucion->rector_email ?? '—' }}" />

                        <x-data-item label="{{ __('Coordinador') }}" value="{{ $institucion->coordinador ?? '—' }}" />
                        <x-data-item label="{{ __('Celular Coord.') }}" value="{{ $institucion->coordinador_celular ?? '—' }}" />
                        <x-data-item label="{{ __('Email Coord.') }}" value="{{ $institucion->coordinador_email ?? '—' }}" />
                    </x-data-card>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-stretch">
                    
                    <div></div> 

                    <x-data-card title="{{ __('Población') }}">
                        <x-data-item label="{{ __('Estudiantes') }}" value="{{ number_format($institucion->estudiantes, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Familias') }}" value="{{ number_format($institucion->familias, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Docentes') }}" value="{{ number_format($institucion->docentes, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Directivos') }}" value="{{ number_format($institucion->directivos, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Orientadores') }}" value="{{ number_format($institucion->orientadores, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Administrativos') }}" value="{{ number_format($institucion->administrativos, 0, ',', '.') }}" />
                        <x-data-item label="{{ __('Servicios') }}" value="{{ number_format($institucion->servicios, 0, ',', '.') }}" />
                    </x-data-card>
                    
                    <x-data-card title="{{ __('Académico') }}">
                        <x-data-item label="{{ __('Sedes') }}" value="{{ $institucion->sedes }}" />
                        
                        <div class="col-span-full border-b mt-2 mb-2">
                            <p class="font-semibold text-sm text-gray-500">Jornadas</p>
                        </div>
                        <x-data-item label="{{ __('Mañana') }}" value="{{ $institucion->jornada_manana ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Tarde') }}" value="{{ $institucion->jornada_tarde ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Noche') }}" value="{{ $institucion->jornada_noche ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Única') }}" value="{{ $institucion->jornada_unica ? 'Sí' : 'No' }}" />
                        
                        <div class="col-span-full border-b mt-2 mb-2">
                            <p class="font-semibold text-sm text-gray-500">Niveles Educativos</p>
                        </div>
                        <x-data-item label="{{ __('Preescolar') }}" value="{{ $institucion->nivel_preescolar ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Primaria') }}" value="{{ $institucion->nivel_primaria ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Secundaria') }}" value="{{ $institucion->nivel_secundaria ? 'Sí' : 'No' }}" />
                        <x-data-item label="{{ __('Media') }}" value="{{ $institucion->nivel_media ? 'Sí' : 'No' }}" />

                        <div class="col-span-full mt-2 mb-2">
                            <p class="font-semibold text-sm text-gray-500">Modalidades</p>
                            <p class="text-sm text-gray-600 italic mt-1">{{ $institucion->modalidades ?? 'No especificado' }}</p>
                        </div>
                    </x-data-card>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>