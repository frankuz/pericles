@props([
    'name', 
    'options', 
    'placeholder' => 'Selecciona una opción',
    'selected' => old($name),
])

<div class="relative" {{ $attributes->except('class') }}>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute pointer-events-none right-4 top-3 size-5 text-gray-500 dark:text-gray-400">
        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
    </svg>
    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full appearance-none rounded-radius p-2 border border-gray-300 dark:border-outline-dark  focus:outline-gray-400 dark:focus:outline-grey-200 dark:bg-surface-dark-alt/50 dark:text-gray-300 disabled:cursor-not-allowed disabled:opacity-75']) }}
    >
        <option value="" disabled selected>{{ $placeholder }}</option>
        
        @foreach ($options as $value => $label)
            <option 
                value="{{ $value }}" 
                {{ $value == $selected ? 'selected' : '' }}
            >
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>