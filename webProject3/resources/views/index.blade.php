<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



</head>
<body>

    @extends('dashboard')
    @section('content')


    <div class="container">


        <div>
            <form action="{{ route('buku.search') }}" method="get">@csrf
                <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%; display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
                </form>
        </div>


        @if (Auth::check() && Auth::user()->level == 'admin')
            <div class="text-left">
                <a href="{{ route('buku.create') }}" class="btn btn-primary">TAMBAH BUKU</a>
            </div>
        @endif


        <table class="table table-striped">
            <thead>
                <tr>
                    <th> No. </th>
                    <th> Buku </th>
                    <th> Judul Buku </th>
                    <th> Penulis </th>
                    <th> Harga </th>
                    <th> Tgl. Terbit </th>
                    <th> Aksi </th>
                </tr>
            </thead>


            <tbody>

                @foreach ($data_buku as $buku)

                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            @if ($buku->filepath)
                            <div class="relative h-10 w-10">
                                <img
                                class="h-full w-full  object-cover object-center"
                                src="{{ asset($buku->filepath) }}"
                                alt = ""
                                />
                            </div>
                            @endif
                        </td>

                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>


                        @if (Auth::check() && Auth::user()->level == 'admin')
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Apakah yakin ingin menghapus data?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>


                        <td>
                            <form  action="{{ route('buku.edit', $buku->id) }}" method="get">
                                @csrf
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            </form>
                         </td>
                         @endif

                         <td>


                            <form action="{{ route('galeri.buku', $buku->judul) }}" method="get">
                                @csrf
                                <button class="btn btn-sm btn-warning"><i class="fas fa-eye fa-inverse"></i> </button>
                            </form>

                         </td>
                    </tr>
                @endforeach
            </tbody>



            <tfoot>
                <tr>
                    <th> TOTAL </th>
                    <th>{{ $jumlah_buku }}</th>
                    <th colspan="1"></th>
                    <th>Rp {{ number_format($total_harga, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>


        {{-- links itu buat pagination --}}
        <div >
            {{ $data_buku->links() }}
        </div>
        <div class="text-center"><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>


    </div>

    @if(Session::has('pesan'))
        <div class="alert alert-success">{{ Session::get('pesan') }}</div>
    @endif

    @isset($cari)
        @if(count($data_buku))
            <div class="alert alert-success">Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{ $cari }}</strong></div>
        @else
            <div class="alert alert-warning"><h4>Data {{ $cari }} tidak ditemukan</h4> <a href="/buku" class="btn btn-warning">Kembali</a></div>
        @endif
    @endisset

    @endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

</body>
</html>


