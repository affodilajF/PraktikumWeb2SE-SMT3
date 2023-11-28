<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <x-slot name="header">
        @switch(request()->route()->getName())
            @case('buku')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Daftar Buku') }}
                </h2>
                @break
            @case('dashboard')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                @break
            @case('buku.edit')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Buku') }}
                </h2>
            @break
            @case('buku.create')
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tambah Buku') }}
                </h2>
            @break
            @case('favbooks')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buku Favorite Ku') }}
            </h2>
        @break
        @endswitch
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

