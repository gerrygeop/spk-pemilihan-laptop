<x-app-layout>
    
    <x-slot name="header">
        Representasi kriteria {{ $kriteria->nama }}
    </x-slot>

    <x-container>
        <x-box>
            <form action="{{ route('d.representasi.store', $kriteria) }}" method="POST">
                @csrf
                @include('dapur.representasi.form')
            </form>
        </x-box>
    </x-container>

</x-app-layout>
