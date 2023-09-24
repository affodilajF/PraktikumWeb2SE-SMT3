<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">

</head>
<body>

    <h1 style="text-align:center"> BUKU </h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th> No. </th>
                <th> Judul Buku </th>
                <th> Penulis </th>
                <th> Harga </th>
                <th> Tgl. Terbit </th>
                <th> Aksi </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data_buku as $buku )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp ".$buku->harga }}</td>
                    <td>{{ $buku->tgl_terbit }}</td>
                    <td>

                        <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                            @csrf
                            <button class="btn btn-danger" onClick="return confirm('Mau hapus yakin?')">Hapus </button>
                        </form>

                        <form  action="{{ route('buku.edit', $buku->id) }}" method="post">
                            @csrf
                            <button class="btn btn-warning"> Edit </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th> TOTAL </th>
                <th>{{ $jumlah_data }}</th>
                <th colspan="1"></th>
                <th>{{ $total_harga }}</th>
            </tr>
        </tfoot>
    </table>

    <div>
        <p align='right'>
            <a href="{{ route('buku.create') }}" class="btn btn-primary">TAMBAH BUKU</a>
          </p>

    </div>





</body>
</html>
