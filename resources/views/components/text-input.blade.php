@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full appearance-none rounded-radius p-2 border border-gray-300 dark:border-outline-dark  focus:outline-gray-400 dark:focus:outline-grey-200 dark:bg-surface-dark-alt/50 dark:text-gray-300 disabled:cursor-not-allowed disabled:opacity-75']) }}>