<x-app-layout>
    <x-slot name="header">
        Rekomendasi
    </x-slot>

    <x-container>
        <div class="flex items-center mb-5">
            <a href="{{ route('rekomendasi.result', $slug) }}" class="btn-secondary">
                <i class='bx bx-arrow-back bx-xs mr-1'></i>
                <span>Kembali</span>
            </a>
        </div>

        @include('tamu.partials._kriteria-bobot')
        @include('tamu.partials._alt-values')
        @include('tamu.partials._bobot-alt')
        @include('tamu.partials._min-max-bobot')
        @include('tamu.partials._bagi-minmax-alt')
        @include('tamu.partials._kali-kriteria')
        @include('tamu.partials._sum')
        @include('tamu.partials._ranking')

    </x-container>

    <div class="fixed bottom-1 right-3 lg:bottom-10 lg:right-10">
        <a href="#navigate">
            <i class='bx bxs-up-arrow-circle bx-lg bx-fade-up-hover text-slate-700 bg-white shadow rounded-full'></i>
        </a>
    </div>

</x-app-layout>
