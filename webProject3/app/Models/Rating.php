<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;


    public function book()
    {
        return $this->belongsTo(buku::class);
    }






    public function buku()
    {
        return $this->belongsTo(Buku::class, 'book_id', 'id');
    }


}
