<x-app-layout>
    
    <x-slot name="header">
        Edit Representasi {{ $kriteria->nama }}
    </x-slot>

    <x-box>
        <form action="{{ route('d.representasi.update', $representasi) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dapur.representasi.form')
        </form>
    </x-box>

</x-app-layout>
