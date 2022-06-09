@props(['message' => ''])

<div class="fixed top-0 z-50 w-full text-white bg-gradient-to-r from-blue-600 to-indigo-600 shadow-md" x-data="{ show: true }" x-show="show" @click.away="show = false">
    <div class="container flex items-center justify-between px-12 py-4 mx-auto">
        <div class="flex items-center">
            <i class='bx bx-badge-check bx-sm'></i>
            <p class="mx-3">{{ $message }}</p>
        </div>

        <button x-on:click="show = false" class="transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
            <i class='bx bx-x bx-sm'></i>
        </button>
    </div>
</div>