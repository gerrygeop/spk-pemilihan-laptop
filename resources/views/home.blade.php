<x-app-layout>
    @if (session('not_found'))
        <x-banner :message="session('not_found')" type="fail" />
    @endif

    <x-container>
        <div x-data="{ openForm: false }">
            <div class="overflow-hidden shadow-sm sm:rounded-lg md:mt-4" x-cloak x-show="openForm === false">
                <div class="p-6 bg-gradient-to-r from-indigo-600 to-violet-400 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <h2 class="text-white text-xl sm:text-lg lg:text-2xl font-semibold capitalize">Sistem Pendukung Keputusan Pemilihan Laptop</h2>
        
                        <button type="button" class="btn-secondary whitespace-nowrap mt-2 md:mt-0" x-on:click="openForm = true">
                            <i class='bx bx-search bx-xs mr-1'></i>
                            Cari Kriteria Rekomendasi
                        </button>
                    </div>
                </div>
            </div>

            <div x-cloak x-show.transition.delay="openForm">
                <x-box>
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-xl text-gray-700 font-medium">Pilih Kriteria</h3>
                        <button type="button" x-on:click="openForm = false" class="btn-secondary p-0">
                            <i class='bx bx-x bx-sm'></i>
                        </button>
                    </div>

                    @livewire('form-rekomendasi')
                </x-box>
            </div>

        </div>

        <div class="mb-4 mt-6 border-b border-gray-300"></div>

        <div class="flex items-center">
            <a href="{{ route('calculation') }}" class="btn-secondary inline">Hitung semua laptop</a>
        </div>

        <x-table>
            <thead class="bg-slate-50">
                <tr>
                    <x-th>Merek Laptop</x-th>

                    @foreach ($alternatifColumn as $column)
                        <x-th>
                            <div class="text-center">{{ Str::of($column)->replace('_', ' ')->title() }}</div>
                        </x-th>
                    @endforeach

                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($all_alternatif as $alternatif)
                    <tr>
                        <x-td>{{ $alternatif->nama }}</x-td>

                        @foreach ($alternatifColumn as $column)
                            <x-td>
                                <div class="text-center">{{ $alternatif->getCurrencyIfCurrency($column) }}</div>
                            </x-td>
                        @endforeach

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('laptop.show', $alternatif) }}" class="btn-hover-primary">Detail</a>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                            <p class="text-sm text-center text-slate-500 italic">Belum ada data</p>
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </x-table>

        <div class="my-6 mb-10 w-full">
            {{ $all_alternatif->links() }}
        </div>

    </x-container>
</x-app-layout>
