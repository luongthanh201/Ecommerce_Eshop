<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            Sportswear
                        </a>
                    </h4>
                </div>
                <div id="sportswear" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            <li><a href="#">Nike </a></li>
                            <li><a href="#">Under Armour </a></li>
                            <li><a href="#">Adidas </a></li>
                            <li><a href="#">Puma</a></li>
                            <li><a href="#">ASICS </a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">

                </ul>
            </div>
        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000000"
                    data-slider-step="5" data-slider-value="[250000,450000]" id="sl2"><br />
                <b class="pull-left"> <span id="min-price">0</span> VNĐ</b>
                <b class="pull-right"> <span id="max-price">1000000</span> VNĐ</b>
            </div>
        </div><!--/price-range-->

        <div class="shipping text-center"><!--shipping-->
            <img src="images/home/shipping.jpg" alt="" />
        </div><!--/shipping-->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#sl2').slider().on('slideStop', function (ev) {
            var sliderValues = ev.value;
            console.log(sliderValues);

            $.ajax({
                url: '{{route("search-price")}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    slider_price: sliderValues
                },
                success: function (res) {
                    var data = res.data;
                    var html = '';
                    $(".col-sm-4").empty();
                    if (data.length > 0) { // Kiểm tra có sản phẩm nào không
                        data.forEach(function (product) {
                            html += `<div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                               @if(isset($product) && isset($product->img[0]))
                                <img src="{{ asset('upload/user/' . $product->img[0]) }}" width="150px" height="150px">
                                @endif
                                <h2>$${product.price}</h2>
                                <p>${product.title}</p>
                                <a href="#" class="btn btn-default add-to-cart" id="${product.id}"><i
                                    class="fa fa-shopping-cart"></i>Add to
                                    cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>$${product.price}</h2>
                                    <p>${product.title}</p>
                                    <a class="btn btn-default add-to-cart" id="${product.id}"><i
                                        class="fa fa-shopping-cart"></i>Add to
                                        cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="/product-detail/${product.id}"><i class="fa fa-plus-square"></i>Add
                                    to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>`;
                        });
                        $(".col-sm-4").html(html); // Đảm bảo xóa sản phẩm cũ và thêm sản phẩm mới
                    } else {
                        $(".col-sm-4").html("<p>No products found in this price range.</p>");
                    }
                }

            });
        });
    });
</script>