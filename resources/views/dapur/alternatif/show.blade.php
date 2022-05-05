<x-app-layout>
    <x-slot name="header">
        Detail Alternatif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center mb-5">
                <a href="{{ route('d.alternatif.index') }}" class="btn-secondary">
                    <i class='bx bxs-arrow-back bx-xs mr-1'></i>
                    <span>Kembali</span>
                </a>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="flex items-center px-4 py-5 sm:px-6">
                    <span class="bg-gray-700 text-gray-50 px-2 py-0.5 rounded mr-2">{{ $alternatif->kode }}</span>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $alternatif->nama }}</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        @foreach ($alternatifColumn as $key => $column)
                            <div class="bg-white border-b px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-600 uppercase">{{ $alternatif->removeSlug($column) }}</dt>
                                <dd class="mt-1 text-base font-medium text-gray-900 sm:mt-0 sm:col-span-2">{{ $alternatif[$column] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
                    
        </div>
    </div>
</x-app-layout>
