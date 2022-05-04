<x-app-layout>
    <x-slot name="header">
        Kriteria
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center mb-5">
                <a href="{{ route('d.kriteria.create') }}" class="btn-primary">
                    <i class='bx bxs-plus-circle bx-xs mr-1'></i>
                    <span>Tambah Kriteria</span>
                </a>
            </div>

            <x-table>
                <thead class="bg-slate-50">
                    <tr>
                        <x-th>Kode</x-th>
                        <x-th>Nama</x-th>
                        <x-th>Keterangan</x-th>
                        <x-th>Bobot</x-th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse ($all_kriteria as $kriteria)
                        <tr>
                            <x-td>{{ $kriteria->kode }}</x-td>
                            <x-td>{{ $kriteria->nama }}</x-td>
                            <x-td>{{ $kriteria->keterangan }}</x-td>
                            <x-td>{{ $kriteria->bobot }}</x-td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center justify-end">
                                    <a href="{{ route('d.kriteria.edit', $kriteria) }}" class="btn-hover-primary">Edit</a>

                                    <form action="{{ route('d.kriteria.destroy', $kriteria) }}" method="POST" onsubmit="return confirm('Yakin untuk menghapus?')">
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
                    
        </div>
    </div>
</x-app-layout>
