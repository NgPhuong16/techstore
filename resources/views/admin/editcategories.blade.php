@extends('layouts.admin-layout')
@section('title', Auth::user()->name)
@section('admin-content')
<div class="container-fluid">
    <div class="row mb-3">
        <h4 class="col-6">Category</h4>
        <div class="col-6">
            <a href="{{route('admin.cate')}}" class="btn btn-primary">Back to list</a>
        </div>
        

    </div>
    <!-- Table Element -->
    <div class="card border-0">
        <div class="card-header">
            <h5 class="card-title">
                Category
            </h5>
            <h6 class="card-subtitle text-muted">
                You can add new and change product information in here
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.update.cate', $cate->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="proName" class="form-label">Category's Name</label>
                  <input name="name" type="text" class="form-control" id="proName" value="{{$cate->name}}" placeholder="Nhập tên danh mục">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Category's Image</label>
                    <img src="/images/categories/{{$cate->image}}" class="img-thumbnail mb-2" style="width: 200px" alt="{{$cate->name}}">
                    <input name="image" class="form-control" type="file" id="formFile">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="0" {{$cate->status == 0 ? 'selected' : ''}}>Hide</option>
                        <option value="1" {{$cate->status == 1 ? 'selected' : ''}}>Show</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div> 
@endsection
            
