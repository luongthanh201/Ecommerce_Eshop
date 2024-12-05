@extends('frontend.layout.master')
@section('content')
<div class="col-sm-3">
    @include('frontend.layout.account-menu');
</div>
<div class="col-sm-9">
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Image</td>
                    <td class="description">Title</td>
                    <td class="price">Price</td>
                    <td class="total">action</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="cart_product">
                        @foreach(json_decode($product->img, true) as $image)
                        <img src="{{ asset('upload/product/' . $image) }}" width="50px" height="50px">
                        @endforeach
                        </td>
                        <td class="cart_description">
                            {{$product->title}}

                        </td>
                        <td class="cart_price">
                            <p>${{$product->price}}</p>
                        </td>

                        <td class="cart_total">
                            <a href="{{url('/product/edit/'. $product->id  )}}">edit</a>
                            <br>
                            <a href="{{url('/product/delete/'. $product->id )}}">delete</a>
                        </td>
                    </tr>
                @endforeach                     
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8">
                        <a href="{{url('/product/add')}}"><button id="button" style="color:white; background-color:orange; text-align: text-center">Add Product</button></a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection