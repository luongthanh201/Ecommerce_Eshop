@extends('frontend.layout.master')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalAmount = 0;
                    $total = 0;
                    @endphp
                    @foreach ($cartItems as $item)
                                        @php
                                            $product = $item['product'];
                                            $quantity = $item['quantity'];
                                            $total = $product->price * $quantity;
                                            $totalAmount += $total;
                                            $images = json_decode($product->img, true);
                                            $firstImage = $images[0] ?? ''; // Get the first image of the product
                                        @endphp
                                        <tr>
                                            <td class="cart_product">

                                                <a href=""><img src="{{ asset('upload/product/' . $firstImage) }}" width="150px" alt=""></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="">{{$product->title}}</a></h4>
                                                <p>Web ID: {{$product->id}}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>${{$product->price}}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <a class="cart_quantity_up" href="" id="{{ $product->id }}"> + </a>
                                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$quantity}}"
                                                        autocomplete="off" size="2">
                                                    <a class="cart_quantity_down" href="" id="{{ $product->id }}"> - </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">${{ $total }}</p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete" href="" id="{{ $product->id }}"><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                    @endforeach                 
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>${{$total}}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$totalAmount}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="{{url("/cart/checkout")}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.cart_quantity_up').click(function (e) {
            // alert(11111);
            e.preventDefault();
            var id = $(this).attr('id');
            // alert(id);
            $.ajax({
                type: 'POST',
                url: '{{url("/cart/upQtyCart/ajax")}}',
                data: {
                    id: id
                },
                success: function (response) {
                    location.reload();
                }
            })
        })
        $('.cart_quantity_down').click(function (e) {
            // alert(11111);
            e.preventDefault();
            var id = $(this).attr('id');
            // alert(id);
            $.ajax({
                type: 'POST',
                url: '{{url("/cart/downQtyCart/ajax")}}',
                data: {
                    id: id
                },
                success: function (response) {
                    location.reload();
                }
            })
        })
        $('.cart_quantity_delete').click(function (e) {
            // alert(11111);
            e.preventDefault();
            var id = $(this).attr('id');
            // alert(id);
            $.ajax({
                type: 'POST',
                url: '{{url("/cart/deleteQtyCart/ajax")}}',
                data: {
                    id: id
                },
                success: function (response) {
                    location.reload();
                }
            })
        })
    })
</script>
@endsection