<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductFile extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','filename','path','type','size'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
