@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center rounded-radius gap-2 bg-primary/10 px-2 py-1.5 text-sm font-medium text-on-surface-strong underline-offset-2 focus-visible:underline focus:outline-hidden dark:bg-primary-dark/10 dark:text-on-surface-dark-strong'
    : 'flex items-center rounded-radius gap-2 px-2 py-1.5 text-sm font-medium text-on-surface underline-offset-2 hover:bg-primary/5 hover:text-on-surface-strong focus-visible:underline focus:outline-hidden dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
