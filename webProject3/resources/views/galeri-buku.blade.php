<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('dist/css/lightbox.min.css') }}" rel="stylesheet">


    <style>

    </style>


</head>
<body class="bg-gray-100">

    <div class="container mx-auto py-10 p-14 ">
        <!-- Bagian Buku -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 flex items-center p-6 ">
            <div class="w-1/3">
                @if ($bukus->filepath)
                <div class="relative">
                    <img class="w-auto h-full object-cover object-center" src="{{ asset($bukus->filepath) }}" alt="" width="600" height="400">
                </div>
                @endif
            </div>
            <div class="w-3/4">
                <p class="text-2xl font-bold text-gray-900 mb-2">{{ $bukus->judul }}</p>
                <p class="text-lg font-semibold text-gray-700 mb-1">Rp. {{ $bukus->harga }}</p>
                <p class="text-base text-gray-700 mb-1">{{ $bukus->penulis }}</p>
                <p class="text-base text-gray-700">{{ $bukus->tgl_terbit }}</p>

                <br>
                <div> <a href=""> Toko Buku Ea </a>  </div>
            </div>
{{--
            <div class="w-1/4 ">
                <div> <a href=""> Toko Buku Ea </a>  </div>
            </div> --}}

        </div>

        <!-- Bagian Galeri Foto -->
        <div class="grid grid-cols-1 md:grid-cols-7 gap-6">
            @foreach ($galeris as $data)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ asset('storage/uploads/'.$data->foto) }}" data-lightbox="image-1" data-title="{{ $data->keterangan }}">
                        <img src="{{ asset('storage/uploads/'.$data->foto) }}" alt="{{ $data->nama_galeri }}"  width="400">
                    </a>
                    <div class="p-4">
                        <p class="text-xs mt-2">{{ $data->nama_galeri }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $galeris->links() }}</div>



    </div>

    <script src="{{ asset('dist/js/lightbox-plus-jquery.min.js') }}"></script>

</body>
</html>
