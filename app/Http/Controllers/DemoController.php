<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\account;
class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // $aa = DB::table('account')->where('name','Linh')->get();
        // dd($aa);
        // $bb = DB::table('cart')->where('price','>','100000')->get();
        // dd($bb);
        // $user = DB::table('account')
        // ->join('login', 'account.id','=', 'login.id')
        // ->get();
        // dd($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('login');
    }

    /**
     * Store a  newly created resource in storage.
     */
    public function store(Request $request)
    {
       DB::table('login')->insert([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password
       ]);  
       return redirect('/bai8');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
}
