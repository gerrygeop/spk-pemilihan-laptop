<x-app-layout>
    <x-slot name="header">
        Rekomendasi
    </x-slot>

    <x-container>
        <div class="flex items-center mb-5">
            <a href="{{ route('rekomendasi.index') }}" class="btn-secondary">
                <i class='bx bx-arrow-back bx-xs mr-1'></i>
                <span>Kembali</span>
            </a>
        </div>

        <x-table>
            <thead class="bg-slate-50">
                <tr>
                    <x-th>#</x-th>
                    <x-th>Laptop</x-th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($rekomendasi->sortByDesc('bobot') as $item)
                    <tr>
                        <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                            {{ $loop->iteration }}
                        </x-td>
                        <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                            {{ $item->alternatif->nama }}
                        </x-td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('laptop.show', [$item->alternatif, $item->slug]) }}" class="btn-hover-primary">Detail</a>
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
    </x-container>

</x-app-layout>
