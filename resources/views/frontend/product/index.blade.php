@extends('frontend.layout.master')
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @foreach ($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                @php
                                    $images = json_decode($product->img, true);
                                    $firstImage = $images[0]; // lay hinh anh dau tien cua product  
                                @endphp
                                <img src="{{ asset('upload/product/' . $firstImage) }}" width="150px" height="150px">
                                <h2>{{$product->price}} VNĐ</h2>
                                <p>{{$product->title}}</p>
                                <a href="#" class="btn btn-default add-to-cart " id="{{$product->id}}"><i
                                        class="fa fa-shopping-cart"></i>Add to
                                    cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>${{$product->price}}</h2>
                                    <p>{{$product->title}}</p>
                                    <a class="btn btn-default add-to-cart" id="{{$product->id}}"><i
                                            class=" fa fa-shopping-cart"></i>Add to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="{{url('/product-detail/'. $product->id)}}"><i class="fa fa-plus-square"></i>Add
                                        to wishlist</a></li>
                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        @endforeach

    </div><!--features_items-->

</div>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Xử lý sự kiện click cho add-to-cart
        $('.add-to-cart').click(function (e) {
            e.preventDefault();
            var productID = $(this).attr('id');
            // Gửi yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
            $.ajax({
                type: 'POST',
                url: "{{url('/product/addToCart/ajax')}}",
                data: {
                    product_id: productID
                },
                success: function (response) {
                    // Cập nhật giỏ hàng hoặc hiển thị thông báo thành công
                    alert('Product added to cart');
                    $('#cartCount').text(response.cartCount);
                },
                error: function (xhr, status, error) {
                    alert('Error adding product to cart: ' + error);
                }
            });
        });
    });
</script>

@endsection