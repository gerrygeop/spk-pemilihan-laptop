<x-app-layout>
    
    <x-slot name="header">
        Tambah Alternatif
    </x-slot>

    <x-container>
        <x-box>
            <form action="{{ route('d.alternatif.store') }}" method="POST">
                @csrf
                @include('dapur.alternatif.form')
            </form>
        </x-box>
    </x-container>

</x-app-layout>
