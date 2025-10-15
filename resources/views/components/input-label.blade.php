@props(['value'])

<label {{ $attributes->merge(['class' => 'block pl-0.5 mb-1 font-bold tracking-widest text-xs text-on-surface/80 dark:text-on-surface-dark uppercase']) }}>
    {{ $value ?? $slot }}
</label>
