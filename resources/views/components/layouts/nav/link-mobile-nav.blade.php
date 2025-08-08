@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'inline-flex flex-col items-center justify-center text-primary-700 transition duration-150 ease-in-out'
            : 'inline-flex flex-col items-center justify-center text-gray-700 transition duration-150 ease-in-out';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
