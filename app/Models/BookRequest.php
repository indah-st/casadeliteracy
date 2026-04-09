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
        'categories',
        'action',
        'status'
    ];

    // relasi ke user (si petugas)
    public function user()
    {
        return $this->belongsTo(Petugas::class, 'user_id');
    }

    // relasi ke kategori banyak (untuk book request dengan multi kategori)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_request_categories');
    }

    // relasi ke kategori tunggal (untuk book request lama dengan category_id)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // method untuk mendapatkan cover dari buku yang sudah di-approve
    public function getApprovedBookCover()
    {
        if ($this->status === 'approved') {
            // Cari buku yang sesuai dengan judul dan penulis dari request
            $book = \App\Models\Book::where('judul', $this->judul)
                                   ->where('penulis', $this->penulis)
                                   ->first();
            return $book ? $book->cover : null;
        }
        return null;
    }
}