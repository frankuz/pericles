@props(['label', 'value'])

<div class="flex flex-col pt-2">
    <p class="text-xs font-semibold uppercase text-gray-500">{{ $label }}</p>
    
    <p class="text-sm font-medium text-gray-800 break-words">{{ $value }}</p>
</div>