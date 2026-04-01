<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas;

class BookRequest extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'sinopsis',
        'jumlah_halaman',
        'cover',
        'category_id',
        'action',
        'status'
    ];

    // relasi ke user (si petugas)
    public function user()
    {
        return $this->belongsTo(Petugas::class, 'user_id');
    }

    // relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}