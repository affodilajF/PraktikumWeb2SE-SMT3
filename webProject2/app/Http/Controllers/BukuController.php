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
            $total_harga += $buku->harga;
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
