<x-guest-layout>

    <div class="min-h-screen bg-slate-50">
        @include('layouts.navigation')

        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="container flex flex-col py-4 mx-auto space-y-3 lg:h-[30rem] lg:flex-row lg:items-center">
                    <div class="flex items-center justify-center w-full px-4 py-8 md:px-0 lg:h-[32rem] lg:w-1/2">
                        <div class="max-w-xl">
                            <h2 class="text-xl font-semibold text-gray-600 lg:text-2xl">Sistem Pendukung Keputusan</h2>
                            <h2 class="text-3xl font-semibold text-indigo-600 lg:text-5xl">Pemilihan Laptop</h2>
                                
                            <p class="mt-2 text-sm text-gray-500 lg:text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis commodi cum cupiditate ducimus.</p>
        
                            <div class="flex flex-col mt-6 space-y-3 lg:space-x-3 lg:space-y-0 lg:flex-row">
                                <a href="{{ route('home') }}" class="btn-primary justify-center">
                                    <i class='bx bx-search bx-xs mr-1'></i>
                                    Cari Laptop
                                </a>
                                <a href="#" class="btn-secondary justify-center">
                                    Tentang
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center w-full h-52 md:h-96 lg:h-auto lg:w-1/2">
                        <img class="object-cover w-full h-full max-w-2xl sm:rounded-md shadow sm:shadow-md shadow-indigo-400/50" src="{{ asset('img/laptop-3.jpg') }}" alt="Laptop">
                    </div>
                </div>

            </div>
        </main>
    </div>

</x-guest-layout>