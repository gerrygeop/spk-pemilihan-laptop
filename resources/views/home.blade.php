<x-app-layout>
    <x-slot name="header">
        Beranda
    </x-slot>

    <x-container>
        <x-box>
            <div class="flex flex-col items-center">
                <div class="mb-5">
                    <h3 class="text-xl md:text-2xl font-semibold">Sistem Pendukung Keputusan - Rekomendasi Pemilihan Laptop</h3>
                </div>
        
                <div class="flex items-center">
                    <a href="{{ route('rekomendasi.create') }}" class="btn-primary text-sm md:text-lg">
                        <i class='bx bx-search bx-sm mr-1'></i>
                        <span>Cari Laptop</span>
                    </a>
                </div>
            </div>
        </x-box>
    </x-container>
</x-app-layout>
