<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable= [
        'color',
        'option',
        'quantity',
        'price',
        'sale_price',
        'status',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
