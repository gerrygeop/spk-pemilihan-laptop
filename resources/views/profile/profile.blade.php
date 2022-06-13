<x-app-layout>

    <x-container>
        <x-box>
            <h3 class="text-xl text-slate-700 font-medium">Informasi Profile</h3>
            <hr class="my-5">
            <form action="{{ route('profile.information') }}" method="POST">
                @csrf
                @method('PUT')
                @include('profile.form-information')
            </form>
        </x-box>

        <hr class="my-6">

        <x-box>
            <h3 class="text-xl text-slate-700 font-medium">Password</h3>
            <hr class="my-5">
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                @include('profile.form-password')
            </form>
        </x-box>
                    
    </x-container>
</x-app-layout>
