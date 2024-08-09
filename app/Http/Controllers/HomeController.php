<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class HomeController extends Controller
{
    public function index(){
        $title = 'Trang Chủ';
        $query = Product::where('status', 1)->orderBy('view', 'desc')->limit(8)->get();
        $query1 = Product::orderBy('created_at', 'desc')->limit(8)->get();
        // dd($query[0]->productsDetail);
        return view('user.home', ['title'=>$title, 'query'=>$query, 'query1'=>$query1]);
    }
    public function NewsPage(){
        $title = 'Trang liên hệ';
        return view('user.news', ['title'=>$title]);
    }
}
