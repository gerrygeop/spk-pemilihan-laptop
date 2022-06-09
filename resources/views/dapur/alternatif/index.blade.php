<x-app-layout>
    @if (session('success'))
        <x-slot name="message">
            {{ session('success') }}
        </x-slot>
    @endif

    <x-slot name="header">
        Alternatif
    </x-slot>

    <x-container>

        <div class="flex items-center mb-5">
            <a href="{{ route('d.alternatif.create') }}" class="btn-primary">
                <i class='bx bxs-plus-circle bx-xs mr-1'></i>
                <span>Tambah Alternatif</span>
            </a>
        </div>

        <x-table>
            <thead class="bg-slate-50">
                <tr>
                    <x-th>No</x-th>
                    <x-th>Nama</x-th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($all_alternatif as $alternatif)
                    <tr>
                        <x-td>{{ $loop->iteration }}</x-td>
                        <x-td>{{ $alternatif->nama }}</x-td>

                        <td class="px-6 py-2 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                @if ( is_null($alternatif->alternatif_max_bobot) )
                                    <a href="{{ route('d.alternatif.max-bobot', $alternatif) }}" class="btn-hover-primary">Hitung max</a>
                                @endif

                                <a href="{{ route('d.alternatif.show', $alternatif) }}" class="btn-hover-primary">Detail</a>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap" colspan="4">
                            <p class="text-sm text-center text-slate-500 italic">Belum ada data</p>
                        </td>
                    </tr>

                @endforelse
            </tbody>
        </x-table>
                    
    </x-container>
</x-app-layout>
