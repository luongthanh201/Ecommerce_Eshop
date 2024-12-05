@extends('frontend.layout.master')
@section('content')
<div class="container">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Check out</li>
        </ol>
    </div><!--/breadcrums-->

    <div class="step-one">
        <h2 class="heading">Step1</h2>
    </div>
    <div class="checkout-options">
        <h3>New User</h3>
        <p>Checkout options</p>
        <div class="register-req">
        <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
    </div><!--/register-req-->
        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (!Auth::check())
                        <form class="form-horizontal form-material" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line" name="name" value="" width="300px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="email" id="example-email" value="" width="300px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" class="form-control form-control-line" value="" width="300px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="phone" value="" width="300px">
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-12">Avatar</label>
                                        <div class="col-md-12">
                                            <input type="file" placeholder="" class="form-control form-control-line" name="avatar" value="" width="300px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </form>
                                @endif
    </div><!--/checkout-options-->  
    <!-- Include any hidden fields or other form inputs you need here -->
    <form id="send-email-form" action="{{ route('send.email') }}" method="POST">
        @csrf
        <button type="submit">Continue</button>
    </form>

    <div class="review-payment">
        <h2>Review & Payment</h2>
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
                                        <a class="cart_quantity_delete" href="" id="{{ $product->id }}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>                              
                @endforeach      
                <tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$total}}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{ $totalAmount}}</span></td>
									</tr>
								</table>
							</td>
						</tr>           
            </tbody>
        </table>
    </div>
    <div class="payment-options">
        <span>
            <label><input type="checkbox"> Direct Bank Transfer</label>
        </span>
        <span>
            <label><input type="checkbox"> Check Payment</label>
        </span>
        <span>
            <label><input type="checkbox"> Paypal</label>
        </span>
    </div>
</div>
@endsection