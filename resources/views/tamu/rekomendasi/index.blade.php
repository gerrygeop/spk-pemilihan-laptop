<x-app-layout>
    <x-slot name="header">
        Riwayat Pencarian
    </x-slot>

    <x-container>

        <x-table>
            <thead class="bg-slate-50">
                <tr>
                    <x-th>#</x-th>
                    <x-th>Waktu</x-th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($rekomendasi as $key => $item)
                    <tr>
                        <x-td>{{ $loop->iteration }}</x-td>
                        <x-td>{{ $key }}</x-td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('rekomendasi.result', $item->first()->slug) }}" class="btn-hover-primary">
                                    Detail Riwayat
                                </a>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                            <p class="text-sm text-center text-slate-500 italic">Belum ada riwayat</p>
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </x-table>

    </x-container>

</x-app-layout>
