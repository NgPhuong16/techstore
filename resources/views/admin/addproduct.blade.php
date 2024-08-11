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
            <form method="POST" action="{{route('admin.insertpro')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="proName" class="form-label">Product's Name</label>
                  <input name="name" type="text" class="form-control" id="proName" placeholder="Nhập tên sản phẩm" required >
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Product's Image</label>
                    <input name="image" class="form-control" type="file" id="formFile" required>
                </div>
                <div class="row row-cols-2">
                    <div class="mb-3 col">
                        <label for="proPrice" class="form-label">Product's Price</label>
                        <input name="price" step="0.01" type="number" class="form-control" id="proPrice" placeholder="Nhập giá sản phẩm" required>
                    </div>
                    <div class="mb-3 col">
                        <label for="proSalePrice" class="form-label">Product's Sale Price</label>
                        <input name="sale_price" step="0.01" type="number" class="form-control" id="proSalePrice" placeholder="Nhập giá sale sản phẩm">
                    </div>
                </div>
                <div class="row row-cols-2">
                    <div class="mb-3 col">
                        <label for="proDescription" class="form-label">Product's Description</label>
                        <textarea name="description" class="form-control" id="proDescription" rows="3" placeholder="Nhập thông tin mô tả sản phẩm"></textarea>
                    </div>
                    <div class="mb-3 col">
                        <label for="proDetail" class="form-label">Product's Detail</label>
                        <textarea name="detail" class="form-control" id="proDetail" rows="3" placeholder="Nhập thông tin chi tiết sản phẩm"></textarea>
                    </div>
                </div>
                <div class="row row-cols-3 mb-3">
                    <div class="mb-3 col">
                        <label for="proView" class="form-label">Product's View</label>
                        <input name="view" type="number" class="form-control" id="proView" placeholder="Lượt xem sản phẩm">
                    </div>
                    <div class="col">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="0" selected>Hide</option>
                            <option value="1">Show</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            @foreach ($cate as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Container for product attributes -->
                <div class="row mb-3 text-center" id="attributeContainer">
                    <!-- Dynamic attribute inputs will be added here -->
                    
                </div>

                <div>
                    <button type="button" class="btn btn-secondary" id="addAttributeBtn">Thêm thuộc tính</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>
    </div>
</div> 
<script>
    let attributeIndex = 0; // Initialize the index counter
    document.getElementById('addAttributeBtn').addEventListener('click', function() {
        // Increase the index each time an attribute is added
        attributeIndex++;

        if(attributeIndex === 1){
            var newTitleAttribute = document.createElement('div');
            newTitleAttribute.className = `col-12 row row-cols-2.5 gap-2 mb-2`;
            newTitleAttribute.innerHTML = `
                <div class="col">Color</div>
                <div class="col">Option</div>
                <div class="col">Quantity</div>
                <div class="col">Price</div>
                <div class="col">Sale_Price</div>
                <div class="col">Status</div>
                <div class="col">Action</div>
            `;
            document.getElementById('attributeContainer').appendChild(newTitleAttribute);
        }
        // Create a new div for the attribute
        var newAttributeDiv = document.createElement('div');
        newAttributeDiv.className = 'col-12 row row-cols-2.5 gap-2 mb-2';
    
        // Create the input for the attribute color
        var attributeColorInput = document.createElement('input');
        attributeColorInput.type = 'text';
        attributeColorInput.className = 'col ';
        attributeColorInput.name = `color${attributeIndex}`;
        attributeColorInput.placeholder = 'Color';
        
        // Create the input for the attribute option
        var attributeOptionInput = document.createElement('input');
        attributeOptionInput.type = 'text';
        attributeOptionInput.className = 'col ';
        attributeOptionInput.name = `option${attributeIndex}`;
        attributeOptionInput.placeholder = 'Option (Ex: 128GB, ...)';
        
        // Create the input for the attribute quantity
        var attributeQuantityInput = document.createElement('input');
        attributeQuantityInput.type = 'number';
        attributeQuantityInput.className = 'col ';
        attributeQuantityInput.name = `quantity${attributeIndex}`;
        attributeQuantityInput.placeholder = 'Quantity';
        
        // Create the input for the attribute price
        var attributePriceInput = document.createElement('input');
        attributePriceInput.type = 'number';
        attributePriceInput.min = 0
        attributePriceInput.step = 0.1;
        attributePriceInput.className = 'col';
        attributePriceInput.name = `price${attributeIndex}`;
        attributePriceInput.placeholder = 'Price';
        
        // Create the input for the attribute sale price
        var attributeSalePriceInput = document.createElement('input');
        attributeSalePriceInput.type = 'number';
        attributeSalePriceInput.min = 0
        attributeSalePriceInput.step = 0.1;
        attributeSalePriceInput.className = 'col';
        attributeSalePriceInput.name = `sale_price${attributeIndex}`;
        attributeSalePriceInput.placeholder = 'Sale Price (Can be null)';
        
        // Create the select input for the status
        var attributeTypeSelect = document.createElement('select');
        attributeTypeSelect.className = 'col';
        attributeTypeSelect.name = `status${attributeIndex}`;

        // Add options to the select input
        var option1 = document.createElement('option');
        option1.value = 0;
        option1.textContent = 'Hide';

        var option2 = document.createElement('option');
        option2.value = 1;
        option2.textContent = 'Show';

        attributeTypeSelect.appendChild(option1);
        attributeTypeSelect.appendChild(option2);
        
        // Create the delete button
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'col btn btn-danger';
        deleteButton.textContent = 'Xóa';
        
        // Append the inputs and delete button to the div
        newAttributeDiv.appendChild(attributeColorInput);
        newAttributeDiv.appendChild(attributeOptionInput);
        newAttributeDiv.appendChild(attributeQuantityInput);
        newAttributeDiv.appendChild(attributePriceInput);
        newAttributeDiv.appendChild(attributeSalePriceInput);
        newAttributeDiv.appendChild(attributeTypeSelect);
        newAttributeDiv.appendChild(deleteButton);
        
        // Add the new attribute div to the container
        document.getElementById('attributeContainer').appendChild(newAttributeDiv);
    
        // Add event listener to the delete button
        deleteButton.addEventListener('click', function() {
            newAttributeDiv.remove();
        });
    });
    </script>
@endsection
            
