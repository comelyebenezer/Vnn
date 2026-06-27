@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-vnn-red text-start text-base font-medium text-white bg-vnn-blue focus:outline-none focus:text-white focus:bg-vnn-blue-dark focus:border-vnn-red transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-300 hover:text-white hover:bg-vnn-blue hover:border-vnn-red/50 focus:outline-none focus:text-white focus:bg-vnn-blue-dark focus:border-vnn-red/50 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
