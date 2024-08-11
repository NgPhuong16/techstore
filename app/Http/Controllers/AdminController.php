<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());
        $directoryPath = public_path('images/products');
        $imageName = time().'-'.$request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->move($directoryPath, $imageName);
        $product = Product::create(
            [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $imageName,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'description' => $request->description,
                'detail' => $request->detail,
                'view' => $request->view,
                'status' => $request->status,
                'category_id' => $request->category_id,
            ]
        );
        $productId = $product->id;
        $this->InsertProDetail($request, $productId);
        return redirect()->route('admin.pro');
    }

    private function InsertProDetail(Request $request, $productId){
        // Lấy tất cả dữ liệu từ request
        $data = $request->all();

        // Phân loại dữ liệu theo thuộc tính
        $colors = [];
        $options = [];
        $quantities = [];
        $prices = [];
        $salePrices = [];
        $statuses = [];

        foreach ($data as $key => $value) {
            if (preg_match('/^color(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $colors[$index] = $value;
            }
            // $matches là mảng mà preg_match điền các kết quả khớp vào. Phần tử đầu tiên của 
            // $matches chứa toàn bộ chuỗi khớp, và các phần tử tiếp theo chứa các nhóm con tìm được.
            // Ví dụ
            // $data = [
            //     'color1' => 'red',
            //     'color2' => 'blue',
            //     'price1' => '100',
            //     'price2' => '150'
            // ];
            // Khi $key là color1, preg_match tìm thấy khớp với mẫu regex và $matches sẽ chứa:

            //     $matches[0] là color1
            //     $matches[1] là 1
            //     $colors[1] sẽ được gán giá trị 'red'.
            if (preg_match('/^option(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $options[$index] = $value;
            }
            if (preg_match('/^quantity(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $quantities[$index] = $value;
            }
            if (preg_match('/^price(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $prices[$index] = $value;
            }
            if (preg_match('/^sale_price(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $salePrices[$index] = $value === '' ? null : $value;
            }
            if (preg_match('/^status(\d+)$/', $key, $matches)) {
                $index = $matches[1];
                $statuses[$index] = $value;
            }
        }

        // Tạo một mảng để lưu các thuộc tính của sản phẩm
        $attributes = [];
        foreach ($colors as $index => $color) {
            $attributes[] = [
                'color' => $color,
                'option' => $options[$index] ?? null,
                'quantity' => $quantities[$index] ?? null,
                'price' => $prices[$index] ?? null,
                'sale_price' => $salePrices[$index] ?? null,
                'status' => $statuses[$index] ?? null,
            ];
        }

        // Xử lý và lưu các thuộc tính của sản phẩm
        foreach ($attributes as $attribute) {
            ProductDetail::create([
                'color' => $attribute['color'],
                'option' => $attribute['option'],
                'quantity' => $attribute['quantity'],
                'price' => $attribute['price'],
                'sale_price' => $attribute['sale_price'],
                'status' => $attribute['status'],
                'product_id' => $productId,
            ]);
        }
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
            unlink(public_path('images/product/'. $product->image));
            $directoryPath = public_path('images/product');
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
        // $filePath = public_path('images/products/' . $product->image);
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
        $directoryPath = public_path('images/categories');
        $imageName = time().'-'.$request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->move($directoryPath, $imageName);
        Category::create(
            [
                'name' => $request->name,
                'image' => $imageName,
                'status' => $request->status,
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
        $cate->status = $request->input('status');
        if($request->hasFile('image')){
            unlink(public_path('images/categories/'. $cate->image));
            $directoryPath = public_path('images/categories');
            $imageName = time().'-'.$request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->move($directoryPath, $imageName);
            $cate->image = $imageName;
        }else{
            $cate->image = $cate->image;
        }
        $cate ->save();
        return redirect()->route('admin.cate');
    }

    public function DeleteCate($id){
        $product = Product::where('category_id', $id)->get();
        $category = Category::find($id);
        $filePath = public_path('images/categories/' . $category->image);
        unlink($filePath);
        foreach ($product as $item) {
            $item->category_id = 0;
            $item->save();
        }
        $category->delete();
        return redirect()->route('admin.cate');
    }
}
