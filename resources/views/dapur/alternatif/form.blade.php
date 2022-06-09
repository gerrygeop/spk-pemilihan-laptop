<section>
    <div class="flex flex-col space-y-7">
    
        <div>
            <x-label for="nama" value="Nama Alternatif" class="mb-1" />
            <x-input type="text" name="nama" id="nama" class="w-full focus:ring-0" value="{{ old('nama', $alternatif->nama) }}" required autofocus />

            @error('nama')
                <p class="mt-1 text-red-500 text-sm italic">{{ $message }}</p>
            @enderror
        </div>

        @foreach ($kriterias as $ktr)
            @php
                $ktr_name_slug = trim($ktr->nama);
                $ktr_name_slug = strtolower($ktr_name_slug);
                $ktr_name_slug = str_replace(" ","_", $ktr_name_slug);
            @endphp

            <div>
                <x-label for="{{ $ktr_name_slug }}" value="{{ $ktr->nama }}" class="mb-1" />
                
                @if ( $ktr->representasi->first()->nilai == null )
                    <x-input 
                        type="{{ $ktr->type_inputan == 'integer' ? 'number':'text' }}"
                        name="{{ $ktr_name_slug }}" 
                        id="{{ $ktr_name_slug }}" 
                        class="w-full" 
                        value="{{ old($ktr_name_slug, $alternatif[$ktr_name_slug]) }}" 
                        required
                    />

                @else
                    <x-select name="{{ $ktr_name_slug }}" id="{{ $ktr_name_slug }}" class="w-full">
                        @foreach ($ktr->representasi as $rep)
                            <option value="{{ $rep->keterangan }}" {{ $rep->keterangan == $alternatif[$ktr_name_slug] ? 'selected':'' }}>
                                {{ $rep->keterangan }}
                            </option>
                        @endforeach
                    </x-select>

                @endif

                @error($ktr_name_slug)
                    <p class="mt-1 text-red-500 text-sm italic">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
    
    </div>
    
    <div class="flex items-center mt-8">
        <a href="{{ route('d.alternatif.index') }}" class="btn-secondary mr-2">Batal</a>
        <x-button>Simpan</x-button>
    </div>
</section>