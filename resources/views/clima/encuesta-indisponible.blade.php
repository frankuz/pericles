<x-guest-layout>
    @if ($error ?? false)
    <div class="bg-danger/15 border border-danger text-danger px-5 py-3 relative mb-4" role="alert">
        <span class="block sm:inline">{{ $error }}</span>
    </div>
    @endif
    @if ($error ?? false)
    <div class="bg-danger/15 border border-danger text-danger px-5 py-3 relative mb-4" role="alert">
        <span class="block sm:inline">{{ $error }}</span>
    </div>
    @endif
    @if ($success ?? false)
        <div class="bg-success/15 border border-success text-success px-5 py-3 relative mb-4" role="alert">
            <span class="block sm:inline">{{ $success }}</span>
        </div>
    @endif
    @if ($success ?? false)
        <x-primary-button-link class="ms-3" :href="route('clima_participante.handle', ['encuesta_id' => $encuesta_id])">
            Finalizar
        </x-primary-button-link>
    @endif
</x-guest-layout>