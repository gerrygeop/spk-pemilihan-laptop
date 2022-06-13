<section>
    <div class="flex flex-col space-y-7">
        <div>
            <x-label for="name" value="Nama" class="mb-1" />
            <x-input type="text" name="name" id="name" class="w-full focus:ring-0" value="{{ old('name', auth()->user()->name) }}" required />
            
            @error('name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div>
            <x-label for="email" value="E-mail" class="mb-1" />
            <x-input type="email" name="email" id="email" class="w-full focus:ring-0" value="{{ old('email', auth()->user()->email) }}" />

            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="flex items-center justify-between mt-8">
        <x-button>Simpan</x-button>

        @if (session('success_information'))
            <p class="text-sm text-indigo-600">{{ session('success_information') }}</p>
        @endif
    </div>
</section>