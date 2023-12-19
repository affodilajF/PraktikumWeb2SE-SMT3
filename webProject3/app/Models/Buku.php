<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $dates = ['tgl_terbit'];

    protected $table = 'buku';

    protected $fillable = ['id', 'judul', 'penulis', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'filename', 'filepath'];


    public function galleries(): HasMany {
        return $this->hasMany(Gallery::class);
    }

        public function userFavBooks()
    {
        return $this->hasMany(UserFavBooks::class, 'book_id', 'id');
    }

    // public function ratings()
    // {
    //     return $this->hasMany(Rating::class);
    // }

    // public function averageRating()
    // {
    //     return $this->ratings->avg('rating');
    // }


    // public function rating()
    // {
    //     return $this->hasMany(Rating::class);
    // }




    public function ratings()
    {
        return $this->hasMany(Rating::class, 'book_id', 'id');
    }











    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategoribuku', 'buku_id', 'kategori_id');
    }












}

