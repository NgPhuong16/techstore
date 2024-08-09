@props(['value'])

@php
    $item = $value;

    // Chuyển đổi Collection thành mảng
    $productsArray = $item->productsDetail->toArray();

    // Kiểm tra nếu mảng không rỗng trước khi sắp xếp
    if (!empty($productsArray)) {
        // Sắp xếp mảng theo trường 'price'
        usort($productsArray, function($a, $b) {
            return $a['price'] - $b['price'];
        });

        // Sau khi sắp xếp, lấy phần tử nhỏ nhất và lớn nhất:
        $minProduct = $productsArray[0]['price']; // Giá của phần tử đầu tiên là nhỏ nhất
        $maxProduct = $productsArray[count($productsArray) - 1]['price']; // Giá của phần tử cuối cùng là lớn nhất
    } else {
        // Nếu mảng rỗng, gán giá trị mặc định
        $minProduct = $maxProduct = 0; // Hoặc bất kỳ giá trị nào phù hợp với logic của bạn
    }
@endphp

<div class="single-product">
    <div class="product-image">
        <img src="/images/products/{{$item->image}}" alt="{{$item->name}}">
        <div class="button">
            <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
        </div>
    </div>
    <div class="product-info">
        <span class="category">{{$item->category->name}}</span>
        <h4 class="title">
            <a href="{{route('detailproduct', $item->slug)}}">{{$item->name}}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star"></i></li>
            <li><span>4.0 Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ number_format($minProduct) }} VND - {{ number_format($maxProduct) }} VND</span>
        </div>
    </div>
</div>
