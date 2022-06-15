<div>   
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @foreach ($kriteria as $ktr)
            <div class="col">
                <label for="checkbox_{{ $ktr->toSlug() }}" class="flex items-center">
                    <x-input 
                        wire:model="nama_kriteria.{{ $ktr->id }}"
                        type="checkbox"
                        name="checkbox_{{ $ktr->toSlug() }}" 
                        id="checkbox_{{ $ktr->toSlug() }}"
                        value="{{ $ktr->nama }}"
                    />

                    <span class="ml-2 text-gray-700">
                        {{ $ktr->nama }}
                    </span>
                </label>
            </div>
        @endforeach

    </div>
    
    @if ( count($nama_kriteria) > 0 )
        <div class="my-8 border-t border-gray-300"></div>

        <form action="{{ route('rekomendasi.store') }}" method="POST">
            @csrf

            <h3 class="mb-4 text-xl text-gray-700 font-medium">Masukan Nilai Kriteria</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-7 sm:gap-y-3 gap-x-4 items-end">
                @foreach ($kriteria->whereIn('nama', $nama_kriteria) as $ktr)
                    <div class="col">
                        <x-label for="input_{{ $ktr->toSlug() }}" value="{{ $ktr->nama }}" class="mb-1" />
                        @if ( $ktr->representasi->first()->nilai == null )
                            <x-input
                                :type="( $ktr->type_inputan == 'integer' ) ? 'number' : 'text'"
                                name="{{ $ktr->id }}"
                                id="input_{{ $ktr->toSlug() }}"
                                class="w-full"
                            />

                        @else
                            <x-select name="{{ $ktr->id }}" id="input_{{ $ktr->toSlug() }}" class="w-full">
                                @foreach ($ktr->representasi as $rep)
                                    <option value="{{ $rep->keterangan }}">
                                        {{ $rep->keterangan }}
                                    </option>
                                @endforeach
                            </x-select>
                                
                        @endif
                    </div>
                @endforeach

                <div class="col flex items-center">
                    <i class='bx bx-loader-alt bx-sm bx-spin ml-10' wire:loading></i>
                </div>
            </div>

            <div class="flex items-center mt-8">
                <button class="btn-primary">
                    <i class='bx bx-search bx-sm mr-1'></i>
                    <span>Cari Rekomendasi</span>
                </button>
            </div>
        </form>

    @else
        <div class="mt-4 flex justify-center">
            <i class='bx bx-loader-alt bx-sm bx-spin ml-10' wire:loading></i>
        </div>

    @endif
</div>
