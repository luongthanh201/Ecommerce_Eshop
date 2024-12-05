<!DOCTYPE html>
<html>
<head>
    <title>Thông tin giỏ hàng</title>
    
</head>
<body>
    <h1>Thông tin giỏ hàng</h1>
    <p>Dưới đây là chi tiết giỏ hàng của bạn:</p>
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
                @foreach ($data as $item)
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
										<td><span>{{$totalAmount}}</span></td>
									</tr>
								</table>
							</td>
						</tr>           
            </tbody>
        </table>
    </div>
</body>
</html>