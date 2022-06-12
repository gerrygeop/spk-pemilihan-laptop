<x-app-layout>

    <x-container>
        <div class="flex items-center mb-5">
            <a href="{{ $slug ? route('rekomendasi.result', $slug) : route('home') }}" class="btn-secondary">
                <i class='bx bx-arrow-back bx-xs mr-1'></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="flex items-center px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-semibold text-gray-800">{{ $alternatif->nama }}</h3>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    @foreach ($alternatifColumn as $key => $column)
                        <div class="bg-white border-b px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-600 uppercase">
                                {{ $alternatif->removeSlug($column) }}
                            </dt>
                            <dd class="mt-1 text-base font-medium text-gray-800 sm:mt-0 sm:col-span-2">
                                {{ $alternatif[$column] }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
                    
    </x-container>
</x-app-layout>
