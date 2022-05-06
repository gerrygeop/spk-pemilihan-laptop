<section>
    <div class="flex flex-col space-y-7">
    
        <div>
            <x-label for="keterangan" value="Keterangan" class="mb-1" />
            <x-input type="text" name="keterangan" id="keterangan" class="w-full focus:ring-0" value="{{ old('keterangan', $representasi->keterangan) }}" required />
        </div>
    
        <div>
            <x-label for="min" value="Min Trapesium" class="mb-1" />
            <x-input type="text" name="min" id="min" class="w-full focus:ring-0" value="{{ old('min', $representasi->min) }}" />
        </div>
        
        <div>
            <x-label for="max" value="Max Trapesium" class="mb-1" />
            <x-input type="text" name="max" id="max" class="w-full focus:ring-0" value="{{ old('max', $representasi->max) }}" />
        </div>
        
        <div>
            <x-label for="nilai" value="Nilai Tabel" class="mb-1" />
            <x-input type="text" name="nilai" id="nilai" class="w-full focus:ring-0" value="{{ old('nilai', $representasi->nilai) }}" />
        </div>
        
    </div>
    
    <div class="flex items-center mt-8">
        <a href="{{ route('d.representasi.index') }}" class="btn-secondary mr-2">Batal</a>
        <x-button>Simpan</x-button>
    </div>
</section>