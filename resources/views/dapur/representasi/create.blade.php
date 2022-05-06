<x-app-layout>
    
    <x-slot name="header">
        Representasi kriteria '<span class="font-bold">{{ $kriteria->nama }}</span>'
    </x-slot>

    <x-box>
        <form action="{{ route('d.representasi.store', $kriteria) }}" method="POST">
            @csrf
            @include('dapur.representasi.form')
        </form>
    </x-box>

</x-app-layout>
