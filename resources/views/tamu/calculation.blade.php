<x-app-layout>
    <x-slot name="header">
        Hasil Perhitungan
    </x-slot>

    <x-container>
        <div class="flex items-center justify-between mb-5">
            <a href="{{ route('home') }}" class="btn-secondary">
                <i class='bx bx-arrow-back bx-xs mr-1'></i>
                <span>Kembali</span>
            </a>
            {{-- <a href="#" class="btn-primary">
                <span>Perhitungan</span>
            </a> --}}
        </div>

        <x-table>
            <thead class="bg-slate-50">
                <tr>
                    <x-th>#</x-th>
                    <x-th>Laptop</x-th>
                    <x-th>Total Nilai</x-th>
                    {{-- <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th> --}}
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($calculations as $key => $item)
                    <tr>
                        <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                            {{ $loop->iteration }}
                        </x-td>
                        <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                            {{ $key }}
                        </x-td>
                        <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                            {{ number_format($item, 2); }}
                        </x-td>

                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('laptop.show', [$item->alternatif, $item->slug]) }}" class="btn-hover-primary">Detail</a>
                            </div>
                        </td> --}}
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
    </x-container>

</x-app-layout>
