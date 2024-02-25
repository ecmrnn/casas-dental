@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0 border-b-[1px] border-transparent bg-transparent p-0']) !!}>
