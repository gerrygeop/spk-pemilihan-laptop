<section>
    <div class="flex flex-col space-y-7">
        <div>
            <x-label for="current_password" value="Kata sandi saat ini" class="mb-1" />
            <x-input type="password" name="current_password" id="current_password" class="w-full focus:ring-0" required />

            @if ( session('wrong_current_password') )
                <p class="text-red-500 text-xs mt-1">{{ session('wrong_current_password') }}</p>
            @endif
        </div>

        <div>
            <x-label for="password" value="Kata sandi baru" class="mb-1" />
            <x-input type="password" name="password" id="password" class="w-full focus:ring-0" required />

            @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div>
            <x-label for="password_confirmation" value="Konfirmasi kata sandi" class="mb-1" />
            <x-input type="password" name="password_confirmation" id="password_confirmation" class="w-full" />

            @error('password_confirmation')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <div class="flex items-center justify-between mt-8">
        <x-button>Simpan</x-button>

        @if (session('success_password'))
            <p class="text-sm text-indigo-600">{{ session('success_password') }}</p>
        @endif
    </div>
</section>