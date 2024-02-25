@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-5 py-3 block rounded-lg items-center border border-transparent bg-green-50 leading-none focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'px-5 py-3 block rounded-lg items-center border border-gray-200 leading-none transition duration-150 ease-in-out hover:bg-gray-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
