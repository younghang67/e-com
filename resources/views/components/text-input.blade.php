@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-black dark:focus:border-black focus:ring-black dark:focus:ring-black rounded-md shadow-sm px-4 py-2 text-base']) }}>
