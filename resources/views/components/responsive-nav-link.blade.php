@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-2 uppercase bg-gray-50 text-start text-base font-medium focus:outline-none transition duration-150 ease-in-out'
            : 'block py-2 uppercase opacity-50 text-start text-base font-medium hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
