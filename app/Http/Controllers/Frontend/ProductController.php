<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('frontend.product.list-product', compact('products'));

    }
    public function yourControllerMethod() {
        $brands = Brand::all();
        return view('frontend.layout.menu-left', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $brands = Brand::all();

        return view('frontend.product.add-product', compact('category', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $aa = [];
        if ($request->hasfile('img')) {
            foreach ($request->file('img') as $xx) {
                $image = Image::read($xx);// doc hinh anh
                //lay ten cua hinh anh
                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_" . $xx->getClientOriginalName();
                $name_3 = "hinh200_" . $xx->getClientOriginalName();

                //$image->move('upload/product/', $name);
                //luu hinh anh vao muc can luu
                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);
                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $aa[] = $name;
            }
        }

        $data['img'] = json_encode($aa);// them du lieu duoc ma hoa vao mang $data

        $product = new Product();
        $product->fill($data); //them du lieu vao Product       
        $product->save();// luu product
        return redirect('/product/list')->with('success', 'san pham cua ban duoc them thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('frontend.product.index', compact('products'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $brands = Brand::all();
        return view('frontend.product.edit-product', compact('product', 'category', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $exitingsImg = json_decode($product->img, true) ?? [];// Chuyen danh sach hinh anh thanh mang
        $deleteImages = $request->input('delete_images', []);// lay danh sach hinh anh can xoa tu request
        foreach ($deleteImages as $deleteImg) {
            if (($key = array_search($deleteImg, $exitingsImg)) == true) {
                unset($exitingsImg[$key]);
                if (file_exists(public_path('upload/product/' . $deleteImg))) {
                    unlink(public_path('upload/product/' . $deleteImg));
                }
            }
        }
        $exitingsImg = array_values($exitingsImg);
        //xu ly hinh anh moi
        $newImages = [];
        // kiem tra co hinh anh khong
        if ($request->hasFile('img')) {
            foreach ($request->file('img') as $aa) {
                $image = Image::read($aa);
                //lay ten hinh anh
                $name = $aa->getClientOriginalName();
                $name_2 = "hinh_50" . $aa->getClientOriginalName();
                $name_3 = "hinh_200" . $aa->getClientOriginalName();
                //dua anh vao thu muc upload
                $path = public_path('upload/product/' . $name);
                $path2 = public_path('upload/product/' . $name_2);
                $path3 = public_path('upload/product/' . $name_3);
                // luu hinh anh thanh 3 dinh dang khac nhau
                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $newImages[] = $name;
            }
        }
        $allImages = array_merge($exitingsImg, $newImages); //ket hop 2 mang moi va cu\
        //kiem tra hinh anh co >3
        if (count($allImages) > 3) {
            return back()->withErrors('Hinh anh vuot muc cho phep');
        }
        $data['img'] = json_encode($allImages); // them du lieu duoc ma hoa vao mang $data

        //dd($data);
        $product->update($data); // update product
        return back()->with('success', 'san pham cua ban duoc cap nhat thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/product/list');
    }
    public function detail(string $id)
    {
        $product = Product::find($id);
        $images = json_decode($product->img, true);
        return view('frontend.product.product-detail', compact('product', 'images'));
    }
    public function ajaxAddToCart(Request $request)
    {
        $productId = $request->input('product_id');      
        $cart = session()->get('cart', []); // Lấy array cart từ session
        
        // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng hay chưa
        if (isset($cart[$productId])) {
            // Nếu có thì tăng số lượng
            $cart[$productId]['qty']++;
        } else {
            // Nếu không có thì thêm sản phẩm vào giỏ hàng với số lượng là 1
            $cart[$productId] = [
                'qty' => 1
            ];
        }
        
        // Lưu giỏ hàng mới vào session
        session()->put('cart', $cart);
    
        // Tính tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = array_sum(array_column($cart, 'qty'));
    
        // Trả về JSON response
        return response()->json(['cartCount' => $cartCount]); // Đúng định dạng JSON
    }
    
   
}
