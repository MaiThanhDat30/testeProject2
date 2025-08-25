<?php

namespace App\Models;
use App\Models\Category; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'description',
        'published_year',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}