<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(){
        return view ('admin.admindashboard', ['pageName' => 'Dashboard']);
    }

    public function products(){
        $query = Product::join('categories', 'products.category_id','=', 'categories.id')->select('products.*', 'categories.name as namecate')->orderBy('id', 'asc')->get();
        $query1 = Category::all();;
        return view('admin.adminproduct', ['data'=>$query, 'cate'=>$query1]);
    }

    public function AddProForm(){
        $cate = Category::all();
        return view('admin.addproduct', ['cate'=>$cate]);
    }

    public function InsertPro(Request $request){
        $directoryPath = public_path('img/product');
        $imageName = time().'-'.$request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->move($directoryPath, $imageName);
        Product::create(
            [
                'name' => $request->name,
                'image' => $imageName,
                'price' => $request->price,
                'sale_price' => $request->sale,
                'description' => $request->description,
                'detail' => $request->detail,
                'view' => $request->view,
                'status' => $request->status,
                'category_id' => $request->category_id,
            ]
        );
        return redirect()->route('admin.pro');
    }

    public function EditProForm($id){
        // $product = Product::findorFail($id);
        $product = Product::join('categories', 'products.category_id','=', 'categories.id')->select('products.*', 'categories.id as idcate' ,'categories.name as namecate')->where('products.id',$id)->first();
        $cate = Category::all();
        // $product = DB::table('products')->join('categories', 'products.category_id','=', 'categories.id')->select('products.*', 'categories.id as idcate' ,'categories.name as namecate')->where('products.id',$id)->first();
        // $cate = DB::table('categories')->get();
        return view('admin.editproduct', compact('product', 'cate'));
    }

    public function UpdatePro(Request $request,$id){
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale');
        $product->description = $request->input('description');
        $product->detail = $request->input('detail');
        $product->view = $request->input('view');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        if($request->hasFile('image')){
            unlink(public_path('img/product/'. $product->image));
            $directoryPath = public_path('img/product');
            $imageName = time().'-'.$request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->move($directoryPath, $imageName);
            $product->image = $imageName;
        }else{
            $product->image = $product->image;
        }
        $product ->save();
        return redirect()->route('admin.pro');
    }

    public function DeletePro($id){
        $product = Product::findorFail($id);
        // $filePath = public_path('img/product/' . $product->image);
        // unlink($filePath);
        // $product->delete();
        $product->status = 0; // khi xóa sẽ ẩn sản phẩm
        $product ->save();
        return redirect()->route('admin.pro');
    }

    public function Categories(){
        $cate = Category::all();
        return view('admin.admincategories', compact('cate'));
    }

    public function AddCateForm(){
        // $cate = DB::table('categories')->get();
        return view('admin.addcategories');
    }

    public function InsertCate(Request $request){
        Category::create(
            [
                'name' => $request->name,
            ]
        );
        return redirect()->route('admin.cate');
    }

    public function Search(Request $request){
        $cate = Category::all();
        $keyword = $request->input('keyword');
        $product = Product::join('categories', 'products.category_id','=', 'categories.id')
        ->select('products.*', 'categories.name as namecate')
        ->where('products.name', 'like', "%$keyword%")
        ->orWhere('description', 'like', "%$keyword%")
        ->orWhere('detail', 'like', "%$keyword%")
        ->orderby('id', 'desc')
        ->get();

        return view('admin.adminproduct', ['data'=>$product,'cate'=>$cate]);
    }

    public function ProByCate($idcate = 0){
        $cate = Category::all();
        $data = DB::table('products')
        ->join('categories', 'products.category_id','=', 'categories.id')
        ->select('products.*', 'categories.name as namecate')
        ->where('category_id', $idcate)
        ->orderBy('id', 'asc')->get();
        // $data = DB::table('products')->where('category_id', $idcate)->get();
        return view('admin.adminproduct', ['cate'=>$cate, 'data'=>$data]);
    }

    public function EditCateForm($id){
        // $product = Product::findorFail($id);
        $cate = Category::findOrFail($id);
        // $product = DB::table('products')->join('categories', 'products.category_id','=', 'categories.id')->select('products.*', 'categories.id as idcate' ,'categories.name as namecate')->where('products.id',$id)->first();
        // $cate = DB::table('categories')->get();
        return view('admin.editcategories', compact('cate'));
    }

    public function UpdateCate(Request $request,$id){
        $cate = Category::findOrFail($id);
        $cate->name = $request->input('name');
        
        $cate ->save();
        return redirect()->route('admin.cate');
    }

    public function DeleteCate($id){
        $product = Product::where('category_id', $id)->get();
        foreach ($product as $item) {
            $item->category_id = 0;
            $item->save();
        }
        $cate = Category::find($id)->delete();
        return redirect()->route('admin.cate');
    }
}
