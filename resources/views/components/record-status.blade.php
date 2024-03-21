@props([
    'status' => '',
    'style' => '',
])


@php
    if ($status == 'completed') {
        $style = 'bg-green-100 border-green-200 text-green-800';
    } elseif ($status == 'scheduled') {
        $style = 'bg-yellow-100 border-yellow-200 text-yellow-800';
    } else {
        $style = 'bg-red-100 border-red-200 text-red-800';
    }
@endphp

<div class="{{ $style }} border-2 py-1 px-4 rounded-full w-fit text-sm">
    {{ $status }} 
</div>