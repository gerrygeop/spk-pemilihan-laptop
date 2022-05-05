<section>
    <div class="flex flex-col space-y-7">
        <div>
            <x-label for="kode" value="Kode" class="mb-1" />
            <x-input type="text" name="kode" id="kode" class="w-full focus:ring-0 uppercase" value="{{ old('kode', $alternatif->kode) }}" required />
        </div>
    
        <div>
            <x-label for="nama" value="Nama Alternatif" class="mb-1" />
            <x-input type="text" name="nama" id="nama" class="w-full focus:ring-0" value="{{ old('nama', $alternatif->nama) }}" required />
        </div>

        @foreach ($alternatifColumn as $key => $column)
            <div>
                <x-label for="{{ $column }}" value="{{ $alternatif->removeSlug($column) }}" class="mb-1" />
                <input 
                    type="text" 
                    name="{{ $column }}" 
                    id="{{ $column }}" 
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                    value="{{ old($column, $alternatif[$column]) }}" 
                    required
                />
            </div>
        @endforeach


        {{-- <div>
            <x-label for="type_inputan" value="Tipe Data Inputan" class="mb-1" />
            <select id="type_inputan" name="type_inputan" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring-0">
                <option value="string" {{ $kriteria->isSelected('string') }}>String</option>
                <option value="integer" {{ $kriteria->isSelected('integer') }}>Integer</option>
                <option value="float" {{ $kriteria->isSelected('float') }}>Float</option>
            </select>
        </div> --}}
    
    </div>
    
    <div class="flex items-center mt-8">
        <a href="{{ route('d.alternatif.index') }}" class="btn-secondary mr-2">Batal</a>
        <x-button>Simpan</x-button>
    </div>
</section>