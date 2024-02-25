@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-5 py-4 block rounded-lg items-center bg-green-50 leading-none focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'px-5 py-4 block rounded-lg items-center leading-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
