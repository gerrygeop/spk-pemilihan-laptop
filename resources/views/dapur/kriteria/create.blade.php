<x-app-layout>
    
    <x-slot name="header">
        Tambah Kriteria
    </x-slot>

    <x-box>
        <form action="{{ route('d.kriteria.store') }}" method="POST">
            @csrf
            @include('dapur.kriteria.form')
        </form>
    </x-box>

</x-app-layout>
