<x-app-layout>
    <x-slot name="header">
        Representasi
    </x-slot>

    <x-container>

        @foreach ($all_kriteria as $kriteria)
            <div class="flex items-center justify-between mb-1">
                <h4 class="text-gray-700 text-lg font-semibold">{{ $kriteria->nama }}</h4>
                <a href="{{ route('d.representasi.create', $kriteria) }}" class="btn-primary">
                    <i class='bx bxs-plus-circle bx-xs mr-1'></i>
                    <span>Tambah Data</span>
                </a>
            </div>

            <div class="mb-10">
                <x-table>
                    <thead class="bg-slate-50">
                        <tr>
                            <x-th>Keterangan</x-th>
                            <x-th>Representasi</x-th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
    
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($kriteria->representasi as $rep)
                            <tr>
                                <x-td>{{ $rep->keterangan }}</x-td>
                                <x-td class="flex items-center">
                                    <span class="font-bold">{{ $rep->min }}</span>
                                    <i class='bx bx-minus mx-1'></i>
                                    <span class="font-bold">{{ $rep->max }}</span>
                                </x-td>
    
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('d.representasi.edit', [$kriteria, $rep]) }}" class="btn-hover-primary">Edit</a>
    
                                        <form action="{{ route('d.representasi.destroy', [$kriteria, $rep]) }}" method="POST" onsubmit="return confirm('Yakin untuk menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-hover-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
    
                        @empty
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" colspan="3">
                                    <p class="text-sm text-center text-slate-500 italic">Belum ada data</p>
                                </td>
                            </tr>
    
                        @endforelse
                    </tbody>
                </x-table>
            </div>
        @endforeach
                    
    </x-container>
</x-app-layout>
