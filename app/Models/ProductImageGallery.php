<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_link',
        'product_id',
        ];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
