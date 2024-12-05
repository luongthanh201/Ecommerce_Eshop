<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart', []);// lấy array trong ss
        $cartItems = [];
        //lấy từng phần tử cart được luu trong ss
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['qty']
                ];
            }
        }

        return view('frontend.cart.list', compact('cartItems'));
    }

    public function order()
    {
        $cart = session()->get('cart', []);// lấy array trong ss
        $cartItems = [];
        //lấy từng phần tử cart được luu trong ss
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $details['qty']
                ];
            }
        }

        return view('frontend.cart.checkout', compact('cartItems'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function ajaxUpQtyCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        }
        session()->put('cart', $cart);
        return response()->json(['status' => 'success']);
    }
    public function ajaxDownQtyCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;
    
        if (isset($cart[$id])) {
            // Nếu số lượng hiện tại là 1, xóa sản phẩm khỏi giỏ hàng
            if ($cart[$id]['qty'] == 1) {
                unset($cart[$id]);
            } else {
                // Nếu lớn hơn 1, giảm số lượng đi 1
                $cart[$id]['qty']--;
            }
        }
    
        session()->put('cart', $cart);
    
        // Trả về phản hồi JSON để xử lý trên frontend
        return response()->json(['status' => 'success']);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function ajaxDeleteQtyCart(Request $request)
    {
        $cart = session()->get('cart',[]);
        $id = $request->id;
        if($cart[$id]){
            unset($cart[$id]);
        }
        session()->put('cart',$cart);
        response()->json(['status'=>'success']);
    }
}
