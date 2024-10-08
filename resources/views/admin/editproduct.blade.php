@extends('layouts.admin-layout')
@section('title', Auth::user()->name)

@section('admin-content')
<div class="container-fluid">
    <div class="row mb-3">
        <h4 class="col-6">Product</h4>
        <div class="col-6">
            <a href="/adminpro" class="btn btn-primary">Back to list</a>
        </div>
        

    </div>
    <!-- Table Element -->
    <div class="card border-0">
        <div class="card-header">
            <h5 class="card-title">
                Product
            </h5>
            <h6 class="card-subtitle text-muted">
                You can add new and change product information in here
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.updatepro', $product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="proName" class="form-label">Product's Name</label>
                  <input name="name" type="text" class="form-control" id="proName" value="{{$product->name}}" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Product's Image</label>
                    <img src="/img/product/{{$product->image}}" class="img-thumbnail mb-2" style="width: 200px" alt="">
                    <input name="image" class="form-control" type="file" id="formFile">
                </div>
                <div class="row row-cols-2">
                    <div class="mb-3 col">
                        <label for="proPrice" class="form-label">Product's Price</label>
                        <input name="price" step="0.01" type="number" class="form-control" id="proPrice" value="{{$product->price}}" placeholder="Nhập giá sản phẩm">
                    </div>
                    <div class="mb-3 col">
                        <label for="proSalePrice" class="form-label">Product's Sale Price</label>
                        <input name="sale" step="0.01" type="number" class="form-control" id="proSalePrice" value="{{$product->sale}}" placeholder="Nhập giá sale sản phẩm">
                    </div>
                </div>
                <div class="row row-cols-2">
                    <div class="mb-3 col">
                        <label for="proDescription" class="form-label">Product's Description</label>
                        <textarea name="description" class="form-control" id="proDescription" rows="3"  placeholder="Nhập thông tin mô tả sản phẩm">{{$product->description}}</textarea>
                    </div>
                    <div class="mb-3 col">
                        <label for="proDetail" class="form-label">Product's Detail</label>
                        <textarea name="detail" class="form-control" id="proDetail" rows="3"  placeholder="Nhập thông tin chi tiết sản phẩm">{{$product->detail}}</textarea>
                    </div>
                </div>
                <div class="row row-cols-3 mb-3">
                    <div class="mb-3 col">
                        <label for="proView" class="form-label">Product's View</label>
                        <input name="view" type="number" class="form-control" id="proView" value="{{$product->view}}" placeholder="Lượt xem sản phẩm">
                    </div>
                    <div class="col">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            {{-- <option selected>
                                @if ($product->status == 0)
                                    Hide
                                @else
                                    Show
                                @endif
                            </option> --}}
                            <option value="0" {{$product->status == 0 ? 'selected' : ''}}>Hide</option>
                            <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Show</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            {{-- <option selected value="{{$product->idcate}}" >{{$product->namecate}}</option> --}}
                            @foreach ($cate as $item)
                            <option value="{{$item->id}}" {{$item->id == $product->idcate ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div> 
@endsection
            
