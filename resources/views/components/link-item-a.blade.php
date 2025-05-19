@props(['active', 'as' => 'a'])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-base text-gray-900 rounded-lg bg-gray-100 group border border-gray-500 transition duration-150 ease-in-out'
            : 'flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent transition duration-150 ease-in-out';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
