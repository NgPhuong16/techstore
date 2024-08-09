<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'sale_price',
        'description',
        'quantity',
        'detail',
        'view',
        'status',
        'category_id',
        ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public function imagesGallery(){
        return $this->hasMany(ProductImageGallery::class);
    }
    public function productsDetail(){
        return $this->hasMany(ProductDetail::class);
    }
}
