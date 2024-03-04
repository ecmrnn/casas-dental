@props([
    'disabled' => false,
    'value' => ''
    ])

<input {{ $disabled ? 'disabled' : '' }} value="{{ $value }}" {!! $attributes->merge(['class' => 'border-0 border-b-2 border-transparent p-0']) !!}>
