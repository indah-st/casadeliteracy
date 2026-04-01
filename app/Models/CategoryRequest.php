<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Petugas;

class CategoryRequest extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'action',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(Petugas::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}