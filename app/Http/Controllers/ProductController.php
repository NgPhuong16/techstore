<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function index(){
        $title = 'Trang sản phẩm';
        return view('user.product', ['title'=>$title]);
    }

    public function DetailProduct($slug){
        $sp = Product::where('slug', $slug)->first();
        $relativePro = Product::where('category_id', $sp->category_id)->where('id','<>',$sp->id)->limit(5)->get();
        $title = $sp->name;
        // dd($sp->imagesGallery);
        return view('user.product-detail', compact(['sp', 'relativePro', 'title']));
    }

    public function Search(Request $request){
        $title = 'Trang sản phẩm';
        $query = Category::all();
        $keyword = $request->input('keyword');
        $product = Product::where('name', 'like', "%$keyword%")
        ->orWhere('description', 'like', "%$keyword%")
        ->orWhere('detail', 'like', "%$keyword%")
        ->orderby('id', 'desc')
        ->get();

        return view('user.product', ['title'=>$title,'data'=>$product,'cate'=>$query]);
    }
}
