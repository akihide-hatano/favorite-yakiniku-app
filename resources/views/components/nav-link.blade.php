@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-orange-500 text-sm font-medium leading-5 text-gray-900 bg-orange-50 focus:outline-none focus:border-orange-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:border-gray-300 focus:outline-none focus:text-gray-900 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>