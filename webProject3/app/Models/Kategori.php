<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = ['nama_kategori'];

    // Definisikan relasi dengan tabel kategoribuku
    public function kategoribuku()
    {
        return $this->hasMany(Kategoribuku::class);
    }

    
}
