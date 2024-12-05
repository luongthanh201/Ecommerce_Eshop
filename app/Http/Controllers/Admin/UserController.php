<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
class UserController extends Controller
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
    public function edit()
    {
        if(Auth::check()){
            $user = Auth::user();
            $country = Country::all();
            return view('admin.user.pages-profile', compact("user", "country"));
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request)
    {
        //lấy id user
        $userID = Auth::id();
        //Viết hàm sql lấy all thong tin của user có id = id truyền vào
        $user = User::findOrFail($userID);
        //  Lấy tất cả thông tin nhập từ form
        $data = $request->all();
        //Lấy thông tin của file upload
        $file = $request->avatar;
        // kt nếu có file thì lấy tên file dựa vào mảng
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        // kt nếu có sđt thì thay đổi
        if ($data['phone']) {
            $user->phone = $data['phone'];
        }        
        //Kt nếu có pass mới
        if($data['password'] && $data['password'] == $data['password']){
            //mã hóa và dựa vào mảng
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        $countryId = $request->input('country');
        $country = Country::find($countryId);
        if(!$country){
            return back()->withErrors(['country'=>'Quoc gia khong hop le']);
        }
        $data['id_country'] = $countryId;
        if($user->update($data)){
            if(!empty($file)){
                $file->move('upload/user', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', _('Update profile success'));
        }else{
            return redirect()->back()->withErrors('Upload profile error');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
