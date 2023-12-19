<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribuku extends Model
{
    use HasFactory;

    protected $table = 'kategoribuku';
    protected $fillable = ['buku_id', 'kategori_id'];

    // Definisikan relasi dengan tabel buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Definisikan relasi dengan tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


}
