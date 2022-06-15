<div class="mb-6">
    <h3 class="text-lg text-slate-700 px-4 capitalize">Ranking</h3>
    <x-table>
        <thead class="bg-slate-50">
            <tr>
                <x-th>#</x-th>
                <x-th>Laptop</x-th>
                <x-th>Total Nilai</x-th>
            </tr>
        </thead>
    
        <tbody class="bg-white divide-y divide-slate-200">
            @forelse ($array['ranking']->sortDesc() as $key => $value)
                <tr>
                    <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                        {{ $loop->iteration }}
                    </x-td>
                    <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                        {{ $key }}
                    </x-td>
                    <x-td :text="$loop->iteration < 4 ? 'text-indigo-600 font-semibold' : ''">
                        {{ number_format($value , 2); }}
                    </x-td>
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