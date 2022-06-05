<x-app-layout>
    
    <x-slot name="header">
        Tambah Kriteria
    </x-slot>

    <x-container>
        <x-box>
            <form action="{{ route('d.kriteria.store') }}" method="POST">
                @csrf
                @include('dapur.kriteria.form')
            </form>
        </x-box>
    </x-container>

</x-app-layout>
