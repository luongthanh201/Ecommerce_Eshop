<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Product;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendEmail()
    {
        $user = Auth::user();
        $cartItems = session()->get('cart', []); // Đảm bảo rằng bạn lấy được giỏ hàng từ session

        $data = [];
        $totalAmount = 0; // Tính tổng số tiền

        foreach ($cartItems as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $quantity = $details['qty'];
                
                $data[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'title' => $product->title,
                    'price' => $product->price,

                ];
            }
        }
         // Đảm bảo title và price được gán giá trị nếu giỏ hàng không rỗng
         $firstCartItem = reset($cartItems);
         $title = $firstCartItem ? Product::find(key($cartItems))->title : '';
         $price = $firstCartItem ? Product::find(key($cartItems))->price : 0;
        History::create([
            'user_id' => $user->id,
            'cart' => json_encode($data),
            'title' =>$title,
            'price' => $price,
            'email' => $user->email // Email người dùng
        ]);

        try {
            Mail::to('nguyenluongthanh201@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great check your mail box']);
        } catch (Exception $th) {
            
            return response()->json(['sorry']);
        }
    }


}
