<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'brand',
        'category_id',
        'is_published',
        'access_level' // free/basic/premium/vip
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }

    protected static function booted()
    {
        static::creating(function ($m) {
            if (empty($m->slug) && !empty($m->title)) {
                $m->slug = Str::slug($m->title);
            }
        });
    }
}
