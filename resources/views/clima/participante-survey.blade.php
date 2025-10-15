<x-guest-layout>
    <div class="w-full sm:w-xl mx-auto px-4 flex flex-col items-stretch"
    x-data="{ 
            itemsPorDimension: {{ json_encode($items_por_dimension) }},
            estadoDimensiones: {{ json_encode(session('clima.dimensiones')) }},
            estamento: '{{ session('clima.participante.estamento') }}',
            respuestas: {}, 
            dimensionActual: null,
            get itemsFiltrados() { 
                if (!this.dimensionActual) return []
                return this.itemsPorDimension[this.dimensionActual] 
            },
    }">
        <div class="text-xl text-center font-bold text-on-surface-strong dark:text-on-surface-dark-strong">
            ENCUESTA DE CLIMA ESCOLAR 
        </div>
        <div class="text-lg pb-5 text-center text-on-surface dark:text-on-surface-dark">
            {{session('clima.institucion.nombre')}}
        </div>
        <div x-show="!dimensionActual" class="pb-8 whitespace-pre-line text-on-surface dark:text-on-surface-dark">
            {{ $textoIntroduccionEncuesta }}
        </div>
        <div x-show="!dimensionActual" class="mx-auto grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 gap-2 xs:gap-3 sm:gap-4">
            <template x-for="(items, dimKey) in itemsPorDimension" :key="dimKey">
                <article x-data="{completo:estadoDimensiones[dimKey]}" @click="dimensionActual = completo ? '' : dimKey"  class="h-full flex-wrap group flex rounded-radius flex-col overflow-hidden border border-gray-400 hover:border-outline  bg-surface text-on-surface  dark:bg-surface-dark dark:text-on-surface-dark" x-bind:class="{'border-outline' : completo, 'cursor-pointer hover:border-2': !completo}">
                    <div class="h-full flex flex-col justify-between items-center gap-2 p-4 text-center">
                        <div>
                            <span class="text-xs font-medium" x-bind:class="{'text-slate-400' : !completo}">DIMENSIÓN</span>
                            <h4 class="text-md font-bold text-gray-500 dark:text-on-surface-dark-strong" x-bind:class="{'text-on-surface-strong' : completo}"
                            x-text="items[0].dimension"></h4>
                        </div>
                        <svg x-show="completo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"  class="size-8 text-primary">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                        </svg>
                        <div x-show="0">
                            <span class="w-fit inline-flex overflow-hidden rounded-radius border border-success bg-success text-xs font-medium text-on-success dark:border-success dark:bg-success dark:text-on-success">
                            <span class="flex items-center gap-1 bg-success/10 px-2 py-1 dark:bg-success/10">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor"  class="size-4">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/>
                                </svg>
                                RESPONDIDA
                            </span>
                            </span>
                        </div>
                    </div>
                </article>
            </template>
        </div>

        <div x-show="dimensionActual" class=" text-on-surface dark:text-on-surface-dark mb-10">
            <div class="text-center">
                <span class="font-medium">DIMENSIÓN: </span>
                <span x-text="itemsFiltrados[0]?.dimension" class="text-base font-bold text-on-surface-strong dark:text-on-surface-dark-strong"></span>
            </div>
            <form method="POST" action="{{ route('clima-participantes.save_dim') }}" x-cloak>
            @csrf
            <template x-for="item in itemsFiltrados">
                <div class="p-3 my-5 rounded-md bg-surface-alt dark:bg-surface-dark-alt">
                    <div x-text="item.item" class="text-sm text-slate-800 font-semibold mt-3 mb-5"></div>
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-2 sm:gap-1"
                    x-data="{
                        escalas: {
                            asc: {
                                Acuerdo: { 'Muy en desacuerdo' : 1, 'En desacuerdo' : 2, 'De acuerdo' : 3, 'Muy de acuerdo' : 4, 'No sé' : 0},
                                Frecuencia: { 'Nunca' : 1, 'A veces' : 2, 'Casi siempre' : 3, 'Siempre' : 4, 'No sé' : 0},
                                Influencia: { 'Ninguna influencia' : 1, 'Poca influencia' : 2, 'Mediana influencia' : 3, 'Mucha influencia' : 4, 'No sé' : 0},
                                Valor: { 'Malo' : 1, 'Regular' : 2, 'Bueno' : 3, 'Excelente' : 4, 'No sé' : 0}
                            },
                            des: {
                                Acuerdo: { 'Muy en desacuerdo' : 4, 'En desacuerdo' : 3, 'De acuerdo' : 2, 'Muy de acuerdo' : 1, 'No sé' : 0},
                                Frecuencia: { 'Nunca' : 4, 'A veces' : 3, 'Casi siempre' : 2, 'Siempre' : 1, 'No sé' : 0},
                                Influencia: { 'Ninguna influencia' : 4, 'Poca influencia' : 3, 'Mediana influencia' : 2, 'Mucha influencia' : 1, 'No sé' : 0},
                                Valor: { 'Malo' : 4, 'Regular' : 3, 'Bueno' : 2, 'Excelente' : 1, 'No sé' : 0}
                            }
                        },
                    }"
                    >
                        <template x-for="(valor, respuesta in escalas[item.tendencia][item.escala]">
                            <label class="relative flex items-center gap-1 h-10 rounded-radius p-1 text-on-surface dark:text-on-surface-dark cursor-pointer hover:bg-primary/40 hover:text-on-primary has-checked:border-primary has-checked:bg-primary has-checked:text-on-primary has-checked:border has-focus:outline-primary dark:has-checked:border-primary-dark dark:has-checked:text-on-surface-dark-strong dark:has-checked:bg-primary-dark/5 dark:has-focus:outline-primary-dark border border-outline dark:border-outline-dark">
                                <input type="radio" :id="'respuestas[' + item.id + ']'" class="sr-only peer" :name="'respuestas[' + item.id + ']'" :value="valor" required>
                                <div class="flex flex-col w-100">
                                    <div class="text-xs text-center font-medium uppercase" aria-hidden="true" x-text="respuesta"></div>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
            </template>
            <input type="hidden" name="dimension" :value="dimensionActual" />
            <div class="w-full flex items-center justify-end mt-10">
                <x-primary-button class="ms-3">
                    Continuar
                </x-primary-button>
            </div>
            </form>
        </div>
    </div>
</x-guest-layout>