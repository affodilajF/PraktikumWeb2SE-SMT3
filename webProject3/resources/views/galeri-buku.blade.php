<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



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


                <div class="flex flex-col">
                    <p class="text-2xl font-bold text-gray-900 mb-2">{{ $bukus->judul }}</p>
                    <p class="text-lg font-semibold text-gray-700 mb-1">Rp. {{ $bukus->harga }}</p>
                    <p class="text-base text-gray-700 mb-1">{{ $bukus->penulis }}</p>
                    <p class="text-base text-gray-700 mb-4">{{ $bukus->tgl_terbit }}</p>

                    @if ($avgrating === null)
                        <p class="text-sm text-red-500 mb-2">Belum ada rating untuk buku ini</p>
                    @else
                        <div class="flex items-center">
                            <p class="mr-2">{{ $avgrating }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avgrating)
                                    <i class="fas fa-star text-yellow-500"></i>
                                @endif
                            @endfor
                        </div>
                    @endif
                </div>



                {{-- <br> --}}
                {{-- <br> --}}
                <br>

                <div>
                @if (Auth::check() && Auth::user()->level == 'user')
                    @if($isFav)
                    <button disabled class="bg-green-500 text-white font-bold py-2 px-4 rounded">
                        Saved as Favorite
                    </button>
                    @else
                    <form action="{{ route('addfav.book', $bukus->id) }}" method="post" class="flex items-center">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Save as Favorite
                        </button>
                    </form>
                    @endif
                @endif
                </div>

                {{-- <br> --}}


                <br>
                <div>
                    @if (Auth::check() && Auth::user()->level == 'user')
                        <form action="{{ route('buku.rate', $bukus->id) }}" method="post">
                            @csrf
                            <div class="flex items-center mb-4">
                                <label for="rating" class="mr-4 font-semibold text-gray-700">Rate this book:</label>
                                <input type="number" name="rating" id="rating" class="my-1 p-2 border rounded-md w-16 text-center" placeholder="0-5" min="0" max="5" step="1">
                                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 ml-4 rounded-md">Submit Rating</button>

                            </div>
                        </form>
                    @endif
                </div>


                <div>
                    @foreach ($kategoriBuku as $kb)
                        <p>{{ $kb->kategori->nama_kategori }}</p>
                    @endforeach

                </div>






                <div>
                    @if (Auth::check() && Auth::user()->level == 'admin')
                        <form action="{{ route('simpan_kategori', $bukus->id) }}" method="post">
                            @csrf
                            <label for="kategori_id" class="mr-2 font-semibold text-gray-700">Tambah Kategori:</label>
                            <select name="kategori_id" id="kategori_id" class="p-2 border rounded-md">
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Kategori::all() as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Tambah</button>
                        </form>
                    @endif
                </div>



                @if(Session::has('pesan'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 py-2 px-3 mb-2" role="alert">
                    <p class="text-xs">{{ Session::get('pesan') }}</p>
                </div>
                @endif



            </div>
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
