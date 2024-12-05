<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function searchAdvanced()
    {
        $categories = Category::all();
        $brands = Brand::all();   
        return view("frontend.search.search-advanced", compact("categories", "brands"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $search = $request->input("search");
        $products = Product::where('title', 'LIKE', '%'.$search."%")->get();
        return view("frontend.search.result",compact("products"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function fillByPrice(Request $request)
    {
        $sliderPrice = $request->input("slider_price");
    
        // Xử lý mảng giá trị của slider
        $price = is_array($sliderPrice) ? $sliderPrice : explode(':', $sliderPrice);
    
        // Lọc sản phẩm trong khoảng giá
        $data = Product::whereBetween('price', [$price[0], $price[1]])->get();
        
        return response()->json(['data' => $data]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function searchPost(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'price' => 'nullable|string',
            'category' => 'nullable|integer',
            'brand' => 'nullable|integer',
            'status' => 'nullable|string',
        ]);
    
        // Check if no criteria are entered
        if (!$request->title && !$request->price && !$request->category && !$request->brand && !$request->status) {
            return redirect()->back()->with('error', 'Vui lòng chọn sản sản cần tìm.');
        }
        $query = Product::query();
        // kiểm tra title
        if($request->filled("title")){
            $query->where('title', 'LIKE', '%'.$request->title.'%');
        }
        // kiểm tra giá
        if($request->filled('price')){
            $price = explode('-', $request->price);
            $query->WhereBetween('price', [$price[0], $price[1]])->get();
        }
        // kiểm tra category
        if($request->filled('category')){
            $query->where('id_category', $request->category);
        }
        if($request->filled('brand')){
            $query->where('id_brand', $request->brand);
        }
        //phân trang kết quả
        $products = $query->paginate(5);
        return view("frontend.search.result", compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
