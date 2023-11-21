<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <!-- Tambahkan link stylesheet Bootstrap di sini -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>


{{-- <x-app-layout> --}}

    @extends('dashboard')
    @section('content')

    <div class="container mt-5">

    <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
            <input type="date" name="tgl_terbit" id="tgl_terbit" value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y-m-d') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
            <div class="mt-2">
                <input type="file" name="thumbnail" id="thumbnail" >
            </div>
        </div>


        <div class="col-span-full mt-6">
            <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
            <div class="mt-2" id="fileinput_wrapper">

            </div>
            <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-primary">Tambah</a>

            <script type="text/javascript">
                function addFileInput () {
                    var div = document.getElementById('fileinput_wrapper');
                    div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                };
            </script>
        </div>
        <br>

        {{-- <div class="gallery_items">
            @foreach($buku->galleries()->get() as $gallery)
                <div class="gallery_item">
                    <img
                        class="object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt=""
                        width="400"
                        style="margin: 10px;"
                    />

                    <label>
                        Hapus gambar?
                        <input type="checkbox" class="gallery-checkbox" data-gallery-id="{{ $gallery->id }}" style="margin: 10px;">
                    </label>
                </div>
            @endforeach
        </div> --}}

        {{-- <div class="container-fluid">
        <div class="gallery_items">
            @foreach($buku->galleries()->get() as $gallery)
                <div class="gallery_item">
                    <img
                        class="object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt=""
                        width="400"
                        style="margin: 10px;"
                    />

                    <label>
                        Hapus gambar?
                        <input type="checkbox" class="gallery-checkbox" data-gallery-id="{{ $gallery->id }}" style="margin: 10px;">
                    </label>
                </div>
            @endforeach
        </div>
        </div> --}}


        <div class="container-fluid">
            <div class="row align-items-start mr-3">
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="col-3 mb-3">
                        <div class="position-relative">

                            <img src="{{ asset($gallery->path) }}" alt="" width="400"/>

                            <a href="{{ route('gallery.delete', $gallery->id) }}" class="btn btn-secondary" style="position: absolute; top: 10px; right: 10px;">
                                <i class="fas fa-trash-alt"></i>
                                Hapus
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <button type="submit" class="btn btn-dark text-dark">UPDATE</button>
            <a href="/buku" class="btn btn-dark text-white ml-2">BATAL</a>
        </div>

    </form>
</div>

@endsection







{{-- </x-app-layout> --}}

</body>
</html>




