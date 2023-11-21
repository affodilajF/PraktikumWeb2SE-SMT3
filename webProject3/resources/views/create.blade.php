<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <!-- Tambahkan link stylesheet Bootstrap di sini -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

</head>



<body>

    @extends('dashboard')
    @section('content')

<div class="container mt-5">
    <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" required class="date from-control" placeholder="yyyy/mm/dd">
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


        <div class="mb-3 d-flex justify-content-end">
            <button type="submit"class="btn btn-dark text-dark">Simpan</button>
            <a href="/buku" class="btn btn-secondary ml-2">Batal</a>
        </div>

    </form>
</div>

@if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@endsection


</body>
</html>
