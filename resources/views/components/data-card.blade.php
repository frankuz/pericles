@props(['title'])

<div {{ $attributes->merge(['class' => 'p-6 bg-white border border-gray-200 rounded-lg shadow-md flex flex-col']) }}>
    <h2 class="text-xl font-bold text-red-800 mb-4 border-b pb-2">
        {{ $title }}
    </h2>
    
    <div class="grid grid-cols-1 gap-x-3 grow">
        {{ $slot }}
    </div>
</div>