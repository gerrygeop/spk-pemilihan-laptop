<x-app-layout>
    <x-slot name="header">
        Detail Alternatif
    </x-slot>

    <x-container>
        <div x-data="{ showBobot: false }">

            <div class="flex items-center justify-between mb-5">
                <a href="{{ route('d.alternatif.index') }}" class="btn-secondary">
                    <i class='bx bx-arrow-back bx-xs mr-1'></i>
                    <span>Kembali</span>
                </a>

                <div>
                    @if ( is_null($alternatif->alternatif_max_bobot) )
                        <a href="{{ route('d.alternatif.max-bobot', $alternatif) }}" class="btn-secondary">
                            Hitung Max Bobot
                        </a>
                    @else
                        <a href="{{ route('d.alternatif.max-bobot-update', $alternatif) }}" class="btn-secondary">
                            Update Max Bobot
                        </a>
                    @endif

                    <button class="btn-secondary" x-on:click="showBobot = ! showBobot">Bobot</button>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="flex items-center justify-between px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-semibold text-gray-700 tracking-wider">{{ $alternatif->nama }}</h3>

                    <div class="flex items-center">
                        <a href="{{ route('d.alternatif.edit', $alternatif) }}" class="btn-hover-primary text-sm tracking-wider">Edit</a>

                        <form action="{{ route('d.alternatif.destroy', $alternatif) }}" method="POST" onsubmit="return confirm('Yakin untuk menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-hover-danger text-sm tracking-wider">Hapus</button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        @foreach ($alternatifColumn as $key => $column)
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 items-center bg-white border-b px-4 py-5 sm:px-6">
                                <dt class="text-xs font-medium text-gray-500 uppercase sm:col-span-1">{{ $alternatif->removeSlug($column) }}</dt>
                                <dd
                                    x-cloak 
                                    x-show="showBobot == false" 
                                    class="mt-1 text-base font-medium text-gray-700 tracking-wider sm:mt-0 sm:col-span-2"
                                >
                                    {{ $alternatif[$column] }}
                                </dd>
                                <dd 
                                    x-cloak 
                                    x-show="showBobot == true" 
                                    class="mt-1 text-base font-medium text-gray-700 tracking-wider sm:mt-0 sm:col-span-2"
                                >
                                    {{ $alternatif->alternatif_max_bobot ? $alternatif->alternatif_max_bobot[$column] : '-' }}
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>

        </div>
    </x-container>
</x-app-layout>
