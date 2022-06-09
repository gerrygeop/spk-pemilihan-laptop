<section>
    <div class="flex flex-col space-y-7">
        <div>
            <x-label for="kode" value="Kode" class="mb-1" />
            <x-input type="text" name="kode" id="kode" class="w-full focus:ring-0 uppercase" value="{{ old('kode', $kriteria->kode) }}" required />
        </div>
    
        <div>
            <x-label for="nama" value="Nama" class="mb-1" />
            <x-input type="text" name="nama" id="nama" class="w-full focus:ring-0" value="{{ old('nama', $kriteria->nama) }}" required />
        </div>

        <div>
            <x-label value="Keterangan" class="mb-1" />
            <div class="flex">
                <label for="benefit" class="text-base font-medium text-gray-800 flex items-center mr-6">
                    <x-input type="radio" id="benefit" value="benefit" name="keterangan" class="mr-2" checked="{{ $kriteria->isChecked('benefit') }}" />
                    Benefit
                </label>
                <label for="cost" class="text-base font-medium text-gray-800 flex items-center mr-4">
                    <x-input type="radio" id="cost" value="cost" name="keterangan" class="mr-2" checked="{{ $kriteria->isChecked('cost') }}" />
                    Cost
                </label>
            </div>
        </div>
    
        <div>
            <x-label for="bobot" value="Bobot" class="mb-1" />
            <x-input type="text" name="bobot" id="bobot" class="w-full focus:ring-0" value="{{ old('bobot', $kriteria->bobot) }}" required />
        </div>

        <hr>

        <div>
            <x-label for="type_inputan" value="Tipe Data Inputan" class="mb-1" />
            <select id="type_inputan" name="type_inputan" class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring-0">
                <option value="string" {{ $kriteria->isSelected('string') }}>String</option>
                <option value="integer" {{ $kriteria->isSelected('integer') }}>Integer</option>
                <option value="float" {{ $kriteria->isSelected('float') }}>Float</option>
            </select>
        </div>
    
    </div>
    
    <div class="flex items-center mt-8">
        <a href="{{ route('d.kriteria.index') }}" class="btn-secondary mr-2">Batal</a>
        <x-button>Simpan</x-button>
    </div>
</section>