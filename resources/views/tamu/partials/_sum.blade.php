<div class="mb-6">
    <h3 class="text-lg text-slate-700 px-4 capitalize">Total Nilai</h3>
    <x-table>
        <thead class="bg-slate-50">
            <tr>
                <x-th>#</x-th>
                <x-th>Laptop</x-th>
                <x-th>Total Nilai</x-th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            @forelse ($array['alternatif'] as $key => $item)
                <tr>
                    <x-td>{{ $loop->iteration }}</x-td>
                    <x-td>{{ $item->nama }}</x-td>
                    <x-td>{{ number_format($array['sum_alt'][$item->id], 2) }}</x-td>
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