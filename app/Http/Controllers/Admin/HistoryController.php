<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
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
        $hisories = History::all();
        return view('admin.history.list', compact('hisories'));
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
        $history = History::find($id);
        $history->delete();
        return redirect('list_brand');
    }
}
