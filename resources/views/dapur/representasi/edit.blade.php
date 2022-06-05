<x-app-layout>
    
    <x-slot name="header">
        Edit Representasi {{ $kriteria->nama }}
    </x-slot>

    <x-container>
        <x-box>
            <form action="{{ route('d.representasi.update', $representasi) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dapur.representasi.form')
            </form>
        </x-box>
    </x-container>

</x-app-layout>
