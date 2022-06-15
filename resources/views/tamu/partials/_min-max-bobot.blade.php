<div class="mb-6">
    <x-table>
        <thead class="bg-slate-50">
            <tr>
                <x-th></x-th>
                <x-th></x-th>
                @foreach ($array['ktr'] as $item)
                    <x-th>{{ $item }}</x-th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            <tr>
                <x-td>Min/Max Bobot Alternatif</x-td>
                <x-td></x-td>
                @foreach ($array['min_max_alt'] as $min_max)
                    <x-td>{{ number_format($min_max, 2) }}</x-td>
                @endforeach
            </tr>
        </tbody>
    </x-table>
</div>