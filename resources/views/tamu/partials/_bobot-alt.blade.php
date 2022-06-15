<div>
    <h3 class="text-lg text-slate-700 px-4 capitalize">Bobot Alternatif</h3>
    <x-table>
        <thead class="bg-slate-50">
            <tr>
                <x-th>#</x-th>
                <x-th>Laptop</x-th>
                @foreach ($array['ktr'] as $item)
                    <x-th>{{ $item }}</x-th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            @forelse ($array['alternatif'] as $key => $item)
                <tr>
                    <x-td>{{ $loop->iteration }}</x-td>
                    <x-td>{{ $item->nama }}</x-td>
                    @foreach ($array['bobot_alt'] as $bobot_alt)
                        <x-td>{{ number_format($bobot_alt[$key], 2) }}</x-td>
                    @endforeach
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