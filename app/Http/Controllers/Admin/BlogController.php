<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // hamf khoi tao cua huong doi tuong (oop), chay dau tien 
    public function __construct()
    {
        // checkquyen
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return view('admin.blog.list', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.blog.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {   
        $data = $request->all();    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            // Lưu tên file vào cột 'image'
            $data['image'] = $fileName;
            // Di chuyển file hình ảnh vào thư mục lưu trữ mong muốn
            $file->move('upload/product', $fileName);
        }
        
        Blog::create($data);      
        return redirect('/list_bl')->with('success', 'Blog da duoc tao thanh cong');
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
    public function edit(string $id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::find($id);
        $blog->update($request->all());
        return redirect('/list_bl');
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/list_bl');
    }
}
