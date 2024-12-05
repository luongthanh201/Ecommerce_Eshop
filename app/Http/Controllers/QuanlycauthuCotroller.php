<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\player;
use App\Http\Requests\AddRequest;
class QuanlycauthuCotroller extends Controller
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
        // $players = DB::table('player')->get();
        // return view('list', compact('players'));;

        $players = player::all();
        return view('list', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('add');

        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddRequest $request)
    {
        // DB::table('player')->insert([
        //     'tenCT'=>$request->tenCT,
        //     'tuoi'=>$request->tuoi,
        //     'quoctich'=>$request->quoctich,
        //     'vitri'=>$request->vitri,
        //     'luong'=>$request->luong,
        // ]);
        // return redirect('/list');

        player::create($request->all());
        return redirect('/list');
        
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
        // $player= DB::table('player')->where('id',$id)->first();
        // return view('edit', compact('player'));
        $player = player::find($id);
        return view('edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // DB::table('player')->where('id',$id)
        // ->update([
        //     'tenCT' => $request->tenCT,
        //     'tuoi'=> $request->tuoi,
        //     'quoctich'=> $request->quoctich,
        //     'vitri' => $request->vitri,
        //     'luong' => $request->luong,
        // ]);
        // return redirect('/list');
        $player = player::find($id);
        $player->update($request->all());
        return redirect('/list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('player')->where('id',$id)->delete();
        // return redirect('/list');
        $player = player::find($id);
        $player->delete();
        return redirect('/list');
    }
}
