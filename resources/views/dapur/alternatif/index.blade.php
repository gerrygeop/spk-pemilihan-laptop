<x-app-layout>
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
                    <x-th>Kode</x-th>
                    <x-th>Nama</x-th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-slate-200">
                @forelse ($all_alternatif as $alternatif)
                    <tr>
                        <x-td>{{ $alternatif->kode }}</x-td>
                        <x-td>{{ $alternatif->nama }}</x-td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex items-center justify-end">
                                <a href="{{ route('d.alternatif.show', $alternatif) }}" class="btn-hover-primary">Detail</a>
                                <a href="{{ route('d.alternatif.edit', $alternatif) }}" class="btn-hover-primary">Edit</a>

                                <form action="{{ route('d.alternatif.destroy', $alternatif) }}" method="POST" onsubmit="return confirm('Yakin untuk menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-hover-danger">Hapus</button>
                                </form>
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
