<div class="mb-6">
    <h3 class="text-lg text-slate-700 px-4 capitalize">Bobot Kriteria</h3>
    <x-table>
        <thead class="bg-slate-50">
            <tr>
                <x-th>#</x-th>
                <x-th>Kriteria</x-th>
                <x-th>Bobot</x-th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            @forelse ($array['ktr_bobot'] as $key => $item)
                <tr>
                    <x-td>{{ $loop->iteration }}</x-td>
                    <x-td>{{ $key }}</x-td>
                    <x-td>{{ $item }}</x-td>
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
</div>