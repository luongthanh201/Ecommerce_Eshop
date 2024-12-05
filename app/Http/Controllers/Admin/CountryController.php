<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
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
        $country = Country::all();
        return view('admin.country.list', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Country::create($request->all());
        return redirect('/list_ct');
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
        $country = Country::find($id);
        $country->delete();
        return redirect('/list_ct');
    }
}
