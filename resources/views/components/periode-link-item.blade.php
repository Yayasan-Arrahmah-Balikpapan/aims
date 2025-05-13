@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            // ? 'inline-flex items-center justify-between px-4 py-3 text-primary-600 bg-white border border-primary-600 rounded-lg active w-full'
            // : 'inline-flex items-center justify-between px-4 py-3 text-gray-900 bg-white border border-gray-200 rounded-lg active w-full';
            ? 'inline-block flex items-center justify-between p-2 px-4 px-4 py-2 text-white bg-primary-600 rounded-md active'
            : 'inline-block flex items-center justify-between p-2 px-4 hover:rounded-md hover:text-gray-800 hover:bg-gray-200';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
