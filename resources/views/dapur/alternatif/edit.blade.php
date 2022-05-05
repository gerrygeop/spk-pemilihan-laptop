<x-app-layout>
    
    <x-slot name="header">
        Edit Alternatif
    </x-slot>

    <x-box>
        <form action="{{ route('d.alternatif.update', $alternatif) }}" method="POST">
            @csrf
            @method('PUT')
            @include('dapur.alternatif.form')
        </form>
    </x-box>

</x-app-layout>
