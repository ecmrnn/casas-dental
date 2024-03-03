@props([
    'disabled' => false,
    'value' => ''
    ])

<input {{ $disabled ? 'disabled' : '' }} value="{{ $value }}" {!! $attributes->merge(['class' => 'border-0 border-b-[1px] border-transparent bg-transparent p-0']) !!}>
