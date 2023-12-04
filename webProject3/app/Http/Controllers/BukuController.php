<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Intervention\Image\Facades\Image;
use App\Models\Gallery;

use App\Models\UserFavBooks;

use App\Models\User;
use App\Models\Rating;



use Illuminate\Support\Facades\Auth; // Import the Auth facade

class BukuController extends Controller
{

    public function rate(Request $request, $id)
    {

        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Adjust the validation rules as needed
        ]);


        $rating = new rating();
        $rating->user_id = auth()->id();
        $rating->book_id = $id;
        $rating->rating = $request->input('rating');
        $rating->save();

        $buku = Buku::where('id', $id)->first();
        $judul = $buku->judul;

        return redirect()->route('galeri.buku', $judul)->with('pesan', 'Rating submitted successfully!');
    }




    /**
     * Display a listing of the resource.
     */

    public function galbuku($title){
        $bukus = Buku::where('judul', $title)->first();
        $galeris = $bukus->galleries()->orderBy('id', 'desc')->paginate(7);

        $isFav = false;
        $user = Auth::user();

        if ($user) {
            $userFavorite = UserFavBooks::where('user_id', $user->id)
                ->where('book_id', $bukus->id)
                ->exists();

            if ($userFavorite) {
                $isFav = true;
            }

            // rating
            $ratings = rating::where('book_id', $bukus->id)->get();
            $avgrating = $ratings->avg('rating');
            // dd($avgrating);
        }

        return view('galeri-buku', compact('bukus', 'galeris', 'isFav', 'avgrating'));
    }

    

    public function addbook(Buku $buku)
    {
        $user = Auth::user();

        if ($user) {
            $userFavBook = new UserFavBooks();
            $userFavBook->user_id = $user->id;
            $userFavBook->book_id = $buku->id;
            $userFavBook->save();

            return redirect()->back();
        }
    }


    public function index()
    {
        $batas = 4;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);


        $no =($batas * ($data_buku->currentPage()-1))+1;


        // menghitung total harga
        $total_harga = 0;
        foreach ($data_buku as $buku) {
            $total_harga = $total_harga +  (int)$buku->harga;
        }

        // me-return hasilnya menggunakan sebuah view
        return view('index', compact('data_buku', 'total_harga', 'no', 'jumlah_buku'));

    }

    public function indexFavBooks()
    {
        $batas = 4;
        $user = Auth::user();
        $usery = User::find($user->id);

        if ($user) {
            // menghitung jumlah buku yang favorite
            $jumlah_buku = $usery->favoriteBooks()->count();

            // mendapatkan data buku yang favorite
            $data_buku = Buku::whereHas('userFavBooks', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('id', 'desc')->paginate($batas);

            $no = ($batas * ($data_buku->currentPage() - 1)) + 1;
            return view('indexfav', compact('data_buku', 'no', 'jumlah_buku'));
        }
    }


    // $data_buku = Buku::whereHas('userFavBooks')->orderBy('id', 'desc')->paginate($batas);
    // kalo tanpa userFavBooks
    // $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);





    public function search(Request $request)
    {
        $batas = 4;
        $cari = $request->kata;

        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")->simplePaginate($batas);


        $jumlah_buku = $data_buku->count();

        $no = $batas * ($data_buku->currentPage()-1);
        $total_harga = 0;
        foreach ($data_buku as $buku) {
            $total_harga = $total_harga +  (int)$buku->harga;
        }

        return view('index', compact('data_buku', 'total_harga', 'no', 'jumlah_buku', 'cari'));

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
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = date('Y-m-d', strtotime($request->tgl_terbit));

        if ($request->file('thumbnail')) {
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();

            $buku-> filename = $fileName;
            $buku-> filepath = '/storage/' . $filePath;
        }

        $buku->save();

        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $buku-> id
                ]);

            }
        }
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Simpan');
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


        // KALO GALLERY
        if ($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri'   => $fileName,
                    'path'          => '/storage/' . $filePath,
                    'foto'          => $fileName,
                    'buku_id'       => $id
                ]);

            }
        }


        // KALO THUMBNAIL
        if ($request->file('thumbnail')) {
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            Image::make(storage_path().'/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();

            Buku::where('id', $id)->update([
                'judul' => $judul,
                'penulis' => $penulis,
                'harga' => $harga,
                'tgl_terbit' => $tgl_terbit,

                'filename' => $fileName,
                'filepath'  => '/storage/' . $filePath

            ]);

        }

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Hapus');
    }
}
