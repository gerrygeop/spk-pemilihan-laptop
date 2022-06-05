<x-app-layout>
    
    <x-slot name="header">
        Representasi kriteria '<span class="font-bold">{{ $kriteria->nama }}</span>'
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
