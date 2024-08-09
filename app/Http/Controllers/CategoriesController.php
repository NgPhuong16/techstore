<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class CategoriesController extends Controller
{
    public function index(){
        $query = Category::all();
        $data = Product::all();
        $title = 'Trang sản phẩm';
        return view('user.product', ['title'=>$title, 'cate'=>$query, 'data'=>$data]);
    }

    public function ProByCate($idcate = 0){
        $title = 'Trang sản phẩm';
        $query = Category::all();
        $data = Product::where('category_id', $idcate)->get();
        return view('user.product', ['title'=>$title, 'cate'=>$query, 'data'=>$data]);
    }
}
