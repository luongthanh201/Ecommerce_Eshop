<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class ListBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::latest()->paginate(3);
        return view('frontend.blog.list-blog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function ajaxRate(Request $request)
    {
        $data = $request->all();
        // dd($data);  
        Rate::create([
            'rate' => $data['rate'],
            'id_blog' => $data['id_blog'],
            'id_user' => Auth::user()->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail = Blog::find($id);
        $prev = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = Blog::where('id', '>', $id)->orderBy('id')->first();
        $average = $this->CalculateRate($id);
        // $comments = Comment::find($id);
        $comments = Comment::where('id_blog',$id)->get()->toArray();
        $cmtCon = Comment::where('level', $id)->get()->toArray(); 
        // dd($cmtCon);              
        return view('frontend.blog.blog-detail', compact('detail', 'prev', 'next', 'average', 'comments', 'cmtCon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function CalculateRate($BlogId)
    {
        $rating = Rate::where('id_blog', $BlogId)->get();
        //tinh tong diem rate
        $totalRating = $rating->sum('rate');
        //tinh tong so luong rate
        $numberOfRating = $rating->count();
        if ($numberOfRating > 0) {
            //trung binh cong
            $averageRating = $totalRating / $numberOfRating;
            return round($averageRating, 1);
        }
    }
    public function ajaxComment(Request $request)
    {
        $data = $request->all();
        // dd($data);    
        $comment = Comment::create([
            'cmt' => $data['cmt'],
            'id_blog' => $data['id_blog'],
            'id_user' => Auth::user()->id,
            'avatar_user' => Auth::user()->avatar,
            'name_user' => Auth::user()->name , 
            'level'=>$data['level']                             
        ]);
        return response()->json(['data' => $comment]);
    }
 
}
