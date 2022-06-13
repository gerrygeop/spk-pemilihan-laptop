@props(['message' => '', 'type' => 'success'])

@php
    if ( $type == 'success' ) {
        $color = 'from-blue-600 to-indigo-600';
    } else {
        $color = 'from-red-600 to-rose-600';
    }
@endphp

<div class="fixed top-0 z-50 w-full text-white shadow-md bg-gradient-to-r {{ $color }}" x-data="{ show: true }" x-show="show" @click.away="show = false">
    <div class="container flex items-center justify-between px-12 py-4 mx-auto">
        <div class="flex items-center">
            @if ( $type == 'success' )
                <i class='bx bx-badge-check bx-sm'></i>
            @else
                <i class='bx bxs-alarm-exclamation'></i>
            @endif
            <p class="mx-3">{{ $message }}</p>
        </div>

        <button x-on:click="show = false" class="transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
            <i class='bx bx-x bx-sm'></i>
        </button>
    </div>
</div>