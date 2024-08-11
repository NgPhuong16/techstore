@extends('layouts.user-layout')
@section('namepage','detail')
@section('maincontent')
<!-- Start Item Details -->
<section class="item-details section pt-0">
    <div class="container">
        <div class="top-area">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-images">
                        <div id="product-image" class="carousel slide">
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="/images/products/{{$sp->image}}" class="d-block w-100" alt="...">
                              </div>
                              @foreach ($sp->imagesGallery as $item)
                                <div class="carousel-item">
                                    <img src="/images/products/{{$item->image_link}}" class="d-block w-100" alt="...">
                                </div>
                                @endforeach
                              <div class="carousel-item">
                                <img src="..." class="d-block w-100" alt="...">
                              </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#product-image" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#product-image" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                        <main id="gallery">
                            {{-- <div class="main-img">
                                <img src="/images/products/{{$sp->image}}" id="current" alt="{{$sp->name}}">
                            </div> --}}
                            <div class="images">
                                <img data-bs-target="#product-image" data-bs-slide-to="0" src="/images/products/{{$sp->image}}" class="img" id="current" alt="{{$sp->name}}">
                                @php
                                    $i = 1
                                @endphp
                                @foreach ($sp->imagesGallery as $key => $item)
                                    <img src="/images/products/{{$item->image_link}}" data-bs-target="#product-image" data-bs-slide-to="{{$i++}}" class="img" id="current" alt="{{$key}}">
                                @endforeach
                                {{-- <img src="/public/images/product/01.jpg" class="img" alt="#">
                                <img src="/public/images/product/02.jpg" class="img" alt="#">
                                <img src="/public/images/product/03.jpg" class="img" alt="#">
                                <img src="/public/images/product/04.jpg" class="img" alt="#">
                                <img src="/public/images/product/05.jpg" class="img" alt="#"> --}}
                            </div>
                        </main>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="product-info">
                        <h2 class="title">{{$sp->name}}</h2>
                        <p class="category"><i class="lni lni-tag"></i> {{$sp->category->name}}</p>
                        {{-- <h3 class="price">{{$sp->sale_price > 0 ? number_format($sp->sale_price).' VND' : number_format($sp->price).' VND'}}<span>{{$sp->sale_price > 0 ? number_format($sp->price).' VND' : ''}}</span></h3> --}}
                        <p class="info-text">{{$sp->description}}</p>
                        <div class="row">
                            {{-- <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group color-option">
                                    <label class="title-label" for="size">Choose color</label>
                                    <div class="single-checkbox checkbox-style-1">
                                        <input type="checkbox" id="checkbox-1" checked>
                                        <label for="checkbox-1"><span></span></label>
                                    </div>
                                    <div class="single-checkbox checkbox-style-2">
                                        <input type="checkbox" id="checkbox-2">
                                        <label for="checkbox-2"><span></span></label>
                                    </div>
                                    <div class="single-checkbox checkbox-style-3">
                                        <input type="checkbox" id="checkbox-3">
                                        <label for="checkbox-3"><span></span></label>
                                    </div>
                                    <div class="single-checkbox checkbox-style-4">
                                        <input type="checkbox" id="checkbox-4">
                                        <label for="checkbox-4"><span></span></label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <p>Choose Version</p>
                                <form action="">
                                <div class="btn-group row" role="group" aria-label="Basic radio toggle button group">
                                    @foreach ($sp->productsDetail as $key => $item)
                                    <input type="radio" class=" btn-check" name="btnradio" id="btnradio{{$key}}">
                                    <label class="btn btn-outline-secondary col-4 rounded-0 text-truncate" for="btnradio{{$key}}">{{$item->option}} <br> 
                                        {{$item->sale_price > 0 ? number_format($item->sale_price).' VND' : number_format($item->price).' VND'}} - <del>{{$item->sale_price > 0 ? number_format($item->price).' VND' : ''}}</del>
                                      VND</label>    
                                    @endforeach
                                    
                                    </div>
                                </form>
                              </div>
                            {{-- <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group">
                                    <label for="option">Choose Version</label>
                                    <select class="form-control" id="option" name="option">
                                        @foreach ($sp->productsDetail as $item)
                                            <option>Color: {{$item->color}} | Option: {{$item->option}}</option>
                                        @endforeach
                                        <option>5100 mAh</option>
                                        <option>6200 mAh</option>
                                        <option>8000 mAh</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="form-group quantity">
                                    <label for="color">Quantity</label>
                                    <select class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <div class="row align-items-end">
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="button cart-button">
                                        <button class="btn" style="width: 100%;">Add to Cart</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn"><i class="lni lni-reload"></i> Compare</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="wish-button">
                                        <button class="btn"><i class="lni lni-heart"></i> To Wishlist</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-details-info">
            <div class="single-block">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="info-body custom-responsive-margin">
                            <h4>Details</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
                            <h4>Features</h4>
                            <ul class="features">
                                <li>Capture 4K30 Video and 12MP Photos</li>
                                <li>Game-Style Controller with Touchscreen</li>
                                <li>View Live Camera Feed</li>
                                <li>Full Control of HERO6 Black</li>
                                <li>Use App for Dedicated Camera Operation</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="info-body">
                            <h4>Specifications</h4>
                            <ul class="normal-list">
                                <li><span>Weight:</span> 35.5oz (1006g)</li>
                                <li><span>Maximum Speed:</span> 35 mph (15 m/s)</li>
                                <li><span>Maximum Distance:</span> Up to 9,840ft (3,000m)</li>
                                <li><span>Operating Frequency:</span> 2.4GHz</li>
                                <li><span>Manufacturer:</span> GoPro, USA</li>
                            </ul>
                            <h4>Shipping Options:</h4>
                            <ul class="normal-list">
                                <li><span>Courier:</span> 2 - 4 days, $22.50</li>
                                <li><span>Local Shipping:</span> up to one week, $10.00</li>
                                <li><span>UPS Ground Shipping:</span> 4 - 6 days, $18.00</li>
                                <li><span>Unishop Global Export:</span> 3 - 4 days, $25.00</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="single-block give-review">
                        <h4>4.5 (Overall)</h4>
                        <ul>
                            <li>
                                <span>5 stars - 38</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                            </li>
                            <li>
                                <span>4 stars - 10</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>3 stars - 3</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>2 stars - 1</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                            <li>
                                <span>1 star - 0</span>
                                <i class="lni lni-star-filled"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                                <i class="lni lni-star"></i>
                            </li>
                        </ul>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn review-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Leave a Review
                        </button>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="single-block">
                        <div class="reviews">
                            <h4 class="title">Latest Reviews</h4>
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="assets/images/blog/comment1.jpg" alt="#">
                                <div class="review-info">
                                    <h4>Awesome quality for the price
                                        <span>Jacob Hammond
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor...</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="assets/images/blog/comment2.jpg" alt="#">
                                <div class="review-info">
                                    <h4>My husband love his new...
                                        <span>Alex Jaza
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star"></i></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor...</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                            <!-- Start Single Review -->
                            <div class="single-review">
                                <img src="assets/images/blog/comment3.jpg" alt="#">
                                <div class="review-info">
                                    <h4>I love the built quality...
                                        <span>Jacob Hammond
                                        </span>
                                    </h4>
                                    <ul class="stars">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        tempor...</p>
                                </div>
                            </div>
                            <!-- End Single Review -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Item Details -->
@endsection