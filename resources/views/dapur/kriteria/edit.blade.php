<x-app-layout>
    
    <x-slot name="header">
        Edit Kriteria
    </x-slot>

    <x-container>
        <x-box>
            <form action="{{ route('d.kriteria.update', $kriteria) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dapur.kriteria.form')
            </form>
        </x-box>
    </x-container>

</x-app-layout>
