<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
        'sinopsis',
        'jumlah_halaman',
        'cover',
        
    ];

    // Relasi ke kategori
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function collectedBy()
{
    return $this->belongsToMany(User::class, 'collections');
}

public function users()
{
    return $this->belongsToMany(User::class, 'collections');
}
    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id');
    }
public function canReview()
{
    return !Review::where('book_id', $this->id)
        ->where('user_id', auth()->id())
        ->exists();
}
}


