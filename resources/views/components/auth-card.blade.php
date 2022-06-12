<div style="background-image: url({{ asset('img/laptop-3.jpg') }})" class="background-img">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-indigo-600/70 to-violet-400/70 backdrop-filter backdrop-blur">
        <div>
            {{ $logo }}
        </div>
    
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow sm:shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</div>
