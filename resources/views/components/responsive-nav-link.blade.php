@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block mx-2 px-3 py-2 rounded-lg bg-primary/5 text-start text-base font-medium focus:outline-none transition duration-150 ease-in-out'
            : 'block mx-2 px-3 py-2 rounded-lg text-start text-base font-medium border border-transparent hover:bg-gray-50 hover:border-gray-200 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
