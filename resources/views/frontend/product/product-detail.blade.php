@extends('frontend.layout.master')
@section('content')
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img id="mainImage" src="{{asset('upload/product/' . $images[0])}}" alt="" />
            <a id="zoomImage" href="{{asset('upload/product/' . $images[0])}}" rel="prettyPhoto">
                <h3>ZOOM</h3>
            </a>

        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="item {{ $i == 1 ? 'active' : '' }} ">
                        @foreach($images as $image)   
                            <a href="" class="thumbnail-link" data-image="{{ asset('upload/product/' . $image) }}">
                                <img width="70px" src="{{ asset('upload/product/' . $image) }}" alt="">
                            </a>
                        @endforeach
                    </div>
                @endfor               
            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
            <h2>{{ $product->title }}</h2>
            <p>Web ID: {{ $product->id }}</p>
            <img src="{{ asset('images/product-details/rating.png') }}" alt="" />
            <span>
                <span>US ${{ $product->price }}</span>
                <label>Quantity:</label>
                <input type="text" value="3" />
                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> {{ $product->status }}</p>
            <p><b>Brand:</b> {{ $product->id_brand }}</p>
            <a href=""><img src="{{ asset('images/product-details/share.png')}}" class="share img-responsive"
                    alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
<script>
    $(document).ready(function(){
        $('.thumbnail-link').click(function(e){
            e.preventDefault(); 
            newSrc = $(this).data('image');
            $('#mainImage').attr('src', newSrc);
            $('#zoomImage').attr('href', newSrc);
        })
    })
</script>
@endsection