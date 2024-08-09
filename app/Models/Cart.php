<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // use HasFactory;
    public $items = [];
    public $totalPrice = 0;
    public $totalQuantity = 0;

    public function __construct() {
        $this->items = session('cart') ? session('cart') : [];
        
    }
    public function add($product){
        if(isset($this->items[$product->id])){
            $this->items[$product->id]->quantity += 1;
        }else{
            $cart_item = (object)[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'sale' => $product->sale,
                'image' => $product->image,
                'quantity' => 1,
            ];
            $this->items[$product->id] = $cart_item;
        }
        session(['cart'=> $this->items]);
    }

    public function clearSession(){
        session()->flush();
    }

    public function delete($id){
        if(isset($this->items[$id])){
            unset($this->items[$id]);
            session(['cart'=> $this->items]);
        }
    }

    public function addCartDB($product){
        if(count($this->items)>0){
            
        }
    }
}
