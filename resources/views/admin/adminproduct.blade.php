@extends('layouts.admin-layout')
@section('title', Auth::user()->name)
@section('admin-content')
<div class="container-fluid">
    <div class="row mb-3">
        <h4 class="col-4">Product</h4>
        <div class="col-4">
            <a href="{{route('adminadd')}}" class="btn btn-info"><i class="fa-solid fa-plus"></i> Add New Product</a>
        </div>
        <div class="col-4">
            <form class=" ms-5 d-flex" id="formSearch" action="{{route('admin.search')}}" method="POST">
                @csrf
                <input id="searchinput" name="keyword" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" id="mybutton" type="submit"> Search</button>
            </form>
        </div>

    </div>
   
    <!-- Table Element -->
    <div class="card border-0">
        <div class="card-header">
            <div class="row row-cols-lg-2 p-2">

                <span style="color: #F6B17A; font-weight: 400;" class=" col dropdown text-center">
                  Lọc danh sách :
                </span>
                <span class="col dropdown text-center">
                  <span id="navhover" class=" dropdown-toggle" type="span" data-bs-toggle="dropdown" aria-expanded="false">
                    Danh mục
                  </span>
                  <ul class="dropdown-menu p-0">
                      @foreach ($cate as $item)
                          <li><a id="dropitem" class="dropdown-item" href="{{route('admin.pro.cate', $item->id)}}">{{$item->name}}</a></li>
                      @endforeach
                  </ul>
                </span>
                
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">View</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index=>$item)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td><img src="/images/products/{{$item->image}}" class="img-thumbnail" style="width: 100px; height:100px" alt=""></td>
                        <td>{{number_format($item->price)}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->view}}</td>
                        <td>{{$item->namecate}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('adminedit', $item->id)}}" class="btn btn-info mx-1">Edit</a>
                                <form action="{{route('admin.delpro', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Xóa sản phẩm')" class="btn btn-danger mx-1">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> 
@endsection
            
