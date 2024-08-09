<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    public function Cart(Cart $cart){
        $title = 'Trang giỏ hàng';
        // dd($cart);
        return view('user.cart', compact('title', 'cart'));
    }

    public function AddtoCart(Product $product, Cart $cart){
        $cart->add($product);
        return redirect()->route('cart');
        // dd(session('cart'));
    }

    public function DelCart(Cart $cart, $id){
        $cart -> delete($id);
        return redirect()->route('cart');
    }
    public function addCartDB(Cart $cart, Request $request){
        $presentCart = $cart->items;
        // dd($presentCart);
        if(count($presentCart)>0){
            DB::transaction(function()use ($request, $presentCart){
                $order = Order::create([
                    'name' => $request->fullName,
                    'user_id' => $request->user_id,
                    'phone' => $request->phoneNumber,
                    'address' => $request->address ? $request->address : '',
                    'total_price' => $request->total_price,
                ]);

                foreach ($presentCart as $item) {
                    // $order->orderDetails()->create((array)$item);
                    if(isset($item->id)) {
                        // Tạo một bản ghi mới trong bảng order_details
                        // $orderDetail = OrderDetail::create([
                        //     'product_id'=> $item->id,
                        //     'price'=> $item->price,
                        //     'quantity'=> $item->quantity,
                        // ]);

                        $orderDetail = new OrderDetail();
                        $orderDetail->product_id = $item->id;
                        // Các thông tin khác của order_detail
                        $orderDetail->quantity = $item->quantity;
                        $orderDetail->price = $item->price;
                        // Lưu bản ghi
                        $order->orderDetails()->save($orderDetail);
                    }
                }
            });
        }
        session()->forget('cart');
        return redirect()->route('cart');
    }

    public function getCartHistory(){
        $title = 'Lịch sư mua hàng';
        $data = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('user.cart-history', ['title'=> $title, 'data'=>$data]);
    }

    public function getCartHistoryDetail($id){
        $orderdata = Order::where('id', $id)->select('id', 'created_at', 'total_price')->first();
        $data = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'order_details.product_id' ,'=', 'products.id')
        ->select('order_details.*',
        'orders.id as order_id'
        ,'products.name as proName','products.image as proImg','products.price as proPrice', )
        ->where('order_id', $id)->get();
        $title = 'Chi tiết đơn hàng';
        return view('user.cart-history-detail', compact('data', 'title', 'orderdata'));
    }

    
}
