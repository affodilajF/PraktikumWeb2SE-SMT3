<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menggambil semua data yang berada didalam tabel buku di database
        $data_buku = Buku::all();

        // menghitung jumlah baris
        $jumlah_data = Buku::count();

        // menghitung total harga
        $total_harga = 0;
        foreach ($data_buku as $buku) {
            $total_harga = $total_harga +  (int)$buku->harga;
        }

        // Untuk memberi nomor baris data
        $no = 1;

        // me-return hasilnya menggunakan sebuah view
        return view('index', compact('data_buku', 'jumlah_data', 'total_harga', 'no'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;

        $buku->tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));
        $buku->save();
        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $buku = Buku::find($id);
        return view('edit',compact( 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->id;

        $judul = $request->judul;
        $penulis = $request->penulis;
        $harga = $request->harga;
        $tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));


        Buku::where('id', $id)->update([
            'judul' => $judul,
            'penulis' => $penulis,
            'harga' => $harga,
            'tgl_terbit' => $tgl_terbit,
        ]);

        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }
}
