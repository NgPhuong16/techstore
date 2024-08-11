@extends('layouts.admin-layout')
@section('title', Auth::user()->name)
@section('admin-content')
<div class="container-fluid">
    <div class="row mb-3">
        <h4 class="col-6">Category</h4>
        <div class="col-6">
            <a href="{{route('admin.addcate')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add New Category</a>
        </div>
        

    </div>
   
    <!-- Table Element -->
    <div class="card border-0">
        
        <div class="card-body"> 
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cate as $index=>$item)
                    <tr>
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{route('admin.edit.cate', $item->id)}}" class="btn btn-info mx-1">Edit</a>
                                <form action="{{route('admin.delcate', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Xóa danh mục')" class="btn btn-danger mx-1">Delete</button>
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
            
